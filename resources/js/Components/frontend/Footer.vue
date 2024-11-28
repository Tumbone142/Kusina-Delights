<template>
    <footer class="bg-yellow-300 text-black-100 font-sans border-t border-gray-300 h-[273px]">
      <div class="container mx-auto px-4 py-8 flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 h-full text-[26px]">
        <a href="#" class="flex items-center space-x-4 font-bold">
          <img :src="logo" alt="Logo" class="h-20" />
          <span class="text-large">Kusina Delights</span>
        </a>
        <div class="flex flex-col justify-center">
          <h7 class="font-bold mb-2 text-normal">Our Socials</h7>
          <div class="flex space-x-4">
            <SocialIcon icon="facebook-f" />
            <SocialIcon icon="twitter" />
            <SocialIcon icon="youtube" />
            <SocialIcon icon="pinterest" />
          </div>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  import SocialIcon from './SocialIcon.vue'; // Import the SocialIcon component
  
  export default {
    components: {
      SocialIcon,
    },
    data() {
      return {
        logo: '/storage/logo3.png', // Adjust this based on your public path
      };
    },
  };
  </script>
  