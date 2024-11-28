<template>
    <Layout>
      <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">User Details</h1>
        <div class="grid grid-cols-2 gap-6">
          <!-- User Details -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.name }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.email }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.Roles }}
            </p>
          </div>
  
          <!-- Profile Details -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">First Name</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.profile?.FirstName || "N/A" }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Last Name</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.profile?.LastName || "N/A" }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.profile?.MiddleName || "N/A" }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Introduction</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.profile?.Introduction || "N/A" }}
            </p>
          </div>
  
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Profile Image</label>
            <div class="mt-2">
              <img
                v-if="user.profile?.ProfileImage"
                :src="route('storage', user.profile.ProfileImage)"
                alt="Profile Image"
                class="w-20 h-20 rounded-full object-cover"
              />
              <p v-else class="text-gray-500">No image uploaded</p>
            </div>
          </div>
  
          <!-- Chef Details (Only visible if role is 'chef') -->
          <div v-if="user.Roles === 'chef'" class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Income</label>
            <p class="mt-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
              {{ user.chef?.Income || "N/A" }}
            </p>
          </div>
        </div>
  
        <div class="mt-6 flex justify-center">
          <InertiaLink
            :to="route('users.index')"
            class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400"
          >
            Back to Users
          </InertiaLink>
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  import { InertiaLink } from '@inertiajs/inertia-vue3';
  import { Inertia } from '@inertiajs/inertia';
  import Layout from '../../Layouts/backend.vue';
  import { useForm } from '@inertiajs/inertia-vue3';
  import { ref, onMounted } from 'vue';

  const props = defineProps({
    user: Object,
    });
  </script>
  