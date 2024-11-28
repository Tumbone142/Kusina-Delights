<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'ReviewsID';

    protected $fillable = [
        'user_id',
        'recipe_id',
        'Star',
        'Review',
        'Created_by',
    ];

    /**
     * Relationship to the User who wrote the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship to the Recipe being reviewed.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'RecipeID');
    }
}
