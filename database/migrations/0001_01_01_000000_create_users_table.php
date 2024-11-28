<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Keep the default primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('Roles', ['admin', 'chef', 'user'])->default('user'); // Add Roles column
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id('ProfileID');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Cascade delete on user deletion
            $table->string('FirstName', 100);
            $table->string('MiddleName', 100)->nullable();
            $table->string('LastName', 100);
            $table->string('ProfileImage', 255)->nullable();
            $table->text('Introduction')->nullable();
            $table->timestamps();
            $table->foreignId('Created_by')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::create('chefs', function (Blueprint $table) {
            $table->id('ChefID');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Cascade delete on user deletion
            $table->decimal('Income', 10, 2)->default(0);
            $table->timestamps();
            $table->foreignId('Created_by')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->id('RecipeID');
            $table->foreignId('chef_id')
                ->constrained('chefs', 'ChefID')
                ->onDelete('cascade'); // Cascade delete on chef deletion
            $table->string('RecipeTitle', 255);
            $table->text('Description')->nullable();
            $table->text('Ingredients');
            $table->string('VideoLink', 255)->nullable();
            $table->text('Instructions');
            $table->string('RecipePhoto', 255)->nullable();
            $table->string('Preparation', 255)->nullable();
            $table->integer('CookingTime')->nullable(); // in minutes
            $table->string('Difficulty', 50)->nullable();
            $table->integer('Servings')->nullable();
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ReviewsID');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Cascade delete on user deletion
            $table->foreignId('recipe_id')
                ->constrained('recipes', 'RecipeID')
                ->onDelete('cascade'); // Cascade delete on recipe deletion
            $table->integer('Star')->unsigned()->check('Star >= 1 and Star <= 5');
            $table->text('Review')->nullable();
            $table->timestamps();
            $table->foreignId('Created_by')->nullable()->constrained('users')->onDelete('set null');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('users')->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('chefs');
        Schema::dropIfExists('user_profiles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
