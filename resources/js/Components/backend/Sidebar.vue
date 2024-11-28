<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
const logoPath = '/storage/logo3.png' // Adjust this to the correct path for the logo

// Extract the `url` from the `usePage()` hook
const { url } = usePage()

// Safely extract the path from the `url` object
const currentUrl = typeof url === 'string' ? url : (url?.path || '')

// Helper function to check if the current URL starts with a specific base path
const isActive = (basePath) => currentUrl.startsWith(basePath)
</script>

<template>
  <div class="sidebar">
    <div class="bg-yellow-300 w-64 min-h-screen bg-white shadow-md">
      <div class="flex items-center px-6 py-4 ">
        <!-- Logo Image -->
        <img :src="logoPath" alt="Logo" class="h-14" />
        <h1 class="ml-3 text-lg font-bold">Kusina Delights</h1>
      </div>
      <nav class="mt-6">
        <!-- Dashboard Link -->
        <a 
          href="/dashboard" 
          :class="['flex items-center px-6 py-3 font-semibold', 
                  isActive('/dashboard') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100']"
        >
          <i class="fas fa-home mr-3"></i> Dashboard
        </a>

        <!-- Recipes Link -->
        <a 
          href="/recipes" 
          :class="['flex items-center px-6 py-3', 
                  isActive('/recipes') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100']"
        >
          <i class="fas fa-clipboard mr-3"></i> Recipes
        </a>

        <!-- Reviews Link -->
        <a 
          href="/reviews" 
          :class="['flex items-center px-6 py-3', 
                  isActive('/reviews') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100']"
        >
          <i class="fas fa-star mr-3"></i> Reviews
        </a>

        <!-- Users Link -->
        <a 
          href="/users" 
          :class="['flex items-center px-6 py-3', 
                  isActive('/users') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100']"
        >
          <i class="fas fa-users mr-3"></i> Users
        </a>
      </nav>
    </div>
  </div>
</template>
