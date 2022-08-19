<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'status',
        'type',
        'blurb',
        'location',
        'area',
        'inventory',
        'description'
    ];

    public function owners($return_obj = true, $exclude = ''){
        $userIds = DB::table('shop_has_users')
            ->where('shop_id', $this->id)
            ->pluck('user_id')
            ->toArray();
        if ($exclude){
            if (($key = array_search($exclude, $userIds)) !== false) {
                unset($userIds[$key]);
            }
        }
        $users = User::whereIn('id', $userIds)
            ->orderBy('name')
            ->get();
        if ($return_obj){
            return $users;
        }
        else {
            return $userIds;
        }
    }
    public function isOwner($user_id){
        $ownerIds = DB::table('shop_has_users')
            ->where('shop_id', $this->id)
            ->pluck('user_id')
            ->toArray();
        if (in_array($user_id, $ownerIds)){
            return true;
        }
        else {
            return false;
        }
    }
    public function last_update(){
        $timestamp = $this->updated_at->format('Y/m/d');
        return $timestamp;
    }
}
