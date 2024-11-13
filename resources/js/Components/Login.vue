<template>
  <div class="min-h-screen bg-purple-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
      <h2 class="text-3xl font-semibold text-center text-purple-600 mb-6">Login</h2>
      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input
            v-model="email"
            type="email"
            id="email"
            placeholder="Enter your email"
            required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
          />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input
            v-model="password"
            type="password"
            id="password"
            placeholder="Enter your password"
            required
            class="mt-1 block w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"
          />
        </div>

        <div class="flex justify-center">
          <button
            type="submit"
            class="w-full bg-purple-600 text-white py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
          >
            Login
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import apiService from '@/services/apiServices';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await apiService.post('/login', {
          email: this.email,
          password: this.password
        });
        console.log(response);
        localStorage.setItem('token', response.token);
        this.$router.push({ name: 'Home' });
      } catch (error) {
        console.log(error, 'Login failed. Please check your credentials.');
      }
    }
  }
};
</script>