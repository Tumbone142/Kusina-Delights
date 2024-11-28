<template>
    <div>
      <Header />
      <main class="min-h-screen">
        <slot />
      </main>
      <Footer />
    </div>
  </template>
  
  <script>
  import Header from '../Components/frontend/Header.vue';
  import Footer from '../Components/frontend/Footer.vue';
  
  export default {
    components: {
      Header,
      Footer,
    },
  };
  </script>
  