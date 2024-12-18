<template>
 <div class="flex flex-1 bg-[#F4EFFC] min-h-screen">
    <div v-for="company in companies" :key="company.id" class="bg-white shadow-lg rounded-lg p-6 mb-8">
      <h2 class="text-2xl mb-4">Exploring our company</h2>

      <!-- Description -->
      <h5 class=" mb-4">Description</h5>
      <p class="text-gray-600 mb-6">{{ company.description }}</p>

      <!-- Company Details -->
    <div class="grid grid-cols-4 gap-4 mb-6">
      <div class="flex flex-col items-start">
        <strong class="text-gray-800">Established:</strong>
        <span class="text-gray-600">{{ prettifyDate(company.established) || 'N/A' }}</span>
      </div>
      <div class="flex flex-col items-start">
        <strong class="text-gray-800">Team members:</strong>
        <span class="text-gray-600">{{ company.team_members || 'N/A' }}</span>
      </div>
      <div class="flex flex-col items-start">
        <strong class="text-gray-800">Office size:</strong>
        <span class="text-gray-600">{{ company.office_size || 'N/A' }}</span>
      </div>
      <div class="flex flex-col items-start">
        <strong class="text-gray-800">Floors:</strong>
        <span class="text-gray-600">{{ company.floors || 'N/A' }}</span>
      </div>
    </div>

    <!-- Product Details --> 
    <h3 class="text-xl font-bold mb-4">Our Products</h3>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
      <div
        v-for="product in products"
        :key="product.id"
        @click="viewProductDetails(product)"
        class="cursor-pointer bg-[#F9F7FE] p-4 rounded-lg shadow hover:bg-[#E8E2FA] transition"
      >
        <div class="flex items-center justify-center gap-8 opacity-100">
          <!-- Image container div with specific styles -->
          <div class="flex-none" style="width: 154px; height: 120px;  gap: 10px; border-radius: 6px 0px 0px 0px; opacity: 1;">
            <img :src="product.image" alt="Product Image" class="w-full h-full object-contain" />
          </div>
          <!-- Text container -->
          <div class="flex flex-col gap-2">
            <h4 class="font-bold text-lg">{{ product.name }}</h4>
            <p class="text-gray-600">{{ truncateDescription(product.description, 50) }}</p>
          </div>
        </div>
      </div>
    </div>



      <!-- Benefits Section -->
      <h3 class="text-xl mb-4">Benefits</h3>
      <div class="flex flex-wrap gap-4">
        <div
          v-for="benefit in company.benefits"
          :key="benefit"
          class="bg-white border border-gray-200 px-4 py-2 rounded-lg shadow"
        >
          {{ benefit }}
        </div>
      </div>
    </div>

    <div>
    <!-- Product Details Modal -->
      <div
        v-if="selectedProduct"
        class="modal show" >
          <button @click="closeProductDetails" class="modal-close" >✕</button>
        <div class="modal-content">

          <img
            :src="selectedProduct.image"
            alt="Product Image"
            class="w-80 max-h-[150px]  mb-6 border border-[#CAC4CF] rounded-lg  "/>

          <div class="flex flex-col gap-4">

            <h2 class="text-[#1F1048] text-2xl font-normal">{{ selectedProduct.name }}</h2>

            <div class="flex flex-col gap-2">
              <span class="text-sm text-[#1F1048] font-bold">Description</span>
              <span class="text-sm text-[#1F1048] font-normal">{{ selectedProduct.description }} </span>
            </div>
            
            <div class="flex flex-col gap-2">
              <span class="text-sm text-[#1F1048] font-bold">Released</span>
              <span class="text-sm text-[#1F1048] font-normal">{{ formatReleaseDate(selectedProduct.release_date) || 'N/A' }} </span>
            </div>
          </div>

        </div>
        </div>
      </div>
      <div
        v-if="selectedProduct"
        class="modal-overlay show"
        @click="closeProductDetails"
      >
    </div>
  </div>


</template>

<script>
import axios from "axios";
import apiService from "@/services/apiServices";


export default {
  data() {
    return {
      companies: [],
      products: [],
      selectedProduct: null,
    };
  },
  methods: {
    async fetchData() {
      try {
        
        const companyResponse = await apiService.get("/api/company");

        this.companies = companyResponse.map((company) => ({
          ...company,
          benefits: company.benefits || [], 
        }));

        const productsResponse = await apiService.get("/api/products");

        this.products = productsResponse.map((product) => ({
          ...product,
        }));
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },

    truncateDescription(description, maxLength) {
      if (!description) return '';
      return description.length > maxLength
        ? description.substring(0, maxLength) + '...'
        : description;
    },
    prettifyDate(date) {
      if (!date) return 'N/A'; 

      try {
        const options = { day: 'numeric', month: 'long', year: 'numeric' }; 
        return new Date(date).toLocaleDateString(undefined, options).replace(",", ""); 
      } catch (error) {
        return 'N/A'; 
      }
    },


    viewProductDetails(product) {
      this.selectedProduct = product;
    },
    closeProductDetails() {
      this.selectedProduct = null;
    },
    formatReleaseDate(date) {
      if (!date) return null;
      const options = { year: 'numeric', month: 'long' }; 
      return new Date(date).toLocaleDateString(undefined, options);
    },
  },
  async created() {
    this.fetchData();
  },
};
</script>

<style scoped>
/* Modal styling for side display */
.modal {
  display: none;
  position: fixed;
  top: 0;
  right: 0;
  max-width: 343px;
  height: 100%;
  background-color: #ffffff;
  box-shadow: -1px 0px 10px rgba(0, 0, 0, 0.1);
  overflow-y: auto;
  transform: translateX(100%);
  transition: transform 0.3s ease-in-out;
  z-index: 50;
}

.modal.show {
  display: block;
  transform: translateX(0);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px;
  border-bottom: 1px solid #ddd;
}

.modal-header h2 {
  font-size: 18px;
  font-weight: bold;
}

.modal-close {
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
  width: 44px;
  height: 44px;
  right: 5px;
  position: absolute;
}

.modal-content {
  padding: 24px;
}

.modal-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 40;
}

.modal-overlay.show {
  display: block;
}
.flex-col strong {
  margin-bottom: 4px; 
}
</style>