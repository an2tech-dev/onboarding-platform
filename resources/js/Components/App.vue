<template>
  <div class="bg-[#F4EFFC] flex flex-col max-w-screen-xl mx-auto">
    <div v-if="!isLoginPage" class="bg-[#F4EFFC]">
      <Welcome />
    </div>

    <div class="flex flex-1">
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