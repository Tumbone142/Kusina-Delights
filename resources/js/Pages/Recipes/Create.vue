<template>
  <Layout>
    <h2 class="text-3xl font-semibold mb-8">Create Recipe</h2>

    <!-- Form -->
    <form @submit.prevent="submitForm" class="grid grid-cols-2 gap-6">

      <!-- Recipe Title -->
      <div>
        <label for="RecipeTitle" class="block text-gray-700 font-medium">Recipe Title<span class="text-red-500">*</span></label>
        <input v-model="form.RecipeTitle" type="text" id="RecipeTitle" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
      </div>

      <!-- Chef -->
      <div>
        <label for="chef_id" class="block text-gray-700 font-medium">Chef</label>
        <select v-model="form.chef_id" id="chef_id" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
          <option v-for="chef in chefs" :key="chef.ChefID" :value="chef.ChefID">{{ chef.user.name }}</option>
        </select>
      </div>

      <!-- Description -->
      <div>
        <label for="Description" class="block text-gray-700 font-medium">Description</label>
        <textarea v-model="form.Description" id="Description" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" rows="3"></textarea>
      </div>

      <!-- Ingredients -->
      <div>
        <label for="Ingredients" class="block text-gray-700 font-medium">Ingredients<span class="text-red-500">*</span></label>
        <textarea v-model="form.Ingredients" id="Ingredients" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" rows="3" required></textarea>
      </div>

      <!-- Instructions -->
      <div>
        <label for="Instructions" class="block text-gray-700 font-medium">Instructions<span class="text-red-500">*</span></label>
        <textarea v-model="form.Instructions" id="Instructions" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" rows="3" required></textarea>
      </div>

      <!-- Preparation Time -->
      <div>
        <label for="Preparation" class="block text-gray-700 font-medium">Preparation Time (minutes)</label>
        <input v-model="form.Preparation" type="text" id="Preparation" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
      </div>

      <!-- Cooking Time -->
      <div>
        <label for="CookingTime" class="block text-gray-700 font-medium">Cooking Time (minutes)</label>
        <input v-model="form.CookingTime" type="number" id="CookingTime" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
      </div>

      <!-- Difficulty -->
      <div>
        <label for="Difficulty" class="block text-gray-700 font-medium">Difficulty</label>
        <input v-model="form.Difficulty" type="text" id="Difficulty" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
      </div>

      <!-- Servings -->
      <div>
        <label for="Servings" class="block text-gray-700 font-medium">Servings</label>
        <input v-model="form.Servings" type="number" id="Servings" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
      </div>

      <!-- Recipe Photo -->
      <div>
        <label for="RecipePhoto" class="block text-gray-700 font-medium">Recipe Photo</label>
        <input type="file" @change="handleFileChange" id="RecipePhoto" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-500" />
      </div>

      <!-- Submit Button -->
      <div class="col-span-2 flex space-x-3 mt-6">
        <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:ring-2 focus:ring-orange-500">Create Recipe</button>
        <button type="button" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:ring-2 focus:ring-gray-300">Cancel</button>
      </div>

    </form>
  </Layout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Layout from '../../Layouts/backend.vue';

const props = defineProps({
  chefs: Array,
});

const form = useForm({
  RecipeTitle: '',
  chef_id: null,
  Description: '',
  Ingredients: '',
  Instructions: '',
  Preparation: '',
  CookingTime: null,
  Difficulty: '',
  Servings: null,
  RecipePhoto: null,
});

const handleFileChange = (event) => {
  form.RecipePhoto = event.target.files[0];
};

const submitForm = async () => {
  await form.post(route('recipes.store'), {
    preserveState: true,
    onFinish: () => {
      Inertia.visit(route('recipes.index'));
    },
  });
};
</script>
