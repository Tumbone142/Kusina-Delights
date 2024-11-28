<template>
  <Layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
      <h1 class="text-3xl font-semibold text-gray-900 mb-8">Create New Review</h1>

      <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">

        <div>
          <label for="user_id" class="block text-gray-700 font-medium">User</label>
          <select v-model="form.user_id" id="user_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
        </div>

        <div>
          <label for="recipe_id" class="block text-gray-700 font-medium">Recipe</label>
          <select v-model="form.recipe_id" id="recipe_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            <option v-for="recipe in recipes" :key="recipe.RecipeID" :value="recipe.RecipeID">{{ recipe.RecipeTitle }}</option>
          </select>
        </div>

        <div>
          <label for="Star" class="block text-gray-700 font-medium">Star Rating</label>
          <input v-model="form.Star" type="number" id="Star" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" min="1" max="5" required />
        </div>

        <div>
          <label for="Review" class="block text-gray-700 font-medium">Review</label>
          <textarea v-model="form.Review" id="Review" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <div class="col-span-2 flex space-x-3 mt-6">
          <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:ring-2 focus:ring-orange-500">Save Review</button>
          <inertia-link :href="route('reviews.index')" class="inline-block px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:ring-2 focus:ring-gray-300">Cancel</inertia-link>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script setup>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';

import Layout from '../../Layouts/backend.vue';
import { defineProps } from 'vue';

const props = defineProps({
  users: Array,
  recipes: Array,
});

const form = reactive({
  user_id: '',
  recipe_id: '',
  Star: 1,
  Review: '',
});

const submit = () => {
  Inertia.post(route('reviews.store'), form);
};
</script>
