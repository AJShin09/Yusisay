<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
 
    public function getProfilePicture()
    {
        if ($this->userInfo && $this->userInfo->profile_picture) {
            return asset('assets/' . $this->userInfo->profile_picture);
        }
        return null;
    }
}
