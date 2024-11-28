<template>
  <Layout>
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg">
      <h1 class="text-3xl font-semibold text-center mb-8">Create User</h1>
      <form @submit.prevent="submitForm" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">

        <!-- Name -->
        <div>
          <label for="name" class="block text-gray-700 font-medium">Name<span class="text-red-500">*</span></label>
          <input v-model="form.name" id="name" type="text" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-700 font-medium">Email</label>
          <input v-model="form.email" id="email" type="email" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-gray-700 font-medium">Password</label>
          <input v-model="form.password" id="password" type="password" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
          <input v-model="form.password_confirmation" id="password_confirmation" type="password" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Role -->
        <div>
          <label for="role" class="block text-gray-700 font-medium">Role</label>
          <select v-model="form.role" id="role" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            <option value="admin">Admin</option>
            <option value="chef">Chef</option>
            <option value="user" selected>User</option>
          </select>
        </div>

        <!-- Income (only for chef role) -->
        <div v-if="form.role === 'chef'" >
          <label for="income" class="block text-gray-700 font-medium">Income</label>
          <input readonly v-model="form.chef.income" id="income" type="number" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- First Name -->
        <div>
          <label for="first_name" class="block text-gray-700 font-medium">First Name</label>
          <input v-model="form.profile.first_name" id="first_name" type="text" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Last Name -->
        <div>
          <label for="last_name" class="block text-gray-700 font-medium">Last Name</label>
          <input v-model="form.profile.last_name" id="last_name" type="text" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" required />
        </div>

        <!-- Middle Name -->
        <div>
          <label for="middle_name" class="block text-gray-700 font-medium">Middle Name</label>
          <input v-model="form.profile.middle_name" id="middle_name" type="text" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Introduction -->
        <div>
          <label for="introduction" class="block text-gray-700 font-medium">Introduction</label>
          <textarea v-model="form.profile.introduction" id="introduction" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:outline-none"></textarea>
        </div>

        <!-- Profile Image -->
        <div>
          <label for="profile_image" class="block text-gray-700 font-medium">Profile Image</label>
          <input ref="profile_image" @change="handleImageChange" id="profile_image" type="file" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-gray-500 focus:ring-2 focus:ring-orange-500 focus:outline-none" />
        </div>

        <!-- Submit Button -->
        <div class="col-span-2 flex justify-center mt-6">
          <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:ring-2 focus:ring-orange-500">Create User</button>
        </div>

      </form>
    </div>
  </Layout>
</template>


<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Layout from '../../Layouts/backend.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'user',
  chef: { income: '0.00' },
  profile: { first_name: '', last_name: '', middle_name: '', introduction: '', profile_image: null },
});

const handleImageChange = (event) => {
  form.profile.profile_image = event.target.files[0];
};

const buildFormData = () => {
  const formData = new FormData();
  formData.append('name', form.name);
  formData.append('email', form.email);
  formData.append('password', form.password);
  formData.append('password_confirmation', form.password_confirmation);
  formData.append('role', form.role);
  if (form.role === 'chef') formData.append('chef_income', form.chef.income);
  formData.append('profile[first_name]', form.profile.first_name);
  formData.append('profile[last_name]', form.profile.last_name);
  formData.append('profile[middle_name]', form.profile.middle_name);
  formData.append('profile[introduction]', form.profile.introduction);
  if (form.profile.profile_image) formData.append('profile[profile_image]', form.profile.profile_image);
  return formData;
};

const submitForm = () => {
  form.post(route('users.store'), { data: buildFormData() });
};
</script>
