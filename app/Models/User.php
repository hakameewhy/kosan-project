<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // app/Models/User.php
    public function profile()
    {
    return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'email',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}