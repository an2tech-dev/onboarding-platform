<template>
  <nav class="bg-white rounded-xl shadow p-4 space-y-4 mt-6 ml-4 w-64 h-auto">
    <ul class="space-y-2">
      <li v-for="item in menuItems" :key="item.name">
        <router-link 
          :to="item.route" 
          class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-all duration-200"
          :class="{
            'bg-purple-200 text-purple-700': isActive(item.route), 
            'hover:bg-purple-100': !isActive(item.route)  
          }"
        >
          {{ item.name }}
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const menuItems = ref([
  { name: 'Company Overview', route: '/overview' },
  { name: 'Teams', route: '/teams' },
  { name: 'Your Role Details', route: '/role-details' },
  { name: 'Technology Stack', route: '/technology-stack' },
  { name: 'Processes and Schedules', route: '/processes-schedules' },
  { name: 'Resources Directory', route: '/resources' },
  { name: 'Sign Out', route: '/sign-out' }
]);

const route = useRoute();

const isActive = (routeName) => {
  return route.path === routeName;
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

ul {
  gap: 10px;
}
</style>