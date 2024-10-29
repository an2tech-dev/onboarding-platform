<template>
  <div class="app-container bg-[#F4F1FA] min-h-screen">
    <NavBar />
    <router-view></router-view>
  </div>
</template>

<script setup>
import NavBar from './NavBar.vue'; 
</script>

<style>
/* Global styles */
</style>