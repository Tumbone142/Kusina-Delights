<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-3xl font-semibold text-gray-900 mb-6">Edit Review</h1>

      <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
        <div>
          <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
          <select v-model="form.user_id" id="user_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
        </div>

        <div>
          <label for="recipe_id" class="block text-sm font-medium text-gray-700">Recipe</label>
          <select v-model="form.recipe_id" id="recipe_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            <option v-for="recipe in recipes" :key="recipe.RecipeID" :value="recipe.RecipeID">{{ recipe.RecipeTitle }}</option>
          </select>
        </div>

        <div>
          <label for="Star" class="block text-sm font-medium text-gray-700">Star Rating</label>
          <input v-model="form.Star" type="number" id="Star" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" min="1" max="5" required />
        </div>

        <div>
          <label for="Review" class="block text-sm font-medium text-gray-700">Review</label>
          <textarea v-model="form.Review" id="Review" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <div class="col-span-2 flex space-x-3 mt-6">
          <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:ring-2 focus:ring-orange-500">Update Review</button>
          <InertiaLink :href="route('reviews.index')" class="inline-block px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:ring-2 focus:ring-gray-300">Cancel</InertiaLink>
        </div>
      </form>
    </div>
  </Layout>
</template>


<script setup>
import Layout from '../../Layouts/backend.vue';

import { defineProps, reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';  // Import Inertia for handling the delete request

const props = defineProps({
  review: Object,
  users: Array,
  recipes: Array,
});

const form = reactive({
  user_id: props.review.user_id,
  recipe_id: props.review.recipe_id,
  Star: props.review.Star,
  Review: props.review.Review,
});

const submit = () => {
  Inertia.put(route('reviews.update', props.review.ReviewsID), form);
};
</script>
