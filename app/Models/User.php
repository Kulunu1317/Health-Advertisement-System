<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'profile_photo', 'birthday', 'telephone', 'is_approved', 'is_admin'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
            'is_approved' => 'boolean',
            'is_admin' => 'boolean',
        ];
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class);
    }

    public function renewalRequests()
    {
        return $this->hasMany(RenewalRequest::class);
    }

    public function timeExtensionRequests()
    {
        return $this->hasMany(TimeExtensionRequest::class);
    }
}