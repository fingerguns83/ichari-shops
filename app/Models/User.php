<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Shop;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'oauth_id',
        'oauth_unique',
        'avatar',
        'isAdmin',
        'isMod',
        'isBanned'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function discordNotif($message){
        $payload = "Message from **" . getenv('APP_NAME') . ":**\n*" . $message . "*";
        $response = Http::get('https://bot.ichari.net/notif.php', ['id' => $this->oauth_id, 'message' => $payload])->body();
        if (!strpos($response, "id")){
            $fallbacks = User::where('isAdmin', 1)->get();
            foreach ($fallbacks as $fallback){
                $payload = "Failed to deliver ```" . $message . "``` to " . $this->name;
                if ($fallback->id !== $this->id){
                    Http::get('https://bot.ichari.net/notif.php', ['id' => $fallback->oauth_id, 'message' => $payload]);
                }
            }
        }
    }

    public function shops(){
        $shopIds = DB::table('shop_has_users')
            ->where('user_id', $this->id)
            ->pluck('shop_id')
            ->toArray();
        $shops = Shop::whereIn('id', $shopIds)
            ->orderBy('name')
            ->get();
        return $shops;
    }
}
