<template>
  <Layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <h1 class="text-3xl font-semibold text-gray-900">Review Details</h1>

      <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
        <div class="text-lg font-semibold text-gray-800">User</div>
        <p class="text-gray-600">{{ review.user.name }}</p>

        <div class="mt-4 text-lg font-semibold text-gray-800">Recipe</div>
        <p class="text-gray-600">{{ review.recipe.RecipeTitle }}</p>

        <div class="mt-4 text-lg font-semibold text-gray-800">Star Rating</div>
        <p class="text-gray-600">{{ review.Star }}</p>

        <div class="mt-4 text-lg font-semibold text-gray-800">Review</div>
        <p class="text-gray-600">{{ review.Review || 'No review text provided.' }}</p>
      </div>

      <InertiaLink :href="route('reviews.index')" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">Back to List</InertiaLink>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../../Layouts/backend.vue';
import { Inertia } from '@inertiajs/inertia';  // Import Inertia for handling the delete request
import { defineProps } from 'vue';

const props = defineProps({
  review: Object,
});
</script>
