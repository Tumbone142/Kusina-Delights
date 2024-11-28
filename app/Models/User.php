<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Roles',  // Include the Roles field for mass assignment
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
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    /**
     * Check if the user has an admin role.
     */



    public function isAdmin()
    {
        return $this->Roles === 'admin';
    }

    /**
     * Check if the user has a chef role.
     */
    public function isChef()
    {
        return $this->Roles === 'chef';
    }

    /**
     * Check if the user has a user role.
     */
    public function isUser()
    {
        return $this->Roles === 'user';
    }


    public function chef()
    {
        return $this->hasOne(Chef::class, 'user_id');
    }

}
