<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use App\Models\Recipe;

use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $recipes = Recipe::take(3)->get(); // Limit to 3 recipes or adjust as needed
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'recipes' => $recipes, // Pass recipes to the view
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);



Route::get('/storage/{file}', function ($file) {
    return response()->file(storage_path("app/public/{$file}"));
})->name('storage');


Route::resource('users', UserController::class);
Route::resource('recipes', RecipeController::class);
Route::resource('reviews', ReviewController::class);


Route::get('/1', function () {
    return Inertia::render('Webpages/Recipes');  // Path relative to 'resources/js/Pages/'
});

Route::get('/2', function () {
    return Inertia::render('Webpages/AboutUs');  // Path relative to 'resources/js/Pages/'
});

Route::get('/3', function () {
    return Inertia::render('Webpages/ViewRecipe');  // Path relative to 'resources/js/Pages/'
});








require __DIR__.'/auth.php';
