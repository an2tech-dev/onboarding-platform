<template>
  <div class="flex flex-col min-h-screen bg-[#F4EFFC]">
    <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex-1">
      <h1 class="text-xl sm:text-2xl text-gray-800 mb-4">Employee resources guide</h1>
      <p class="text-sm sm:text-base text-gray-600 mb-6">
        Unlock essential resources for your success. Explore HR policies, employee benefits,
        and professional support all in one place.
      </p>

      <div v-if="isLoading" class="text-center text-gray-600">Loading...</div>

      <div v-if="error" class="text-center text-red-500">{{ error }}</div>

      <div v-else-if="Object.keys(categories).length > 0">
        <div
          class="mb-8"
          v-for="(resources, category) in categories"
          :key="category"
        >
          <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">
            {{ category }}
          </h2>
          <ul>
            <li
              v-for="resource in resources"
              :key="resource.id"
              class="flex items-center justify-between bg-white shadow-sm border first:rounded-t-lg last:rounded-b-lg p-4 cursor-pointer hover:bg-gray-100"
              @click="viewResourceDetails(resource)"
            >
              <div>
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">
                  {{ resource.title }}
                </h3>
                <p class="text-xs sm:text-sm text-gray-600">
                  {{ resource.description }}
                </p>
              </div>
              <span class="text-gray-400 text-lg font-bold">&gt;</span>
            </li>
          </ul>
        </div>
      </div>

      <div v-else class="text-center text-gray-600">No resources available.</div>
    </div>

    <div v-if="selectedResource" class="fixed inset-0 z-50 flex justify-end">
      <div
        class="bg-white w-full sm:w-2/3 md:w-[343px] h-full shadow-lg rounded-l-lg flex flex-col z-50"
      >
        <div class="flex items-center justify-between p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-800">
            {{ selectedResource.resource.title }}
          </h2>
          <button
            @click="closeResourceDetails"
            class="text-gray-500 focus:outline-none text-2xl"
          >
            ✕
          </button>
        </div>

        <div class="p-4 sm:p-6">
          <p class="text-sm mb-6">Description</p>
          <p class="text-sm sm:text-base text-gray-600 mb-6">
            {{ selectedResource.resource.description }}
          </p>
          <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <button class="bg-[#805AD5] text-white px-4 py-2 rounded-lg text-sm">
              Download
            </button>
            <button class="bg-[#E9D8FD] text-[#805AD5] px-4 py-2 rounded-lg text-sm">
              Open file
            </button>
          </div>
        </div>
      </div>

      <div
        class="fixed inset-0 bg-[#F4EFFC] bg-opacity-70 z-40"
        @click="closeResourceDetails"
      ></div>
    </div>
  </div>
</template>

<script>
import apiService from "@/services/apiServices";

export default {
  name: "Resources",
  data() {
    return {
      selectedResource: null,
      categories: {},
      isLoading: false,
      error: null,
    };
  },
  methods: {
    async fetchResources() {
      this.isLoading = true;
      this.error = null;
      try {
        const resources = await apiService.get("api/resources");

        this.categories = resources.reduce((acc, resource) => {
          const category = resource.categories || "Uncategorized";
          if (!acc[category]) {
            acc[category] = [];
          }
          acc[category].push(resource);
          return acc;
        }, {});
      } catch (err) {
        this.error = "Failed to load resources. Please try again later.";
      } finally {
        this.isLoading = false;
      }
    },

    viewResourceDetails(resource) {
      this.selectedResource = { resource };
    },
    closeResourceDetails() {
      this.selectedResource = null;
    },
  },

  mounted() {
    this.fetchResources();
  },
};
</script>