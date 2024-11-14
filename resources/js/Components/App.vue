<template>
  <div class="bg-[#F4F1FA] min-h-screen p-4">
    <div class="p-4 mb-4">
      <Welcome />
    </div>

    <div class="flex">
      <NavigationBar v-if="!isLoginPage" class="w-64 flex-shrink-0" />

      <div :class="{'ml-[264px]': !isLoginPage}" class="flex-1 p-6">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script setup>
import NavigationBar from './NavigationBar.vue';
import { useRoute } from 'vue-router'; 
import { computed } from 'vue';

const route = useRoute();
const isLoginPage = computed(() => {
  return route.path === '/login'; 
});
</script>

<style>
/* Additional global styles if needed */
</style>