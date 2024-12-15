<template>
  <div class="flex flex-col min-h-screen bg-[#F4EFFC]">
    <div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 flex-1">
      <!-- Header -->
      <h1 class="text-xl sm:text-2xl text-gray-800 mb-4">Meet our teams</h1>

      <!-- Floor Navigation -->
      <div class="flex space-x-4 mb-8">
        <div
          v-for="(floor, index) in floors"
          :key="index"
          @click="selectFloor(floor)"
          class="cursor-pointer border rounded-lg p-4 w-1/4 relative"
          :class="selectedFloor === floor.name ? 'border-purple-400 shadow-md' : 'border-purple-100 hover:shadow-md'"
        >
          <h2 class="text-sm sm:text-base text-gray-900">
            {{ floor.name }}
          </h2>
          <p class="text-xs sm:text-sm text-gray-600">
            {{ floor.teams }} teams
          </p>
          <div
            v-if="selectedFloor === floor.name"
            class="absolute bottom-[-10px] left-1/2 transform -translate-x-1/2 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-t-purple-400"
          ></div>
        </div>
      </div>

      <!-- Teams Section -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div
          v-for="team in teams"
          :key="team.name"
          class="bg-white shadow-sm rounded-lg border p-4 hover:shadow-md cursor-pointer"
          @click="viewTeamDetails(team.name, team.members)"
        >
          <div class="flex flex-col">
            <img
              :src="team.image"
              :alt="team.name"
              class="w-32 h-32 object-cover rounded-lg mb-4"
            />
            <div>
              <h3 class="text-sm sm:text-base font-semibold text-gray-900 mb-1">
                {{ team.name }}
              </h3>
              <p class="text-xs sm:text-sm text-gray-600">
                {{ team.members }} members
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Elevate Your Experience Section -->
      <h2 class="text-lg sm:text-xl text-gray-800 mb-4">
        Elevate Your Experience
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Gaming Room Card -->
        <div
          class="flex bg-white shadow-md rounded-lg overflow-hidden cursor-pointer"
          @click="viewExperienceDetails('Gaming Room', 'Our dedicated gaming room is the perfect spot for all gaming enthusiasts.')"
        >
          <img
            src="../../css/images/img5.png"
            alt="Gaming room"
            class="w-1/3 object-cover"
          />
          <div class="p-4">
            <h3 class="text-base font-semibold text-gray-800 mb-1">
              Gaming room
            </h3>
            <p class="text-sm text-gray-600">
              Our dedicated gaming room is the perfect spot for all gaming enthusiasts.
            </p>
          </div>
        </div>

        <!-- Rooftop Card -->
        <div
          class="flex bg-white shadow-md rounded-lg overflow-hidden cursor-pointer"
          @click="viewExperienceDetails('Rooftop', 'Our rooftop offers breathtaking views and a vibrant atmosphere for relaxation.')"
        >
          <img
            src="../../css/images/img5.png"
            alt="Rooftop"
            class="w-1/3 object-cover"
          />
          <div class="p-4">
            <h3 class="text-base font-semibold text-gray-800 mb-1">
              Rooftop
            </h3>
            <p class="text-sm text-gray-600">
              Our rooftop offers breathtaking views and a vibrant atmosphere for various activities.
            </p>
          </div>
        </div>
      </div>
    </div>

  
    <div v-if="selectedModal" class="fixed inset-0 z-50 flex justify-end">
      <div class="bg-white w-full sm:w-2/3 md:w-[343px] h-full shadow-lg rounded-l-lg flex flex-col z-50">
        <div class="flex items-center justify-between p-4 sm:p-6">
          <h2 class="text-lg sm:text-xl font-bold text-gray-800">
            {{ selectedModal.title }}
          </h2>
          <button
            @click="closeModal"
            class="text-gray-500 focus:outline-none text-2xl"
          >
            ✕
          </button>
        </div>
        <div class="p-4 sm:p-6">
          <p class="text-sm sm:text-base text-gray-600 mb-6">
            {{ selectedModal.description }}
          </p>
        </div>
      </div>
      <div class="fixed inset-0 bg-[#F4EFFC] bg-opacity-70 z-40" @click="closeModal"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Teams",
  data() {
    return {
      selectedModal: null, 
      selectedFloor: "First floor",
      floors: [
        { name: "First floor", teams: 4 },
        { name: "Second floor", teams: 6 },
        { name: "Third floor", teams: 2 },
        { name: "Fourth floor", teams: 10 },
      ],
      teams: [
        {
          name: "TechTitans",
          members: "40 members",
          image: "",
        },
        {
          name: "Team 1",
          members: "3 members",
          image: "../../css/images/img2.png",
        },
        {
          name: "Team 2",
          members: "12 members",
          image: "../../css/images/img3.png",
        },
        {
          name: "Team 3",
          members: "6 members",
          image:"image",
        },
      ],
    };
  },
  methods: {
    viewTeamDetails(title, description) {
      this.selectedModal = { title, description };
    },
    viewExperienceDetails(title, description) {
      this.selectedModal = { title, description };
    },
    closeModal() {
      this.selectedModal = null;
    },
    selectFloor(floor) {
      this.selectedFloor = floor.name;
    },
  },
};
</script>

<style scoped>
.grid {
  display: grid;
}
</style>
