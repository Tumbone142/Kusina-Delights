<script setup>
import Layout from '../Layouts/backend.vue';

</script>

<template>
    <Layout>

        <!-- Welcome and Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Welcome Card -->
            <div class="col-span-2 flex items-center p-6 bg-white rounded-lg shadow">
            <div class="w-12 h-12 bg-gray-800 text-white flex items-center justify-center rounded-full font-semibold mr-4">A</div>
            <div>
                <p class="font-bold">Welcome</p>
                <p class="text-sm text-gray-500">Admin</p>
            </div>
            <button class="ml-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-2"></i> Sign out
            </button>
            </div>

            <!-- Stats Cards -->
            <div class="p-6 bg-white rounded-lg shadow">
            <p class="text-sm text-gray-500">Viewers</p>
            <p class="text-2xl font-bold text-gray-800">18,000 viewers</p>
            <p class="text-sm text-green-500 mt-2 flex items-center">
                <span>1,000 increase</span>
                <i class="fas fa-arrow-up ml-1"></i>
            </p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
            <p class="text-sm text-gray-500">Posts</p>
            <p class="text-2xl font-bold text-gray-800">3 posts</p>
            <p class="text-sm text-red-500 mt-2 flex items-center">
                <span>10% decrease</span>
                <i class="fas fa-arrow-down ml-1"></i>
            </p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
            <p class="text-sm text-gray-500">Comments</p>
            <p class="text-2xl font-bold text-gray-800">10 comments</p>
            <p class="text-sm text-green-500 mt-2 flex items-center">
                <span>5 increase</span>
                <i class="fas fa-arrow-up ml-1"></i>
            </p>
            </div>
        </div>

        <!-- User Growth Chart -->
        <div class="p-6 bg-white rounded-lg shadow">
            <h3 class="text-lg font-bold mb-4">User Growth</h3>
            <img src="https://placehold.co/600x200" alt="User Growth Chart">
        </div>

    </Layout>
</template>
