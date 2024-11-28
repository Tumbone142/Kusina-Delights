
  <template>
    <div class="app-layout">
      <div class="max-w-full  mx-auto flex h-screen">
        <!-- Sidebar -->
        <Sidebar />
  
        <!-- Main Content -->
        <main class="flex-1 pl-10 pr-10 pt-5 overflow-y-auto">
          <Header />
          <slot></slot> <!-- This slot will be replaced with content passed from Blade -->
        </main>
      </div>
    </div>
  </template>
  
  <script>
  import Sidebar from '../Components/backend/Sidebar.vue';
  import Header from '../Components/backend/Header.vue';
  
  export default {
    components: {
        Sidebar,
        Header,
    },
  };
  </script>
  