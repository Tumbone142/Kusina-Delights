<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'FirstName',
        'MiddleName',
        'LastName',
        'ProfileImage',
        'Introduction',
        'Created_by'
    ];

    // Inverse of the one-to-one relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

