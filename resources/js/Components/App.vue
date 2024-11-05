<template>
  <div class="bg-[#F4F1FA] min-h-screen p-4">
    <div class="p-4 mb-4">
      <Welcome />
    </div>

    <div class="flex">
      <Sidebar class="w-64 flex-shrink-0" />

      <div class="flex-1 p-6">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script setup>
import Sidebar from './Sidebar.vue';
import Welcome from './Welcome.vue';
</script>

<style>
/* Additional global styles if needed */
</style>