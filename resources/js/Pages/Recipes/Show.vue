<template>
  <Layout>
    <h2 class="text-3xl font-semibold mb-8">Recipe Details</h2>

    <!-- Recipe Details Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Recipe Title & Chef Info -->
      <div>
        <h3 class="text-2xl font-bold mb-2">{{ recipe.RecipeTitle }}</h3>
        <p class="text-lg text-gray-700">Chef: <span class="font-semibold">{{ recipe.chef.user.name }}</span></p>
        <p class="text-sm text-gray-500">{{ recipe.chef.user.email }}</p>
      </div>

      <!-- Recipe Image -->
      <div class="flex justify-center md:justify-start">
        <div v-if="recipe.RecipePhoto" class="max-w-full w-96 h-auto">
          <img :src="`/storage/${recipe.RecipePhoto}`" alt="Recipe Photo" class="w-full rounded-lg shadow-lg" />
        </div>
      </div>

    </div>

    <!-- Description & Instructions Section -->
    <div class="mt-8">
      <h3 class="text-xl font-semibold mb-2">Description</h3>
      <p class="text-gray-700">{{ recipe.Description }}</p>
    </div>

    <div class="mt-6">
      <h3 class="text-xl font-semibold mb-2">Ingredients</h3>
      <p class="text-gray-700">{{ recipe.Ingredients }}</p>
    </div>

    <div class="mt-6">
      <h3 class="text-xl font-semibold mb-2">Instructions</h3>
      <p class="text-gray-700">{{ recipe.Instructions }}</p>
    </div>

    <!-- Additional Info Section -->
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div>
        <p><strong class="font-semibold">Preparation Time:</strong> {{ recipe.Preparation }} minutes</p>
      </div>
      <div>
        <p><strong class="font-semibold">Cooking Time:</strong> {{ recipe.CookingTime }} minutes</p>
      </div>
      <div>
        <p><strong class="font-semibold">Difficulty:</strong> {{ recipe.Difficulty }}</p>
      </div>
      <div>
        <p><strong class="font-semibold">Servings:</strong> {{ recipe.Servings }}</p>
      </div>
    </div>

    <!-- Video Tutorial Section -->
    <div v-if="recipe.VideoLink" class="mt-6">
      <h3 class="text-xl font-semibold mb-2">Video Tutorial</h3>
      <a :href="recipe.VideoLink" target="_blank" class="text-blue-600 underline">Watch here</a>
    </div>

    <!-- Reviews Section -->
    <div v-if="recipe.reviews && recipe.reviews.length > 0" class="mt-8">
      <h3 class="text-xl font-semibold mb-4">Reviews</h3>
      <ul class="space-y-4">
        <li v-for="review in recipe.reviews" :key="review.id" class="border-b pb-4">
          <p class="text-lg font-semibold">{{ review.user.name }}</p>
          <p class="text-sm text-gray-600">Rating: {{ review.rating }} stars</p>
          <p class="text-gray-700">{{ review.comment }}</p>
        </li>
      </ul>
    </div>
  </Layout>
</template>

<script>
export default {
  props: {
    recipe: Object, // The recipe object passed from the controller
  }
}
</script>

<style scoped>
/* Add any custom styling here */
</style>
