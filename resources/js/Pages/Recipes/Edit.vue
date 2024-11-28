<template>
  <Layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-3xl font-semibold mb-6">Edit Recipe</h1>

      <!-- Display validation errors -->
      <div v-if="errors.length" class="mb-4">
        <ul class="text-red-600">
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>
      </div>

      <form @submit.prevent="submitForm" class="grid grid-cols-2 gap-6">
        <!-- Chef Selection -->
        <div>
          <label for="chef_id" class="block text-sm font-medium text-gray-700">Chef</label>
          <select id="chef_id" v-model="form.chef_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none">
            <option v-for="chef in chefs" :key="chef.ChefID" :value="chef.ChefID">{{ chef.user.name }}</option>
          </select>
        </div>

        <!-- Recipe Title -->
        <div>
          <label for="RecipeTitle" class="block text-sm font-medium text-gray-700">Recipe Title</label>
          <input type="text" id="RecipeTitle" v-model="form.RecipeTitle" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Description -->
        <div>
          <label for="Description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea id="Description" v-model="form.Description" rows="4" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <!-- Ingredients -->
        <div>
          <label for="Ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
          <textarea id="Ingredients" v-model="form.Ingredients" rows="4" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <!-- Recipe Photo -->
        <div>
          <label for="RecipePhoto" class="block text-sm font-medium text-gray-700">Recipe Photo</label>
          <input type="file" id="RecipePhoto" @change="handleFileUpload" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
          <div v-if="form.RecipePhoto">
            <img :src="previewImage" alt="Recipe Photo" class="mt-4 w-48 h-48 object-cover" />
          </div>
          <div v-if="recipe.RecipePhoto" class="mt-2">
            <img :src="`/storage/${recipe.RecipePhoto}`" alt="Current Recipe Photo" class="mt-4 w-48 h-48 object-cover" />
          </div>
        </div>

        <!-- Instructions -->
        <div>
          <label for="Instructions" class="block text-sm font-medium text-gray-700">Instructions</label>
          <textarea id="Instructions" v-model="form.Instructions" rows="4" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <!-- Preparation Time -->
        <div>
          <label for="Preparation" class="block text-sm font-medium text-gray-700">Preparation Time</label>
          <input type="text" id="Preparation" v-model="form.Preparation" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Cooking Time -->
        <div>
          <label for="CookingTime" class="block text-sm font-medium text-gray-700">Cooking Time (minutes)</label>
          <input type="number" id="CookingTime" v-model="form.CookingTime" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Difficulty -->
        <div>
          <label for="Difficulty" class="block text-sm font-medium text-gray-700">Difficulty</label>
          <input type="text" id="Difficulty" v-model="form.Difficulty" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Servings -->
        <div>
          <label for="Servings" class="block text-sm font-medium text-gray-700">Servings</label>
          <input type="number" id="Servings" v-model="form.Servings" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Buttons -->
        <div class="col-span-2 flex space-x-3 mt-6">
          <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:ring-2 focus:ring-orange-500">Update Recipe</button>
          <a href="/recipes">
            <button type="button" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:ring-2 focus:ring-gray-300">Cancel</button>
          </a>
        </div>
      </form>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '../../Layouts/backend.vue';

import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';


const props = defineProps({
  recipe: Object,
  chefs: Array,
});

const form = useForm({
  chef_id: props.recipe.chef_id || '',
  RecipeTitle: props.recipe.RecipeTitle || '',
  Description: props.recipe.Description || '',
  Ingredients: props.recipe.Ingredients || '',
  RecipePhoto: null,
  Instructions: props.recipe.Instructions || '',
  Preparation: props.recipe.Preparation || '',
  CookingTime: props.recipe.CookingTime || '',
  Difficulty: props.recipe.Difficulty || '',
  Servings: props.recipe.Servings || '',
});

const errors = ref([]);
const previewImage = ref(null);

onMounted(() => {
  if (props.recipe.RecipePhoto) {
    previewImage.value = `/storage/${props.recipe.RecipePhoto}`;
  }
});

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    previewImage.value = URL.createObjectURL(file);
    form.RecipePhoto = file;
  }
};

const submitForm = () => {
  form.put(route('recipes.update', props.recipe.RecipeID), {
    onFinish: () => errors.value = [],  // Reset errors on submit success
    onError: (error) => errors.value = error,  // Show errors if the form fails
  });
};
</script>

<style scoped>
/* Optional styling for better appearance */
</style>
