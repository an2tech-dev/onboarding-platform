<template>
    <nav class="bg-white rounded-xl shadow p-4 space-y-2 mt-6 ml-4 w-full">
      <ul>
        <li v-for="item in menuItems" :key="item.name">
          <router-link 
            :to="item.route" 
            class="block px-4 py-2 rounded-lg hover:bg-purple-100" 
            active-class="bg-purple-100 text-purple-700"
          >
            {{ item.name }}
          </router-link>
        </li>
      </ul>
    </nav>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const menuItems = ref([
    { name: 'Company Overview', route: '/overview' },
    { name: 'Teams', route: '/teams' },
    { name: 'Your Role Details', route: '/role-details' },
    { name: 'Technology Stack', route: '/technology-stack' },
    { name: 'Processes and Schedules', route: '/processes-schedules' },
    { name: 'Resources Directory', route: '/resources' },
    { name: 'Sign Out', route: '/sign-out' }
  ]);
  </script>
  
  <style scoped>
  /* Optional scoped styling for sidebar */
  </style>