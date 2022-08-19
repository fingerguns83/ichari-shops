<?php

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search/{method}/{target}', function(Request $request, $method, $target){
    function formatLocation($shop){
        if ($shop->area == "Mall"){
            $output = [
                "x" => -1366,
                "y" => -65,
                "z" => 474
            ];
        }
        else {
            $arr = explode(", ", $shop->location);
            $output = [
                "x" => intval($arr[0]),
                "y" => -65,
                "z" => intval($arr[1])
            ];
        }
        return $output;
    }
    if ($request->get('key') !== getenv('SPIGOT_PLUGIN_KEY')){
        abort(403);
    }
    switch ($method){
        case "owner":
            $user = User::where('name', $target)->firstOrFail();
            $shops = $user->shops();
            $output = [];
            foreach($shops as $shop){
                $output[] = [
                    "name" => $shop->name,
                    "status" => $shop->status,
                    "location" => formatLocation($shop)
                ];
            }
            echo trim(json_encode($output));
            break;
        case "shop":
            $shop_name = str_replace("_", " ", strtolower($target));
            $shop = Shop::where('name', $shop_name)->firstOrFail();
            $output[] = [
                "name" => $shop->name,
                "status" => $shop->status,
                "location" => formatLocation($shop)
            ];
            echo trim(json_encode($output));
            break;
        case "item":
            $item_name = str_replace("_", " ", strtolower($target));
            $shops = Shop::where('inventory', 'LIKE', '%'.$target.'%')
            ->where('status', '!=', 'inactive')
            ->get()
            ->shuffle();
            foreach($shops as $shop){
                $output[] = [
                    "name" => $shop->name,
                    "status" => $shop->status,
                    "location" => formatLocation($shop)
                ];
            }
            echo trim(json_encode($output));
            break;
        default:
            abort(400);
    }

});
Route::get('/fetch/{target}', function(Request $request, $target){
    if ($request->get('key') !== getenv('SPIGOT_PLUGIN_KEY')){
        abort(403);
    }
    switch ($target){
        case "owners":
            $users = User::all();
            $output = [];
            foreach ($users as $user){
                $output[] = $user->name;
            }
            echo trim(json_encode($output));
            break;
        case "shops":
            $shops = Shop::all();
            $output = [];
            foreach ($shops as $shop){
                $output[] = $shop->name;
            }
            echo trim(json_encode($output));
            break;
        default:
            abort(400);
    }
});
