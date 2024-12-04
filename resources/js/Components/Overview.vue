<template>
  <div class="p-8 bg-[#F4EFFC] min-h-screen">
    <!-- Company Overview Section -->
    <div v-for="company in companies" :key="company.id" class="bg-white shadow-lg rounded-lg p-6 mb-8">
      <h2 class="text-2xl font-bold mb-4">Exploring our company</h2>

      <!-- Description -->
      <p class="text-gray-600 mb-6">{{ description }}</p>

      <!-- Company Details -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div>
          <strong>Established:</strong> {{ company.established || 'N/A' }}
        </div>
        <div>
          <strong>Team members:</strong> {{ company.team_members || 'N/A' }}
        </div>
        <div>
          <strong>Office size:</strong> {{ company.office_size || 'N/A' }}
        </div>
        <div>
          <strong>Floors:</strong> {{ company.floors || 'N/A' }}
        </div>
      </div>

      <!-- Products Section -->
      <h3 class="text-xl font-bold mb-4">Our Products</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div
          v-for="product in products"
          :key="product.id"
          @click="viewProductDetails(product)"
          class="cursor-pointer bg-[#F9F7FE] p-4 rounded-lg shadow hover:bg-[#E8E2FA] transition"
        >
          <img :src="product.image" alt="Product Image" class="w-full h-32 object-contain mb-4" />
          <h4 class="font-bold text-lg mb-2">{{ product.name }}</h4>
          <p class="text-gray-600">{{ product.description }}</p>
        </div>
      </div>

      <!-- Benefits Section -->
      <h3 class="text-xl font-bold mb-4">Benefits</h3>
      <div class="flex flex-wrap gap-4">
        <div
          v-for="benefit in benefits"
          :key="benefit"
          class="bg-white border border-gray-200 px-4 py-2 rounded-lg shadow"
        >
          {{ benefit }}
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
        <div>
          <img
            :src="selectedProduct.image"
            alt="Product Image"
            class="w-40 h-40 object-contain mb-4 mx-auto"
          />
          <h2 class="text-2xl font-bold mb-4 text-center">{{ selectedProduct.name }}</h2>
          <p class="text-gray-600 mb-6 text-center">{{ selectedProduct.description }}</p>
        </div>
        <div>
          <strong>Released:</strong> {{ selectedProduct.release_date || 'N/A' }}
        </div>
        <div class="mt-6">
          <h3 class="text-lg font-bold mb-2">Team Members</h3>
          <!-- Example team members (Replace with API data) -->
          <ul>
            <li v-for="member in selectedProduct.team_members || []" :key="member.id" class="flex items-center mb-2">
              <img
                :src="member.avatar || '/path/to/default-avatar.jpg'"
                alt="Avatar"
                class="w-8 h-8 rounded-full mr-2"
              />
              <span>{{ member.name }} ({{ member.role }})</span>
            </li>
          </ul>
        </div>
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
      description: "",
      products: [],
      benefits: [
        "Health insurance",
        "52 days remote work",
        "Team retreats",
        "Chill area",
        "English course",
      ],
      selectedProduct: null,
    };
  },
  methods: {
    async fetchData() {
      try {
        // Fetch company data
        const companyResponse = await axios.get("/api/company", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        this.companies = companyResponse.data;

        // Fetch products data
        const productsResponse = await axios.get("/api/products", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });

        this.products = productsResponse.data.map((product) => ({
          ...product,
          // Add placeholder data for team members and stakeholders if not available
          team_members: product.team_members || [
            { id: 1, name: "John Doe", role: "Developer", avatar: null },
          ],
          stakeholders: product.stakeholders || [
            {
              id: 1,
              name: "Jane Smith",
              role: "CEO",
              email: "jane@example.com",
              avatar: null,
            },
          ],
        }));
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
    viewProductDetails(product) {
      this.selectedProduct = product;
    },
    closeProductDetails() {
      this.selectedProduct = null;
    },
  },
  async created() {
    this.fetchData();
  },
};
</script>
<style scoped>
/* Add necessary styles to adjust spacing and responsive behavior */
.modal {
  z-index: 50;
}
</style>