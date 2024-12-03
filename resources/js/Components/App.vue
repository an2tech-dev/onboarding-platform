<template>
  <div class="bg-[#F4EFFC] min-h-screen flex flex-col">
    <div v-if="!isLoginPage" class="p-6 bg-[#F4EFFC] shadow-md">
      <Welcome />
    </div>

    <div class="flex flex-1">
      <NavigationBar v-if="!isLoginPage" class="w-64 flex-shrink-0 bg-white shadow-lg border-r h-full" />

      <div class="flex-1 p-6">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script setup>
import NavigationBar from './NavigationBar.vue';
import Welcome from './Welcome.vue';
import { useRoute } from 'vue-router';
import { computed } from 'vue';

const route = useRoute();

const isLoginPage = computed(() => route.path === '/login');
</script>

<style scoped>
body {
  margin: 0;
  padding: 0;
}
</style>