<template>
  <div class="flex flex-1 bg-[#F4EFFC] min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 flex-1">
      <!-- Header -->
      <h1 class="text-2xl text-gray-800 mb-4">Employee resources guide</h1>
      <p class="text-gray-600 mb-6">
        Unlock essential resources for your success. Explore HR policies, employee benefits,
        and professional support all in one place.
      </p>

      <!-- Tools Section -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Tools that we use</h2>
        <ul> 
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4" 
            @click="viewResourceDetails('Microsoft Teams', 'List of recognized holidays and their observance.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Microsoft Teams</h3>
              <p class="text-sm text-gray-600">List of recognized holidays and their observance.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4"
            @click="viewResourceDetails('Microsoft Outlook', 'Guidelines governing the relationship between employees and the company.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Microsoft Outlook</h3>
              <p class="text-sm text-gray-600">Guidelines governing the relationship between employees and the company.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4"
            @click="viewResourceDetails('Microsoft Planner', 'Legal agreements outlining terms and conditions of employment.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Microsoft Planner</h3>
              <p class="text-sm text-gray-600">Legal agreements outlining terms and conditions of employment.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4"
            @click="viewResourceDetails('Discord', 'Confidentiality agreement to protect sensitive company information.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Discord</h3>
              <p class="text-sm text-gray-600">Confidentiality agreement to protect sensitive company information.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
        </ul>
      </div>

      <!-- Resources Section -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Resources</h2>
        <ul>
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4"
            @click="viewResourceDetails('Udemy Courses', 'Comprehensive learning resources for employee growth.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Udemy Courses</h3>
              <p class="text-sm text-gray-600">Comprehensive learning resources for employee growth.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
        </ul>
      </div>

      <!-- HR Policies Section -->
      <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">HR Policies</h2>
        <ul>
          <li
            class="flex items-center justify-between bg-white shadow rounded-lg border p-4"
            @click="viewResourceDetails('Official Holidays', 'Details on observed official holidays.')"
          >
            <div>
              <h3 class="text-base font-semibold text-gray-900">Official Holidays</h3>
              <p class="text-sm text-gray-600">Details on observed official holidays.</p>
            </div>
            <span class="text-gray-400 text-xl font-bold">&gt;</span>
          </li>
        </ul>
      </div>

      <!-- Resource Details Modal -->
      <div v-if="selectedResource" class="modal show">
        <button @click="closeResourceDetails" class="modal-close">✕</button>
        <div class="modal-content">
          <h2 class="text-xl font-bold mb-4">{{ selectedResource.title }}</h2>
          <p class="text-gray-600">{{ selectedResource.description }}</p>
        </div>
      </div>
      <div v-if="selectedResource" class="modal-overlay show" @click="closeResourceDetails"></div>
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

<style scoped>
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

.modal-close {
  position: absolute;
  top: 16px;
  right: 16px;
  background: transparent;
  border: none;
  font-size: 20px;
  cursor: pointer;
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
</style>
