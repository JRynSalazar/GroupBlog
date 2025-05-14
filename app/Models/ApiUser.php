<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class ApiUser extends Authenticatable
{


     use HasApiTokens, Notifiable, HasFactory;

    // 🛠 Tell Laravel to use the 'users' table
    protected $table = 'users';

    // 🛠 If you're using 'user_id' as primary key
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'email',
        'password',
        'user_type',
        'bio',
        'profile_image',
        'email_verified_at'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
