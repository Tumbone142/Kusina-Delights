<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $primaryKey = 'RecipeID';

    protected $fillable = [
        'chef_id',
        'RecipeTitle',
        'Description',
        'Ingredients',
        'VideoLink',
        'Instructions',
        'RecipePhoto',
        'Preparation',
        'CookingTime',
        'Difficulty',
        'Servings',
    ];

    public function chef()
    {
        return $this->belongsTo(Chef::class, 'chef_id', 'ChefID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'recipe_id', 'RecipeID');
    }
}
