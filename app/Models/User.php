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
        'user_code' => 'int',
        'user_no' => 'int',
        'status' => 'int',
    ];

    protected static function booted(): void {}

    public function getRememberToken()
    {
        return $this->login_token;
    }

    public function setRememberToken($value)
    {
        $this->login_token = $value;
    }

    public function viaRemember()
    {
        return ! is_null($this->login_token);
    }
}
