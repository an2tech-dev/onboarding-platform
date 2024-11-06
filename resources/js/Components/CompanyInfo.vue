<template>
    <section class="w-[800px] p-4 bg-white rounded-lg shadow-md">
      <!-- Adjusted header with larger font and more weight -->
      <h2 class="text-2xl mb-5 text-gray-800">Exploring our company</h2>
  
      <div class="mb-5">
        <h3 class="text-base font-medium text-gray-700">Description</h3>
        <p class="text-sm text-gray-600 leading-relaxed">
          Starlabs is a leading provider of Information and Communication Technology (ICT) outsourcing solutions, dedicated to
          empowering businesses with innovative and reliable IT services. With a commitment to excellence and a customer-centric
          approach, we strive to become a trusted partner in driving digital transformation for organizations worldwide.
        </p>
      </div>
  
      <!-- Company Details Section -->
      <div class="grid grid-cols-4 gap-4 mb-5 text-gray-700">
        <div class="text-left">
          <strong class="block font-semibold text-gray-800 text-sm">Established</strong>
          <p class="text-xs">2015</p>
        </div>
        <div class="text-left">
          <strong class="block font-semibold text-gray-800 text-sm">Team members</strong>
          <p class="text-xs">200 members</p>
        </div>
        <div class="text-left">
          <strong class="block font-semibold text-gray-800 text-sm">Office size</strong>
          <p class="text-xs">1700 square meters</p>
        </div>
        <div class="text-left">
          <strong class="block font-semibold text-gray-800 text-sm">Floors</strong>
          <p class="text-xs">4 Floors + Gaming Room & Rooftop</p>
        </div>
      </div>
  
<!-- Products Section -->
<div class="mb-5">
    <h3 class="text-base font-medium text-gray-700 mb-3">Our products</h3>
    <div class="flex space-x-4">
      <div 
        v-for="(product, index) in products" 
        :key="index" 
        class="flex items-center bg-[#F4F1FA] rounded-lg shadow-sm w-[396px] h-[136px] p-4"
      >
        <!-- Wider Image Container with padding for white space effect -->
        <div class="w-[200px] h-[120px] bg-white rounded-lg flex items-center justify-center mr-4 p-4">
          <img :src="product.logo" alt="Product Logo" class="w-full h-full object-contain"/>
        </div>
        <div>
          <h4 class="font-semibold text-gray-800 text-lg">{{ product.name }}</h4>
          <p class="text-sm text-gray-600 leading-tight">{{ product.description }}</p>
        </div>
      </div>
    </div>
</div>
     <!-- Benefits Section -->
<div>
    <h3 class="text-base font-medium text-gray-700 mb-3">Benefits</h3>
    <div class="flex flex-wrap gap-2">
      <div 
        v-for="(benefit, index) in benefits" 
        :key="index" 
        class="flex items-center px-3 py-1 bg-white rounded-full text-gray-600 text-sm shadow-sm border border-gray-200"
      >
        <i :class="benefit.icon" class="mr-2 text-gray-500"></i>
        {{ benefit.name }}
      </div>
    </div>
  </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "CompanyInfo",
    data() {
      return {
        products: [
          { name: "AveHR Platform", description: "Welcome to StarLabs revolutionary HR platform, AveHR.", logo: "/images/image1.png"  },
          { name: "AveHR Platform", description: "Welcome to StarLabs revolutionary HR platform, AveHR.", logo: "/images/image1.png" },
        ],
        benefits: [
          { name: "Health insurance", icon: "fa-solid fa-heartbeat" },
          { name: "52 days remote work", icon: "fa-solid fa-laptop-house" },
          { name: "Team retreats", icon: "fa-solid fa-campground" },
          { name: "Chill area", icon: "fa-solid fa-couch" },
          { name: "English course", icon: "fa-solid fa-language" },
          { name: "Wellness coach", icon: "fa-solid fa-user-nurse" },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  /* Additional scoped styling if needed */
  </style>