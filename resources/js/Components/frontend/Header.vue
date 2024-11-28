<template>
    <header class="bg-white text-black-100 font-sans shadow-md">
      <div class="bg-yellow-300 h-[30px]"></div>
      <div class="container mx-auto px-4 flex justify-between items-center h-[113px]">
        <a href="/" class="flex items-center space-x-4 text-normal  white-shadow">
            <img :src="logo" alt="Logo" class="h-20" />
            <span>Kusina Delights</span>
        </a>

        <nav class="hidden md:flex space-x-6 font-bold text-normal ">
          <a href="/" class="hover:text-gray-500">Home</a>
          <a href="/1" class="hover:text-gray-500">Recipes</a>
          <a href="/2" class="hover:text-gray-500">About Us</a>
        </nav>
        <div class="flex flex-col items-end space-y-2">
          <div class="flex space-x-4 text-sm font-bold text-small">
            <a href="/login" class="hover:text-gray-500">Login</a>
            <span>|</span>
            <a href="/register" class="hover:text-gray-500">Sign Up</a>
          </div>
          <form action="#" method="GET" class="flex items-center bg-gray-100 border border-gray-300 rounded-3xl px-2 py-2">
            <button type="submit" class="text-gray-600 px-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                  <circle cx="10" cy="10" r="6" stroke="currentColor" stroke-width="2" />
                  <line x1="16" y1="16" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              </svg>
            </button>
            <input type="text" name="search" placeholder="Search..." class=" text-small px-2 w-40" />
          </form>
        </div>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    data() {
      return {
        logo: '/storage/logo3.png', // Adjust this based on your public path
      };
    },
  };
  </script>
  