<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'social_id', 'social_type', 'social_avatar', 'default_avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatar($id)
    {
        $user = User::find($id);
        if($user->social_avatar){
            return $user->social_avatar;
        }else{
            if($user->default_avatar){
                return '/uploads/img/'.$user->default_avatar;
            }else{
                return '/uploads/offers/small/logo2.svg';
            }
        }
    }
}
