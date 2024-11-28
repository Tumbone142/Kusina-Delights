<template>
    <Layout>
      <div class="relative h-[362px]">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://c.animaapp.com/IjUIznOY/img/hero-image-1.png'); filter: brightness(0.5);"></div>
        <div class="flex items-center justify-center h-full relative">
          <p class="text-white text-center px-4 text-large font-bold drop-shadow-xl white-shadow">
            Discover and savor the rich flavors of Filipino snack culture at Kusina Delights!
          </p>
        </div>
      </div>

      <div class="p-10 mx-auto max-w-[80%] mt-10">
          <p class="text-black-100 text-center text-large font-bold drop-shadow-lg mb-2">
              About Us
          </p>
          <p class="text-black-100 text-center text-normal drop-shadow-lg">
              Welcome to Kusina Delights, your ultimate destination for exploring the mouthwatering snacks of the Philippines! Our mission is to celebrate the rich culinary heritage of Filipino cuisine by showcasing a delightful array of traditional snacks that bring families and friends together. From crispy chips to sweet treats, each recipe is crafted with love and passion, reflecting the vibrant flavors and unique ingredients that make Filipino snacks so special. Join us on this delicious journey as we share our favorite recipes, cooking tips, and stories behind these beloved snacks, inviting you to savor the taste of the Philippines, one bite at a time.
          </p>


          <p class="text-black-100 text-center text-large drop-shadow-lg mb-2 mt-20">
              Team members
          </p>

          <div class="flex justify-center gap-20">
              <div class="w-80 bg-white rounded-lg shadow-lg p-6 text-center">
                  <!-- Profile Image -->
                  <img class="w-52 h-52 rounded-2xl mx-auto mb-4" src="https://c.animaapp.com/FBD9Sly2/img/profile-picture-2@2x.png" alt="Profile Image">
                  
                  <!-- Name and Title -->
                  <h2 class="text-normal font-semibold text-black-100">Alejandro A. Cayasa</h2>
                  <p class="text-black-100 text-small">Project Designer</p>
                  
                  <!-- Social Media Icons -->
                  <div class="flex justify-center gap-4 mt-4">
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-2xl hover:bg-yellow-500 transition">
                          <i class="fab fa-facebook-f text-2xl"></i>
                      </a>
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-2xl hover:bg-yellow-500 transition">
                          <i class="fab fa-github text-2xl"></i>
                      </a>
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-2xl hover:bg-yellow-500 transition">
                          <i class="fab fa-linkedin-in text-2xl"></i>
                      </a>
                  </div>
              </div>

              <div class="w-80 bg-white rounded-lg shadow-lg p-6 text-center">
                  <!-- Profile Image -->
                  <img class="w-52 h-52 rounded-2xl mx-auto mb-4" src="https://c.animaapp.com/FBD9Sly2/img/profile-picture-2@2x.png" alt="Profile Image">
                  
                  <!-- Name and Title -->
                  <h2 class="text-normal font-semibold text-black-100">Alejandro A. Cayasa</h2>
                  <p class="text-black-100 text-small">Project Designer</p>
                  
                  <!-- Social Media Icons -->
                  <div class="flex justify-center gap-4 mt-4">
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-xl hover:bg-yellow-500 transition">
                          <i class="fab fa-facebook-f text-2xl"></i>
                      </a>
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-xl hover:bg-yellow-500 transition">
                          <i class="fab fa-github text-2xl"></i>
                      </a>
                      <a href="#" class="bg-yellow-100 text-black-100 p-4 rounded-xl hover:bg-yellow-500 transition">
                          <i class="fab fa-linkedin-in text-2xl"></i>
                      </a>
                  </div>
              </div>
          </div>


      </div>


    </Layout>
  </template>
  
  <script>
import Layout from '../../Layouts/frontend.vue';
  
  export default {
    components: {
      Layout,
    },
  };
  </script>
  