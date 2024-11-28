<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Chef;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;  // Import the Log facade

class RecipeController extends Controller
{
    // Display a list of all recipes with their associated chefs
    public function index()
    {
        $recipes = Recipe::with('chef.user')->get(); // Ensure chef and user are eager-loaded
        return Inertia::render('Recipes/Index', ['recipes' => $recipes]);
    }
    

    // Show the form for creating a new recipe
    public function create()
    {
        $chefs = Chef::with('user')->get(); // Eager load the user relationship
        return Inertia::render('Recipes/Create', ['chefs' => $chefs]); // Pass chefs with user info to frontend
    }

    // Store a new recipe in the database
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'chef_id' => 'required|exists:chefs,ChefID',
            'RecipeTitle' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Ingredients' => 'required|string',
            'VideoLink' => 'nullable|url',
            'Instructions' => 'required|string',
            'RecipePhoto' => 'nullable|image|max:2048',
            'Preparation' => 'nullable|string|max:255',
            'CookingTime' => 'nullable|integer',
            'Difficulty' => 'nullable|string|max:50',
            'Servings' => 'nullable|integer',
        ]);

        // Handle file upload if RecipePhoto is provided
        if ($request->hasFile('RecipePhoto')) {
            $validated['RecipePhoto'] = $request->file('RecipePhoto')->store('recipes', 'public');
        }

        // Create the recipe in the database
        Recipe::create($validated);

        // Redirect to the recipe index page
        return redirect()->route('recipes.index');
    }

    // Display a specific recipe and its reviews

    public function show(Recipe $recipe)
    {
        $chefs = Chef::with('user')->get();
        return Inertia::render('Recipes/Show', [
            'recipe' => $recipe->toArray(), // Make sure this includes all fields, especially 'id'
            'chefs' => $chefs,
        ]);
    }

    
    // Show the form to edit an existing recipe
    public function edit(Recipe $recipe)
    {
        $chefs = Chef::with('user')->get();
        return Inertia::render('Recipes/Edit', [
            'recipe' => $recipe->toArray(), // Make sure this includes all fields, especially 'id'
            'chefs' => $chefs,
        ]);
    }
    
    
    

    // Update an existing recipe in the database
    public function update(Request $request, Recipe $recipe)
    {
        try {
            // Log the incoming request to see if 'chef_id' is being sent correctly
            Log::info('Incoming update request:', $request->all());
    
            // Validate input data
            $validated = $request->validate([
                'chef_id' => 'required|exists:chefs,ChefID',
                'RecipeTitle' => 'required|string|max:255',
                'Description' => 'nullable|string',
                'Ingredients' => 'required|string',
                'VideoLink' => 'nullable|url',
                'Instructions' => 'required|string',
                'RecipePhoto' => 'nullable|image|max:2048',  // Optional image validation
                'Preparation' => 'nullable|string|max:255',
                'CookingTime' => 'nullable|integer',
                'Difficulty' => 'nullable|string|max:50',
                'Servings' => 'nullable|integer',
            ]);
    
            // Log the validated data
            Log::info('Validated data:', $validated);
    
            // Handle file upload if RecipePhoto is provided
            if ($request->hasFile('RecipePhoto')) {
                // Delete old photo if it exists
                if ($recipe->RecipePhoto) {
                    Storage::delete('public/' . $recipe->RecipePhoto);
                }
                // Store the new photo
                $validated['RecipePhoto'] = $request->file('RecipePhoto')->store('recipes', 'public');
            } else {
                // If no new photo, keep the old one
                $validated['RecipePhoto'] = $recipe->RecipePhoto;
            }
    
            // Update the recipe with validated data
            $recipe->update($validated);
    
            // Redirect to the recipe index page
            return redirect()->route('recipes.index');
        } catch (\Exception $e) {
            // Log any error that occurs
            Log::error('Error updating recipe: ' . $e->getMessage(), [
                'request' => $request->all(),
                'recipe' => $recipe->toArray(),
                'exception' => $e
            ]);
    
            // Redirect back with an error message
            return back()->withErrors('An error occurred while updating the recipe.');
        }
    }
    
    
    
    

    // Delete a recipe from the database
    public function destroy(Recipe $recipe)
    {
        // Delete the recipe's photo if it exists
        if ($recipe->RecipePhoto) {
            Storage::delete('public/' . $recipe->RecipePhoto);
        }

        // Delete the recipe record
        $recipe->delete();

        // Redirect to the recipe index page
        return redirect()->route('recipes.index');
    }
}
