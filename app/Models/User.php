<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BaseModelTrait;

    protected $table = 't_user';

    protected $fillable = [
        'user_code',
        'user_no',
        'username',
        'nickname',
        'salt',
        'email',
        'phone',
        'open_id',
        'client_ip',
        'login_at',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'login_token',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'user_no' => 'int',
        'status' => 'int',
    ];

    protected static function booted(): void {}
}
