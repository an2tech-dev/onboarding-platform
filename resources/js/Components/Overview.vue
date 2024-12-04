<template>
  <div class="p-8 bg-[#F4EFFC] min-h-screen">
    <!-- Company Overview Section -->
    <div v-for="company in companies" :key="company.id" class="bg-white shadow-lg rounded-lg p-6 mb-8">
      <h2 class="text-2xl font-bold mb-4">Exploring Our Company</h2>

      <!-- Description -->
      <p class="text-gray-600 mb-6">{{ company.description || "No description available" }}</p>

      <!-- Company Details -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div>
          <strong>Established:</strong> {{ company.established || "N/A" }}
        </div>
        <div>
          <strong>Team Members:</strong> {{ company.team_members || "N/A" }}
        </div>
        <div>
          <strong>Office Size:</strong> {{ company.office_size || "N/A" }}
        </div>
        <div>
          <strong>Floors:</strong> {{ company.floors?.length || "N/A" }}
        </div>
      </div>

      <!-- Floors and Teams -->
      <div v-if="company.floors?.length">
        <h3 class="text-xl font-bold mb-4">Floors and Teams</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div v-for="floor in company.floors" :key="floor.id">
            <h4 class="font-semibold">Floor {{ floor.floor_number }}: {{ floor.name }}</h4>
            <ul>
              <li v-for="team in floor.teams" :key="team.id">
                <strong>{{ team.name }}</strong> - {{ team.members?.length || 0 }} Members
                <ul>
                  <li v-for="member in team.members || []" :key="member.id">
                    {{ member.name }} ({{ member.role || "N/A" }})
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Products Section -->
      <h3 class="text-xl font-bold mb-4">Our Products</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div
          v-for="product in company.products || []"
          :key="product.id"
          @click="viewProductDetails(product)"
          class="cursor-pointer bg-[#F9F7FE] p-4 rounded-lg shadow hover:bg-[#E8E2FA] transition"
        >
          <img :src="product.image || '/path/to/default-product.jpg'" alt="Product Image" class="w-full h-32 object-contain mb-4" />
          <h4 class="font-bold text-lg mb-2">{{ product.name }}</h4>
          <p class="text-gray-600">{{ product.description }}</p>
        </div>
      </div>

      <!-- Benefits Section -->
      <h3 class="text-xl font-bold mb-4">Benefits</h3>
      <div class="flex flex-wrap gap-4">
        <div v-for="benefit in company.benefits || []" :key="benefit.id" class="bg-white border border-gray-200 px-4 py-2 rounded-lg shadow">
          {{ benefit.name }} - {{ benefit.description }}
        </div>
      </div>
    </div>

    <!-- Product Details Modal -->
    <div v-if="selectedProduct" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-6 rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2 relative">
        <button
          @click="closeProductDetails"
          class="absolute top-4 right-4 text-red-500 text-lg font-bold"
        >
          ✕
        </button>
        
        <!-- Product Information -->
        <div>
          <img :src="selectedProduct.image || '/path/to/default-product.jpg'" alt="Product Image" class="w-40 h-40 object-contain mb-4 mx-auto" />
          <h2 class="text-2xl font-bold mb-4 text-center">{{ selectedProduct.name }}</h2>
          <p class="text-gray-600 mb-6 text-center">{{ selectedProduct.description }}</p>
          <div><strong>Released:</strong> {{ selectedProduct.release_date || "N/A" }}</div>
        </div>

        <!-- Team Members Section -->
        <div class="mt-6">
          <h3 class="text-lg font-bold mb-2">Team Members</h3>
          <ul>
            <li v-for="member in selectedProduct.team_members || []" :key="member.id" class="flex items-center mb-2">
              <img
                :src="member.avatar || '/path/to/default-avatar.jpg'"
                alt="Avatar"
                class="w-8 h-8 rounded-full mr-2"
              />
              <span>{{ member.name }} ({{ member.role || "N/A" }})</span>
            </li>
          </ul>
          <p v-if="!selectedProduct.team_members?.length" class="text-gray-500">No team members available.</p>
        </div>

        <!-- Stakeholders Section -->
        <div class="mt-6">
          <h3 class="text-lg font-bold mb-2">Stakeholders</h3>
          <ul>
            <li
              v-for="stakeholder in selectedProduct.stakeholders || []"
              :key="stakeholder.id"
              class="flex items-center mb-2"
            >
              <img
                :src="stakeholder.avatar || '/path/to/default-avatar.jpg'"
                alt="Avatar"
                class="w-8 h-8 rounded-full mr-2"
              />
              <div>
                <strong>{{ stakeholder.name }}</strong>
                <p class="text-sm text-gray-500">{{ stakeholder.role }}</p>
                <p class="text-sm text-gray-500">{{ stakeholder.email }}</p>
              </div>
            </li>
          </ul>
          <p v-if="!selectedProduct.stakeholders?.length" class="text-gray-500">No stakeholders available.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      companies: [],
      selectedProduct: null,
    };
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get("/api/company", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });
        this.companies = [response.data]; // Assuming one company
      } catch (error) {
        console.error("Error fetching company data:", error);
      }
    },
    viewProductDetails(product) {
      this.selectedProduct = product;
    },
    closeProductDetails() {
      this.selectedProduct = null;
    },
  },
  created() {
    this.fetchData();
  },
};
</script>

<style scoped>
.modal {
  z-index: 50;
}
</style>