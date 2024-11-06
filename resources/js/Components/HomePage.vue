<template>
    <div>
      <!-- Welcome Banner Section -->
      <Welcome />
  
      <!-- Company Info Section -->
      <CompanyInfo />
    </div>
  </template>
  
  <script>
  import Welcome from './Welcome.vue';
  import CompanyInfo from './CompanyInfo.vue';
  
  export default {
    components: {
      Welcome,
      CompanyInfo,
    },
  };
  </script>
  
  <style scoped>
  /* Additional styling for HomePage if needed */
  </style>