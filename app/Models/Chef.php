<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    protected $primaryKey = 'ChefID';

    protected $fillable = [
        'user_id',
        'Income',
        'Created_by',
    ];

    /**
     * Get the user associated with the chef.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the recipes created by the chef.
     */
    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'chef_id', 'ChefID');
    }
}
