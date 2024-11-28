<template>
  <Layout>
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold text-gray-700">All Reviews</h2>
      <InertiaLink :href="'/reviews/create'" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg">New Review</InertiaLink>

    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="p-4 border-t">
        <!-- Column Headers -->
        <div class="flex mb-2 font-semibold text-gray-700">
          <div class="flex-1">User</div>
          <div class="flex-1">Recipe</div>
          <div class="flex-1">Star Rating</div>
          <div class="flex-1 text-center">Actions</div>
        </div>

        <!-- Check if reviews exist and loop over them -->
        <div v-if="reviews.data.length > 0" v-for="review in reviews.data" :key="review.ReviewsID" class="flex justify-between items-center py-3 border-b">
          <div class="flex-1">
            <p class="text-lg font-medium">{{ review.user.name }}</p>
          </div>
          <div class="flex-1">
            <p class="text-sm text-gray-500">{{ review.recipe.RecipeTitle }}</p>
          </div>
          <div class="flex-1">
            <p class="text-sm">{{ review.Star }}</p>
          </div>
          <div class="flex-1 text-center space-x-2">
            <InertiaLink :href="route('reviews.show', review.ReviewsID)" class="text-blue-500 hover:text-blue-700">View</InertiaLink>
            <InertiaLink :href="route('reviews.edit', review.ReviewsID)" class="text-yellow-500 hover:text-yellow-700">Edit</InertiaLink>
            <button @click="deleteReview(review.ReviewsID)" class="text-red-600 hover:text-red-800">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>

import { InertiaLink } from '@inertiajs/inertia-vue3';  // Import InertiaLink for navigation
import { Inertia } from '@inertiajs/inertia';
import { defineProps } from 'vue';
import Layout from '../../Layouts/backend.vue';

const props = defineProps({
  reviews: Object,
});

const deleteReview = (id) => {
  if (confirm('Are you sure you want to delete this review?')) {
    Inertia.delete(route('reviews.destroy', id));
  }
};
</script>
