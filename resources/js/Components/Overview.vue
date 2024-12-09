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
    <strong class="text-gray-700">Established:</strong>
    <span class="text-gray-600">{{ prettifyDate(company.established) || 'N/A' }}</span>
  </div>
  <div class="flex flex-col items-start">
    <strong class="text-gray-700">Team members:</strong>
    <span class="text-gray-600">{{ company.team_members || 'N/A' }}</span>
  </div>
  <div class="flex flex-col items-start">
    <strong class="text-gray-700">Office size:</strong>
    <span class="text-gray-600">{{ company.office_size || 'N/A' }}</span>
  </div>
  <div class="flex flex-col items-start">
    <strong class="text-gray-700">Floors:</strong>
    <span class="text-gray-600">{{ company.floors || 'N/A' }}</span>
  </div>
</div>

<!-- Product Details -->
<h3 class="text-xl mb-4">Our Products</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
  <div
    v-for="product in products"
    :key="product.id"
    @click="viewProductDetails(product)"
    class="cursor-pointer bg-[#F9F7FE] p-4 rounded-xl shadow-lg hover:bg-[#E8E2FA] transition"
  >
    <div class="flex items-center">
      <div
        class="flex-none"
        style="
          width: 154px; 
          height: 120px; 
          padding: 43px 21px; 
          gap: 10px; 
          border-radius: 6px 0px 0px 0px; 
          background-color: white; 
          opacity: 1;
        "
      >
        <img 
          :src="product.image" 
          alt="Product Image" 
          class="w-full h-full object-contain" 
        />
      </div>
      <div class="ml-4">
        <h4 class=" text-2xl mb-2">{{ product.name }}</h4>
        <p class="text-gray-600">{{ product.description }}</p>
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
        <button @click="closeProductDetails" class="modal-close">✕</button>
      <div class="modal-content">
        <img
          :src="selectedProduct.image"
          alt="Product Image"
          class="w-[407px] h-[218px] object-contain mb-4 border border-[#CAC4CF] gap-[10px] p-[81px]"
        />
        <div>
        <h2 class="w-[171px] h-[32px] font-bold text-xl mb-4">{{ selectedProduct.name }}</h2>
        </div>
        <div class="w-[407px] h-[128px] gap-[8px]"> 
        <p class="w-[73px] h-[20px] text-sm mb-2 font-bold">Description</p>
        <p class="w-[340px] h-[90px] text-sm">{{ selectedProduct.description }}</p>
         </div>
         <div class="w-[195px] h-[48px] gap-[16px] flex flex-col items-start"> 
          <strong>Released:</strong> {{ formatReleaseDate(selectedProduct.release_date) || 'N/A' }}
        </div>
        </div>
      </div>
    </div>
    <div
      v-if="selectedProduct"
      class="modal-overlay show"
      @click="closeProductDetails"
    ></div>
  </div>


</template>

<script>
import axios from "axios";

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
        const companyResponse = await axios.get("/api/company", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        this.companies = companyResponse.data.map((company) => ({
          ...company,
          benefits: company.benefits || [], 
        }));

        const productsResponse = await axios.get("/api/products", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        this.products = productsResponse.data.map((product) => ({
          ...product,
        }));
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },

   
    prettifyDate(date) {
      if (!date) return 'N/A'; 

      try {
        const options = { day: 'numeric', month: 'long', year: 'numeric' }; 
        return new Date(date).toLocaleDateString(undefined, options).replace(",", ""); 
      } catch (error) {
        console.error("Invalid date format:", date, error);
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
  width: 25%;
  max-width: 400px;
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
  top: 16px;
  left: 925px;
  padding: 14px;
  position: absolute;
}

.modal-content {
  padding: 20px;
  
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