<template>
  <div class="bg-[#F4EFFC] flex flex-col">
    <div v-if="!isLoginPage" class="container mx-auto p-6 bg-[#F4EFFC]">
      <Welcome />
    </div>

    <div class="flex flex-1 container mx-auto">
      <NavigationBar v-if="!isLoginPage" />

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