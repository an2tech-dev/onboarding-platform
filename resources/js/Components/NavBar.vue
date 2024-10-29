<!-- NavBar.vue -->
<template>
  <nav class="bg-white shadow-md w-full">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center py-3">
        <!-- Brand/Logo -->
        <div>
          <router-link to="/home" class="text-purple-800 font-bold text-lg">
            StarLabs
          </router-link>
        </div>

        <!-- Desktop Links -->
        <div class="hidden md:flex space-x-8">
          <router-link
            v-for="link in navLinks"
            :key="link.name"
            :to="link.to"
            class="hover:text-purple-600"
          >
            {{ link.name }}
          </router-link>

          <!-- Dropdown for Teams -->
          <div class="relative group">
            <button class="hover:text-purple-600">
              Teams
              <span class="ml-2">&#x25BC;</span>
            </button>
            <div class="absolute left-0 mt-2 bg-white shadow-lg rounded-md hidden group-hover:block">
              <router-link
                v-for="team in teams"
                :key="team.name"
                :to="team.to"
                class="block px-4 py-2 hover:bg-purple-100"
              >
                {{ team.name }}
              </router-link>
            </div>
          </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button @click="toggleMobileMenu" class="md:hidden p-2 rounded-md focus:outline-none">
          <svg
            v-if="!mobileMenuOpen"
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
          <svg
            v-else
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div v-if="mobileMenuOpen" class="md:hidden">
        <div class="space-y-2">
          <router-link
            v-for="link in navLinks"
            :key="link.name"
            :to="link.to"
            class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
            @click="closeMobileMenu"
          >
            {{ link.name }}
          </router-link>

          <div>
            <button @click="toggleDropdown('Teams')" class="w-full text-left px-4 py-2 hover:bg-gray-100">
              Teams
            </button>
            <div v-if="dropdownVisible === 'Teams'" class="pl-4 space-y-1">
              <router-link
                v-for="team in teams"
                :key="team.name"
                :to="team.to"
                class="block px-4 py-2 text-gray-700 hover:bg-gray-50"
                @click="closeMobileMenu"
              >
                {{ team.name }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';

const mobileMenuOpen = ref(false);
const dropdownVisible = ref('');

// Navigation Links
const navLinks = [
  { name: 'Home', to: '/home' },
  { name: 'Processes', to: '/processes' },
  { name: 'Resources', to: '/resources' },
];

// Teams dropdown links
const teams = [
  { name: 'Floor 1', to: '/teams/floor1' },
  { name: 'Floor 2', to: '/teams/floor2' },
];

// Toggle mobile menu visibility
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

// Close mobile menu when clicking on a link
const closeMobileMenu = () => {
  mobileMenuOpen.value = false;
  dropdownVisible.value = '';
};

// Toggle dropdown visibility
const toggleDropdown = (menu) => {
  dropdownVisible.value = dropdownVisible.value === menu ? '' : menu;
};
</script>

<style scoped>
/* Styling for navigation bar */
.container {
  max-width: 1200px;
}

nav a {
  padding: 0.5rem 1rem;
  font-weight: 500;
  color: #333;
}

nav a:hover {
  color: #5a189a;
}

nav button {
  padding: 0.5rem 1rem;
  background: none;
  border: none;
  color: #333;
  cursor: pointer;
  font-weight: 500;
}

/* Dropdown styles */
.group .group-hover\:block {
  display: none;
}

.group:hover .group-hover\:block {
  display: block;
}
</style>