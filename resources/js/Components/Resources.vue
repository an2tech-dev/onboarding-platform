<template>
  <div class="flex flex-col min-h-screen bg-[#F4EFFC]">
    <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex-1">
      <!-- Header -->
      <h1 class="text-xl sm:text-2xl text-gray-800 mb-4">Employee resources guide</h1>
      <p class="text-sm sm:text-base text-gray-600 mb-6">
        Unlock essential resources for your success. Explore HR policies, employee benefits,
        and professional support all in one place.
      </p>

      <!-- Tools Section -->
      <div class="mb-8">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Tools that we use</h2>
        <ul>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Microsoft Teams', 'List of recognized holidays and their observance.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Microsoft Teams</h3>
              <p class="text-xs sm:text-sm text-gray-600">List of recognized holidays and their observance.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Microsoft Outlook', 'Guidelines governing the relationship between employees and the company.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Microsoft Outlook</h3>
              <p class="text-xs sm:text-sm text-gray-600">Guidelines governing the relationship between employees and the company.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Microsoft Planner', 'Legal agreements outlining terms and conditions of employment.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Microsoft Planner</h3>
              <p class="text-xs sm:text-sm text-gray-600">Legal agreements outlining terms and conditions of employment.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Discord', 'Confidentiality agreement to protect sensitive company information.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Discord</h3>
              <p class="text-xs sm:text-sm text-gray-600">Confidentiality agreement to protect sensitive company information.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
        </ul>
      </div>

      <!-- Resources Section -->
      <div class="mb-8">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">Resources</h2>
        <ul>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Udemy Courses', 'Comprehensive learning resources for employee growth.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Udemy Courses</h3>
              <p class="text-xs sm:text-sm text-gray-600">Comprehensive learning resources for employee growth.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
        </ul>
      </div>

      <!-- HR Policies Section -->
      <div class="mb-8">
        <h2 class="text-base sm:text-lg font-semibold text-gray-800 mb-4">HR Policies</h2>
        <ul>
          <li
            class="flex items-center justify-between bg-white shadow-sm rounded-lg border p-4"
            @click="viewResourceDetails('Official Holidays', 'Details on observed official holidays.')"
          >
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900">Official Holidays</h3>
              <p class="text-xs sm:text-sm text-gray-600">Details on observed official holidays.</p>
            </div>
            <span class="text-gray-400 text-lg font-bold">&gt;</span>
          </li>
        </ul>
      </div>
    </div>

    <!--Resources Modal details-->
    <div v-if="selectedResource" class="fixed inset-0 z-50 flex justify-end">
      <!-- Modal -->
      <div
        class="bg-white w-full sm:w-2/3 md:w-[343px] h-full shadow-lg rounded-l-lg flex flex-col z-50"
      >
        <!-- Title and Close Button in Flex Row -->
        <div class="flex items-center justify-between p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-800">
            {{ selectedResource.title }}
          </h2>
          <button
            @click="closeResourceDetails"
            class="text-gray-500 focus:outline-none text-2xl"
          >
            ✕
          </button>
        </div>

        <!-- Content -->
        <div class="p-4 sm:p-6">
          <p class="text-sm mb-6">Description</p>
          <p class="text-sm sm:text-base text-gray-600 mb-6">
            {{ selectedResource.description }}
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

      <!-- Overlay -->
      <div
        class="fixed inset-0 bg-[#F4EFFC] bg-opacity-70 z-40"
        @click="closeResourceDetails"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Resources",
  data() {
    return {
      selectedResource: null,
    };
  },
  methods: {
    viewResourceDetails(title, description) {
      this.selectedResource = { title, description };
    },
    closeResourceDetails() {
      this.selectedResource = null;
    },
  },
};
</script>
