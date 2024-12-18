<template>
  <div class="flex flex-colbg-[#F4EFFC]">
    <div class="flex flex-col gap-6 bg-white shadow-lg rounded-lg p-4 sm:p-5 flex-1">
      <h1 class="text-xl sm:text-2xl text-gray-800">Meet our teams</h1>

      <div class="flex flex-col gap-4">
        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">
          <div
            v-for="(floor, index) in floors"
            :key="index"
            @click="selectFloor(floor)"
            class="cursor-pointer pt-1 px-1 pb-2 rounded-xl  relative"
            :class="selectedFloor?.id === floor.id ? 'bg-[#CEBDFF] shadow-md' : 'bg-[#ECE6EE] hover:shadow-md'"
          >
            <div class="bg-white rounded-xl px-2 py-3">
              <h2 class="text-sm sm:text-base text-gray-900">
                {{ floor.name }}
              </h2>
              <p class="text-xs sm:text-sm text-gray-600">
                {{ floor.teams ? floor.teams.length : 0 }} teams
              </p>
              <div
                v-if="selectedFloor?.id === floor.id"
                class="absolute bottom-[-8px] left-1/4 transform -translate-x-1/2 w-[17px] h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent border-t-8 border-[#CEBDFF]"
              ></div>
            </div>
          </div>
        </div>

        <div v-if="selectedFloor" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
          <div
            v-for="team in selectedFloor.teams"
            :key="team.id"
            class="bg-[#F2ECF4] shadow-sm rounded-xl border p-2 hover:shadow-md cursor-pointer"
            @click="viewTeamDetails(team)"
          >
            <div class="flex flex-col gap-4">
              <img
                :src="team.image || 'https://via.placeholder.com/150'"
                :alt="team.name"
                class="object-cover rounded-lg"
              />
              <div>
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">
                  {{ team.name }}
                </h3>
                <p class="text-xs sm:text-sm text-gray-600">
                  {{ team?.members ? team?.members?.length : 0 }} members
                </p>
              </div>
            </div>
          </div>
        </div>

        <div v-else class="text-gray-500 text-center">
          Select a floor to view teams.
        </div>
      </div>

      <div class="flex flex-col gap-2">
        <h2 class="text-lg sm:text-xl text-gray-800">
          Elevate Your Experience
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div
            class="flex gap-3 shadow-md bg-[#F2ECF4] p-2 rounded-xl overflow-hidden cursor-pointer"
            @click="viewExperienceDetails('Gaming Room', 'Our dedicated gaming room is the perfect spot for all gaming enthusiasts.')"
          >
            <img
              src="../../css/images/img5.png"
              alt="Gaming room"
              class="min-w-[154px] max-w-[154px] object-cover rounded-xl"
            />
            <div class="flex flex-col justify-center">
              <h3 class="text-base font-semibold text-gray-800 mb-1">
                Gaming room
              </h3>
              <p class="text-sm text-gray-600">
                Our dedicated gaming room is the perfect spot for all gaming enthusiasts.
              </p>
            </div>
          </div>
          <div
            class="flex gap-3 p-2 bg-[#F2ECF4] shadow-md rounded-xl overflow-hidden cursor-pointer"
            @click="viewExperienceDetails('Rooftop', 'Our rooftop offers breathtaking views and a vibrant atmosphere for relaxation.')"
          >
            <img
              src="../../css/images/img5.png"
              alt="Rooftop"
              class="min-w-[154px] max-w-[154px] object-cover rounded-xl"
            />
            <div class="flex flex-col justify-center">
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
    </div>
    <div v-if="selectedModal" class="fixed inset-0 z-50 flex justify-end">
      <div class="bg-white w-full sm:w-2/3 md:w-[455px] h-full shadow-lg rounded-l-lg flex flex-col gap-6 z-50 p-4 overflow-y-auto">
        <div class="w-full">
          <button @click="closeModal" class="absolute text-gray-500 focus:outline-none text-2xl">
            ✕
          </button>
          <img
            :src="selectedModal.image || 'https://via.placeholder.com/150'"
            :alt="selectedModal.name"
            class="object-cover rounded-lg w-full max-h-[218px]"
          />
          
        </div>
        <div class="flex flex-col gap-6">
          <h2 class="text-2xl font-normal text-[#1F1048]">
            {{ selectedModal.name }}
          </h2>

          <div class="flex flex-col gap-2">
            <p class="text-[#1F1048] font-medium text-base">
              Description
            </p>
            <span v-if="selectedModal.description" class="text-[#1F1048] font-normal text-sm">
              {{ selectedModal.description }}
            </span>
            <p v-else class="text-gray-500 text-sm">No description available.</p>
          </div>
          <div class="flex flex-col gap-2">
            <p class="font-medium text-base text-[#1F1048]">
              Active members
            </p>
            <span v-if="selectedModal.members && selectedModal.members.length > 0" class="font-normal text-sm text-[#1F1048]">
              {{ selectedModal.members.length }} members
            </span>
            <p v-else class="text-gray-500 text-sm">No active members</p>
          </div>
          <div class="flex flex-col gap-2">
            <p class="text-[#1F1048] font-medium text-base">Current Projects</p>
            <div v-if="selectedModal.products.length > 0" class="flex flex-wrap gap-2">
              <div class="pt-2 pb-3 px-1 bg-[#CAC4CF] rounded-lg" v-for="product in selectedModal.products" :key="product.id">
                <span class="bg-white px-3 py-2 rounded-lg">
                  {{ product.name }}
                </span>
              </div>
            </div>
            <p v-else class="text-gray-500">There are no current projects assigned.</p>
          </div>
          <div class="flex flex-col gap-4">
            <div class="flex justify-between items-center px-6 py-6 bg-[#F7F2FA] rounded-xl" v-for="member in selectedModal.members" :key="member.id">
                <div>
                  <p>{{ member.name }}</p>
                  <span>{{ member.email }}</span>
                </div>
                <span class="px-2 py-2 bg-[#E8DDFF] text-[#1F1048] rounded">
                  {{ member.team_role }}
                </span>
            </div>
          </div>
        </div>
      </div>
      <div class="fixed inset-0 bg-[#F4EFFC] bg-opacity-70 z-40" @click="closeModal"></div>
    </div>
  </div>
</template>

<script>
import apiService from "@/services/apiServices";

export default {
  name: "Teams",
  data() {
    return {
      selectedModal: null,
      selectedFloor: null,
      floors: [],
      isLoading: false,
      error: null,
    };
  },
  methods: {
    async fetchFloorsAndTeams() {
      this.isLoading = true;
      this.error = null;

      try {
        const response = await apiService.get("api/floors");
        const teams = await apiService.get("api/teams");
        console.log(response);
        this.floors = response;
         if (this.floors.length > 0) {
          this.selectedFloor = this.floors[0];
        }
      } catch (error) {
        this.error = "Failed to load floors. Please try again later.";
      } finally {
        this.isLoading = false;
      }
    },
    selectFloor(floor) {
      this.selectedFloor = floor;
    },
    viewTeamDetails(team) {
      this.selectedModal = team;
    },
    closeModal() {
      this.selectedModal = null;
    },
  },
  mounted() {
    this.fetchFloorsAndTeams();
  },
};
</script>
