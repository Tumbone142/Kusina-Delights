<template>
  <Layout>
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold text-gray-700">Recipes</h2>
      <InertiaLink :href="'/recipes/create'" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">New Recipe</InertiaLink>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-4 border-t">
        <!-- Column Headers -->
        <div class="flex mb-2 font-semibold text-gray-700">
          <div class="flex-1">Recipe Title</div>
          <div class="flex-1">Chef</div>
          <div class="flex-1">Cooking Time</div>
          <div class="flex-1">Servings</div>
          <div class="flex-1 text-center">Actions</div>
        </div>

        <!-- Check if recipes exist and loop over them -->
        <div v-if="recipes.length > 0" v-for="recipe in recipes" :key="recipe.RecipeID" class="flex justify-between items-center py-3 border-b">
          <div class="flex-1">
            <p class="text-lg font-medium">{{ recipe.RecipeTitle }}</p>
          </div>
          <div class="flex-1">
            <p class="text-sm text-gray-500">{{ recipe.chef?.user?.name || 'Unknown Chef' }}</p>
          </div>
          <div class="flex-1">
            <p class="text-sm">{{ recipe.CookingTime }} min</p>
          </div>
          <div class="flex-1">
            <p class="text-sm">{{ recipe.Servings }} servings</p>
          </div>
          <div class="flex-1 text-center">
            <InertiaLink :href="'/recipes/' + recipe.RecipeID + '/edit'" class="text-blue-500 hover:text-blue-700">Edit</InertiaLink>
            <InertiaLink :href="'/recipes/' + recipe.RecipeID + '/show'" class="text-gray-500 hover:text-gray-700">View</InertiaLink>
            <form :action="route('recipes.destroy', recipe.RecipeID)" method="POST" @submit.prevent="deleteRecipe(recipe.RecipeID)">
              <InertiaLink class="text-red-600 hover:text-red-800 cursor-pointer" @click="deleteRecipe(recipe.RecipeID)">
                Delete
              </InertiaLink>
            </form>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../../Layouts/backend.vue';
import { Inertia } from '@inertiajs/inertia';  // Import Inertia for handling the delete request
import { InertiaLink } from '@inertiajs/inertia-vue3';  // Import InertiaLink for navigation

// Define props for the component
defineProps({
  recipes: Array, // Pass recipes from parent component
});

// Delete method to handle recipe deletion
const deleteRecipe = async (recipeId) => {
  // Confirm deletion
  if (confirm('Are you sure you want to delete this recipe?')) {
    // Perform the delete action using Inertia's delete method
    await Inertia.delete(route('recipes.destroy', recipeId));
  }
};
</script>

<style scoped>
/* Optional custom styles can be added here */
</style>
