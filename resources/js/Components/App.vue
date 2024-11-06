<template>
  <div class="bg-[#F4F1FA] min-h-screen p-4">
    <div class="p-4 mb-6">
      <Welcome />
    </div>

    <div class="flex">
      <Sidebar class="w-64 flex-shrink-0 mr-6" />

      <div class="flex-1 p-6">
        <CompanyInfo />
      </div>
    </div>
  </div>
</template>

<script setup>
import Sidebar from './Sidebar.vue';
import Welcome from './Welcome.vue';
import CompanyInfo from './CompanyInfo.vue';
</script>

<style scoped>
.bg-[#F4F1FA] {
  background-color: #F4F1FA;
}

.min-h-screen {
  min-height: 100vh;
}

.p-4 {
  padding: 1rem;
}

.mb-6 {
  margin-bottom: 1.5rem;
}

.flex {
  display: flex;
}

.w-64 {
  width: 16rem; 
}

.flex-shrink-0 {
  flex-shrink: 0;
}

.mr-6 {
  margin-right: 1.5rem;
}

.flex-1 {
  flex: 1;
}

.p-6 {
  padding: 1.5rem;
}
</style>