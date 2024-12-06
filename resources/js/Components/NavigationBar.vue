<template>
  <div>
    <!-- Mobile Menu Button -->
    <button
      class="block md:hidden flex items-center space-x-2 px-4 py-2 border rounded-full text-purple-700 border-purple-700 hover:bg-purple-100 transition-all duration-200 fixed top-4 right-4 z-50"
      @click="toggleMenu"
    >
      <span v-if="!isMenuOpen">☰</span>
      <span v-else>✖</span>
      <span>{{ isMenuOpen ? 'Close' : 'Menu' }}</span>
    </button>

    <!-- Desktop Menu -->
    <nav
      class="hidden md:flex bg-white rounded-xl shadow p-4 space-y-4 mt-6 ml-4 w-64 h-auto"
    >
      <ul class="space-y-2">
        <li v-for="item in menuItems" :key="item.name">
          <router-link
            :to="item.route"
            class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200"
            :class="{
              'bg-purple-200 text-purple-700': isActive(item.route),
              'hover:bg-purple-100': !isActive(item.route),
            }"
          >
            {{ item.name }}
          </router-link>
        </li>
      </ul>
    </nav>

    <!-- Mobile Fullscreen Menu -->
    <div
      v-if="isMenuOpen"
      class="fixed inset-0 bg-white z-40 flex flex-col p-6 space-y-6"
    >

      <!-- Menu Items -->
      <ul class="space-y-4 !mt-14">
        <li v-for="item in menuItems" :key="item.name">
          <router-link
            :to="item.route"
            class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200"
            :class="{
              'bg-purple-200 text-purple-700': isActive(item.route),
              'hover:bg-purple-100': !isActive(item.route),
            }"
            @click="closeMenu"
          >
            {{ item.name }}
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRoute } from "vue-router";

const menuItems = ref([
  { name: "Company overview", route: "/overview" },
  { name: "Teams", route: "/teams" },
  { name: "Your role details", route: "/role-details" },
  { name: "Technology stack", route: "/technology-stack" },
  { name: "Processes and schedules", route: "/processes-schedules" },
  { name: "Resources directory", route: "/resources" },
  { name: "Sign out", route: "/sign-out" },
]);

const route = useRoute();
const isMenuOpen = ref(false);

const isActive = (routeName) => {
  return route.path === routeName;
};

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
  isMenuOpen.value = false;
};
</script>

<style scoped>
nav {
  width: 264px;
  min-height: 340px; 
  border-radius: 16px; 
  padding: 16px; 
}

.router-link-active {
  background-color: #E7DEF8; 
  color: #000000; 
}

a:hover {
  background-color: #E7DEF8; 
  color: #000000; 
}

button {
  cursor: pointer;
}

/* Fullscreen Menu Styling */
div.fixed {
  padding: 24px;
}

ul {
  margin-top: 1.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
  nav {
    display: none;
  }
}

ul {
  gap: 10px;
}
</style>