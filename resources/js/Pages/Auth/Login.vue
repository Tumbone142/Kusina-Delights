
<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Layout from '../../Layouts/frontend.vue';

const logo = '/storage/logo3.png'; // Adjust based on your public path
const isSignUp = ref(false); // Toggles between login and signup

// Form states for login and signup
const loginForm = useForm({
    email: '',
    password: '',
});
const signupForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '', // Make sure to match the form field name
    FirstName: '',
    MiddleName: '',
    LastName: '',
    ProfileImage: null,  // Leave ProfileImage as null
    Introduction: null,  // Leave Introduction as null
});

// Handle form submission for login and signup
const handleSubmit = (type) => {
    if (type === 'signin') {
        loginForm.post(route('login'), {
            onFinish: () => loginForm.reset('password'),
            onError: () => {
                // Handle login errors here
                console.log('Login failed!');
            }
        });
    } else if (type === 'signup') {
        if (signupForm.password !== signupForm.password_confirmation) {
            alert('Passwords do not match.');
            return;
        }

        signupForm.post(route('register'), {
            onFinish: () => {
                signupForm.reset('password', 'password_confirmation');
            },
            onError: (errors) => {
                // Handle errors here (e.g., validation errors)
                console.log(errors);
            },
            onSuccess: () => {
                loginForm.email = signupForm.email;
                loginForm.password = signupForm.password;
                loginForm.post(route('login'));
            }
        });
    }
};

// Toggle between login and signup views
const toggleForm = (value) => {
    isSignUp.value = value;
};
</script>

<template>
    <Layout>
        <Head title="Authentication" />

        <div class="relative h-screen overflow-hidden">
            <div
                class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('https://c.animaapp.com/fvd5j1dy/img/eg4-ep33-leche-flan-67645e919b12432e590b303456de6e74-1.png');"
            ></div>

            <div class="outer-container">
                <div class="container" :class="{ active: isSignUp }">
                    <!-- Sign Up Form -->
                    <div class="form-container sign-up bg-transparency-100 p-6">
                        <form @submit.prevent="handleSubmit('signup')">
                            <h1 class="text-large font-semibold text-center mb-6 text-black-100">
                                Create Account
                            </h1>
                            <input
                                type="text"
                                placeholder="Username"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.name"
                                required
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.email"
                                required
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.password"
                                required
                            />
                            <input
                                type="password"
                                placeholder="Confirm Password"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.password_confirmation"
                                required
                            />
                            <!-- Profile Fields -->
                            <input
                                type="text"
                                placeholder="First Name"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.FirstName"
                            />
                            <input
                                type="text"
                                placeholder="Middle Name"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.MiddleName"
                            />
                            <input
                                type="text"
                                placeholder="Last Name"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="signupForm.LastName"
                            />
                            <button
                                class="bg-light_green-100 hover:bg-light_green-200 text-black-100 font-semibold px-20 py-3 rounded-2xl shadow-md text-small inline-block text-center"
                                :class="{ 'opacity-25': signupForm.processing }"
                                :disabled="signupForm.processing"
                            >
                                Sign Up
                            </button>
                        </form>
                    </div>

                    <!-- Sign In Form -->
                    <div class="form-container sign-in bg-transparency-100 p-6">
                        <form @submit.prevent="handleSubmit('signin')">
                            <h1 class="text-large font-semibold text-center mb-6 text-black-100">
                                Log In
                            </h1>
                            <input
                                type="email"
                                placeholder="Email"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="loginForm.email"
                                required
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                class="text-small focus:ring-2 focus:ring-yellow-300"
                                v-model="loginForm.password"
                                required
                            />
                            <!-- Forgot Password -->
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="mt-2 text-sm text-gray-600 underline hover:text-gray-900"
                            >
                                Forgot Your Password?
                            </Link>
                            <button
                                class="bg-light_green-100 hover:bg-light_green-200 text-black-100 font-semibold px-20 py-3 rounded-2xl shadow-md text-small inline-block text-center mt-4"
                                :class="{ 'opacity-25': loginForm.processing }"
                                :disabled="loginForm.processing"
                            >
                                Log In
                            </button>
                        </form>
                    </div>

                    <!-- Toggle Container -->
                    <div class="toggle-container">
                        <div class="toggle">
                            <div class="toggle-panel toggle-left bg-yellow-300 p-6">
                                <h1 class="text-normal font-bold text-black-100">
                                    Already Have an Account?
                                </h1>
                                <p class="text-black-100 text-small font-bold">
                                    Login to find new Opportunities and Discover new Delights
                                </p>
                                <button
                                    @click="toggleForm(false)"
                                    class="bg-light_green-100 hover:bg-light_green-200 text-black-100 font-semibold px-20 py-3 rounded-2xl shadow-md text-small"
                                >
                                    Sign In
                                </button>
                            </div>
                            <div class="toggle-panel toggle-right bg-yellow-300 p-6">
                                <h1 class="text-normal font-bold text-black-100">
                                    Don’t Have an Account?
                                </h1>
                                <p class="text-black-100 text-small font-bold">
                                    Sign Up to find new Opportunities and Discover new Delights
                                </p>
                                <button
                                    @click="toggleForm(true)"
                                    class="bg-light_green-100 hover:bg-light_green-200 text-black-100 font-semibold px-20 py-3 rounded-2xl shadow-md text-small"
                                >
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>


<style scoped>
  
  /* Parent container for centering */
  .outer-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Full viewport height */
  }
  
  /* Reset styles */
  .container {
      color: #2c2b2b;
      background-color: #fff;
      border-radius: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
      position: relative;
      overflow: hidden;
      width: 60%; /* Increased width */
      max-width: 90%; /* Responsive */
      min-height: 700px; /* Increased minimum height */
      display: flex;
      flex-direction: column; /* Stack children vertically */
      align-items: center; /* Center children */
      justify-content: center; /* Center children */
  }
  
  /* Other styles remain unchanged */
  .container p {
      line-height: 20px;
      letter-spacing: 0.3px;
      margin: 20px 0;
  }
  
  .container a {
      color: #333;
      text-decoration: none;
      margin: 15px 0 10px;
  }
  

  
  .container button.hidden {
      background-color: transparent;
      border-color: #fff;
  }
  
  .container form {
      background-color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 40px;
      height: 100%;
  }
  
  .container input {
      background-color: #eee;
      border: none;
      margin: 8px 0;
      padding: 10px 15px;
      border-radius: 8px;
      width: 100%;
      outline: none;
  }
  
  /* Remaining styles unchanged */
  .form-container {
      position: absolute;
      top: 0;
      height: 100%;
      transition: all 0.6s ease-in-out;
  }
  
  .sign-in {
      left: 0;
      width: 50%;
      z-index: 2;
  }
  
  .container.active .sign-in {
      transform: translateX(100%);
  }
  
  .sign-up {
      left: 0;
      width: 50%;
      opacity: 0;
      z-index: 1;
  }
  
  .container.active .sign-up {
      transform: translateX(100%);
      opacity: 1;
      z-index: 5;
      animation: move 0.6s;
  }
  
  @keyframes move {
      0%, 49.99% {
          opacity: 0;
          z-index: 1;
      }
      50%, 100% {
          opacity: 1;
          z-index: 5;
      }
  }
  
  .toggle-container {
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      height: 100%;
      overflow: hidden;
      transition: all 0.6s ease-in-out;
      border-radius: 150px 0 0 100px;
      z-index: 1000;
  }
  
  .container.active .toggle-container {
      transform: translateX(-100%);
      border-radius: 0 150px 100px 0;
  }
  
  .toggle {
      background-color: #ffdb63;
      height: 100%;
      background: linear-gradient(288deg, #ffe9a1, #ffdb63);
      position: relative;
      left: -100%;
      height: 100%;
      width: 200%;
      transform: translateX(0);
      transition: all 0.6s ease-in-out;
  }
  
  .container.active .toggle {
      transform: translateX(50%);
  }
  
  .toggle-panel {
      position: absolute;
      width: 50%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      padding: 0 30px;
      text-align: center;
      top: 0;
      transform: translateX(0);
      transition: all 0.6s ease-in-out;
  }
  
  .toggle-left {
      transform: translateX(-200%);
  }
  
  .container.active .toggle-left {
      transform: translateX(0);
  }
  
  .toggle-right {
      right: 0;
      transform: translateX(0);
  }
  
  .container.active .toggle-right {
      transform: translateX(200%);
  }
</style>
  