<?php

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()){
        return redirect('/shoplist');
    }
    return view('login');
})->name('login');

Route::get('/auth/redirect', function(){
    return Socialite::driver('discord')->redirect();
});

Route::get('/auth/callback', function(){
    $discordUser = Socialite::driver('discord')->user();
    $user = User::where('oauth_id', $discordUser->id)->first();
    if ($user){
        if ($user->isBanned){
            abort(403);
        }
        $user->avatar = $discordUser->avatar;
        $user->save();
        Auth::login($user, true);
        return redirect('/shoplist');
    }
    else {
        
        $verifURL = sprintf("https://bot.ichari.net/?d=%s&u=%s", getenv('DISCORD_AUTH_GUILD'), $discordUser->id);
        $verifResponse = Http::get($verifURL);

        if (boolval($verifResponse)){

            $allowedRoles = explode(',', getenv('DISCORD_REQUIRED_ROLES'));
            $verifResponseArr = json_decode($verifResponse->body(), true);
            $verified = false;
            foreach($verifResponseArr['roles'] as $i){
                if (in_array($i, $allowedRoles)){
                    $verified = true;
                }
            }

            if ($verified){
                if ($verifResponseArr['nick']){
                    $name = $verifResponseArr['nick'];
                }
                else {
                    $name = $discordUser->name;
                }

                $rssKeyPool = '2346789bBcCdDfFgGhHjJkKmMpPqQrRtTvVwWxXyY';
                $rssKey = '';
                for ($i = 0; $i < 8; $i++){
                    $rssKey .= substr($rssKeyPool, rand(0, strlen($rssKeyPool) -1), 1);
                }

                // check for existing users. If none, make new user admin
                $userlist = User::all();
                $count = $userlist->count();
                if ($count){
                    $isAdmin = 0;
                }
                else {
                    $isAdmin = 1;
                }

                // create user
                $user = User::create([
                    'oauth_id' => $discordUser->id,
                    'name' => $name,
                    'oauth_unique' => $discordUser->nickname,
                    'avatar' => $discordUser->avatar,
                    'isAdmin' => $isAdmin
                ]);
                Auth::login($user, true);
                return redirect('/shoplist');
            }
            else {
                abort(401);
            }
        }
        else {
            abort(403);
        }
    }
    
});

Route::get('/shoplist', function(){
    return view('shoplist');
})->middleware('auth');


Route::get('/shoplist/{search}', function($search){
    $searchArr = explode(":", $search);
    switch ($searchArr[0]){
        case ("i"):
            $isearch = str_replace("+", " ", trim($searchArr[1]));
            $shops = Shop::where('inventory', 'LIKE', '%'.$isearch.'%')
                        ->where('status', '!=', 'abandoned')
                        ->orderBy('updated_at')
                        ->get();
            return view('shoplist', ["search" => true, "isearch" => $isearch, "shops" => $shops]);
            break;
        case ("s"):
            $ssearch = str_replace("+", " ", $searchArr[1]);
            $shop = Shop::where('name', $ssearch)->first();
            
            return redirect('/shop/view/' . $shop->id);
            break;
        case ("p"):
            $psearch = User::where('name', $searchArr[1])->first();
            if ($psearch){
                $shops = $psearch->shops();
            }
            return view('shoplist', ["psearch" => $psearch->name, "shops" => $shops]);
            break;
        case ("d"):
            $ssearch = str_replace("+", " ", trim($searchArr[1]));
            $shops = Shop::where('name', 'LIKE', '%'.$ssearch.'%')
                            ->orWhere('blurb', 'LIKE', '%'.$ssearch.'%')
                            ->orWhere('description', 'LIKE', '%'.$ssearch.'%')
                            ->where('status', '!=', 'abandoned')
                            ->get();
            if ($shops->count() == 1){
                $redirShopId = $shops->first()->id;
                return redirect("/shop/view/" . $redirShopId);
            }
            return view('shoplist', ['search' => true, 'ssearch' => $ssearch, 'shops' => $shops]);
            break;
        default:
            return redirect('/shoplist');
            break;
    }
    
})->middleware('auth');


Route::get('/shop/view/{shop_id}', function($shop_id){
    return view('shop', ['shop_id' => $shop_id]);
})->middleware('auth');


Route::get('/shop/edit/{shop_id}', function($shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners(false);
    if (!in_array(Auth::id(), $owners)){
        abort(403);
    }
    return view('editShop', ['shop_id' => $shop_id]);
})->middleware('auth');
Route::post('/shop/edit/{shop_id}', function(Request $request, $shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners(false);
    if (!in_array(Auth::id(), $owners)){
        abort(403);
    }
    if (!$request->post('formLocationX')){
        $formLocation['x'] = 0;
    }
    else {
        $formLocation['x'] = $request->post('formLocationX');
    }
    if (!$request->post('formLocationY')){
        $formLocation['y'] = -65;
    }
    else {
        $formLocation['y'] = $request->post('formLocationY');
    }
    if (!$request->post('formLocationZ')){
        $formLocation['z'] = 0;
    }
    else {
        $formLocation['z'] = $request->post('formLocationZ');
    }
    
    $location = implode(", ", $formLocation);

    if ($request->post('stock')){
        $inventory = json_decode(str_replace("'", '"', $request->post('stock')), true);
        $inventory = trim(str_replace("-", " ", json_encode($inventory)));
        $type = 'Retail';
    }
    else {
        $type = 'Service';
        $inventory = null;
    }
    if($request->post('formShopDescription')){
        $sanitizer = HtmlSanitizer\Sanitizer::create([
            'extensions' => ['basic', 'list'], 
            'tags' => [
                'div' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h1' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h2' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h3' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h4' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h5' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h6' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'span' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'p' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                    ],
                'ul' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                    ],
                'li' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ]
            ]
        ]);
        $description = $sanitizer->sanitize($request->post('formShopDescription'));
    }
    else {
        $description = null;
    }

    $shop->name = preg_replace('/[^A-Za-z0-9!\/:\&\?\(\)]/', '', $request->post('formShopName'));
    $shop->type = $type;
    $shop->location = $location;
    $shop->area = $request->post('formShopArea');
    $shop->inventory = $inventory;
    $shop->description = $description;
    $shop->save();

    foreach($request->post('coowners') as $owner){
        if (!in_array($owner, $shop->owners(false))){
            DB::table('shop_has_users')
                ->insert(['shop_id' => $shop->id, 'user_id' => trim($owner)]);
        }
    }
    return redirect('/shop/view/'.$shop->id);
})->middleware('auth');


Route::get('/shop/create', function(){
    return view('createShop');
})->middleware('auth');
Route::post('/shop/create', function(Request $request){

    if (!$request->post('formLocationX')){
        $formLocation['x'] = 0;
    }
    else {
        $formLocation['x'] = $request->post('formLocationX');
    }
    if (!$request->post('formLocationY')){
        $formLocation['y'] = -65;
    }
    else {
        $formLocation['y'] = $request->post('formLocationY');
    }
    if (!$request->post('formLocationZ')){
        $formLocation['z'] = 0;
    }
    else {
        $formLocation['z'] = $request->post('formLocationZ');
    }
    
    $location = implode(", ", $formLocation);

    if ($request->post('stock')){
        $inventory = json_decode(str_replace("'", '"', $request->post('stock')), true);
        $inventory = trim(str_replace("-", " ", json_encode($inventory)));
        $type = 'Retail';
    }
    else {
        $type = 'Service';
        $inventory = null;
    }
    if($request->post('formShopDescription')){
        $sanitizer = HtmlSanitizer\Sanitizer::create([
            'extensions' => ['basic', 'list'], 
            'tags' => [
                'div' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h1' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h2' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h3' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h4' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h5' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'h6' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'span' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'p' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'ul' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ],
                'li' => [
                    'allowed_attributes' => [
                        'style'
                    ]
                ]
            ]
        ]);
        $description = $sanitizer->sanitize($request->post('formShopDescription'));
    }
    else {
        $description = null;
    }

    $shop = Shop::create([
        'name' => preg_replace('/[^A-Za-z0-9!\/:\&\?\(\)]/', '', $request->post('formShopName')),
        'status' => 'pending',
        'type' => $type,
        'location' => $location,
        'area' => $request->post('formShopArea'),
        'inventory' => $inventory,
        'description' => $description
    ]);

    foreach($request->post('coowners') as $owner){
        DB::table('shop_has_users')
            ->insert(['shop_id' => $shop->id, 'user_id' => trim($owner)]);
    }
    return redirect('/shop/view/'.$shop->id);
    

})->middleware('auth');


Route::get('/shop/leave/{shop_id}', function($shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    return view('leaveShop', ['shop' => $shop]);
})->middleware('auth');
Route::get('/shop/leave/confirm/{shop_id}', function($shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners(false);
    if (!in_array(Auth::id(), $owners)){
        abort(403);
    }
    DB::table('shop_has_users')
        ->where('shop_id', $shop_id)
        ->where('user_id', Auth::user()->id)
        ->delete();
    if ($shop->owners()->count() < 1){
        $shop->delete();
    }
    return redirect("/shoplist/p:". Auth::user()->name);
})->middleware('auth');

Route::get('/shop/edit/status/{shop_id}', function($shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners(false);
    if (!in_array(Auth::id(), $owners)){
        abort(403);
    }
    $status = $shop->status;
    switch($status){
        case "closed":
            $shop->status = "pending";
            break;
        case "pending":
            $shop->status = "open";
            break;
        case "open":
            $shop->status = "closed";
            break;
        default:
            $shop->status = "pending";
            break;
    }
    $shop->save();
    return redirect('/shop/view/'.$shop->id);
})->middleware('auth');
Route::post('/shop/edit/blurb/{shop_id}', function(Request $request, $shop_id){
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners(false);
    if (!in_array(Auth::id(), $owners)){
        abort(403);
    }
    $shop->blurb = $request->post('formBlurbInput');
    $shop->save();
    return redirect('/shop/view/'.$shop->id);
})->middleware('auth');
Route::get('/shop/edit/inactive/{shop_id}', function($shop_id){
    if (!Auth::user()->isMod){
        abort(403);
    }
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $owners = $shop->owners();
    $shop->status = "inactive";
    $shop->save();
    foreach ($owners as $owner){
        $owner->discordNotif("Your shop __" . $shop->name . "__ has been marked inactive. Contact a moderator if you have any questions.");
    }
    return redirect('/shop/view/'.$shop->id);
})->middleware('auth');
Route::get('/shop/edit/delete/{shop_id}', function($shop_id){
    if (!Auth::user()->isMod){
        abort(403);
    }
    DB::table('shop_has_users')
        ->where('shop_id', $shop_id)
        ->delete();
    $shop = Shop::where('id', $shop_id)->firstOrFail();
    $shop->delete();
    return redirect('/shoplist');
});


Route::get('/userlist', function(Request $request){
    if (!Auth::user()->isMod && !Auth::user()->isAdmin){
        abort(403);
    }
    else{
        if ($request->get('sort')){
            $sort = explode("-", $request->get('sort'));
            if ($sort[1] == "desc"){
                $users = User::orderBy($sort[0], 'desc')->get();
            }
            else {
                $users = User::orderBy($sort[0])->get();
            }    
        }
        else {
            $sort = ['name', 'asc'];
            $users = User::orderBy('name')->get();
        }
        return view('userlist', ["users" => $users, 'field' => $sort[0], 'method' => $sort[1]]);
    }
})->middleware('auth');
Route::get('/userlist/edit/{user_id}/{field}', function($user_id, $field){
    $user = User::where('id', $user_id)->firstOrFail();
    switch($field){
        case "mod":
            if ($user->isMod){
                $user->isMod = false;
            }
            else {
                $user->isMod = true;
            }
            $user->save();
            return redirect("/userlist");
            break;
        case "admin":
            if ($user->isAdmin){
                $user->isAdmin = false;
            }
            else {
                $user->isAdmin = true;
            }
            $user->save();
            return redirect("/userlist");
            break;
        case "ban":
            $user->isBanned = true;
            $user->save();
            $userShops = $user->shops();
            foreach($userShops as $shop){
                DB::table('shop_has_users')
                ->where('shop_id', $shop->id)
                ->where('user_id', $user->id)
                ->delete();

                if ($shop->owners()->count() < 1){
                    $shop->delete();
                }
            }
            return redirect("/userlist");
            break;
        case "unban":
            $user->isBanned = false;
            $user->save();
            return redirect("/userlist");
            break;
        default:
            abort(403);
            break;
    }
})->middleware('auth');


Route::get('/logout', function(Request $request){
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
})->middleware('auth');