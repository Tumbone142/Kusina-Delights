<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReviewController extends Controller
{
    // List all reviews
    public function index()
    {
        return Inertia::render('Reviews/Index', [
            'reviews' => Review::with(['user', 'recipe'])->paginate(10), // Paginate reviews for performance
        ]);
    }
    
    // Show a single review
    public function show($id)
    {
        $review = Review::with(['user', 'recipe'])->findOrFail($id);
        return Inertia::render('Reviews/Show', ['review' => $review]);
    }

    // Create a new review (Form)
    public function create()
    {
        // Optimize to fetch only necessary user and recipe data for form.
        $users = User::all(['id', 'name']); // You can also paginate users if the list is large.
        $recipes = Recipe::all(['RecipeID', 'RecipeTitle']);
        
        return Inertia::render('Reviews/Create', [
            'review' => new Review(),
            'users' => $users,
            'recipes' => $recipes,
        ]);
    }

    // Store a new review
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,RecipeID',
            'Star' => 'required|integer|min:1|max:5',
            'Review' => 'nullable|string',
        ]);

        // Check if the user has already reviewed this recipe
        if (Review::where('user_id', $validated['user_id'])->where('recipe_id', $validated['recipe_id'])->exists()) {
            return redirect()->back()->withErrors('You have already reviewed this recipe.');
        }

        // Create review
        Review::create($validated);

        return redirect()->route('reviews.index')->with('success', 'Review created successfully.');
    }

    // Edit an existing review (Form)
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        
        // Fetch only necessary data for editing.
        $users = User::all(['id', 'name']);
        $recipes = Recipe::all(['RecipeID', 'RecipeTitle']);

        return Inertia::render('Reviews/Edit', [
            'review' => $review,
            'users' => $users,
            'recipes' => $recipes,
        ]);
    }
    
    // Update an existing review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,RecipeID',
            'Star' => 'required|integer|min:1|max:5',
            'Review' => 'nullable|string',
        ]);

        // Update review
        $review->update($validated);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
