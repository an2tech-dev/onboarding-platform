<template>
  <div class="bg-white p-4 rounded-lg">
    <h1 class="mb-6 text-[#1F1048] text-2xl	">Role Overview</h1>
    <div class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <p class="text-[#1F1048] font-medium text-lg">Description</p>
            <span class="text-[#1F1048] text-sm">
              <template v-if="roleInformation.description">
                  {{ roleInformation.description }}
              </template>
              <template v-else>
                  There is no description for this role.
              </template>
             </span>
        </div>

        <div class="flex flex-col lg:flex-row justify-between gap-6 lg:max-w-[800px]">
            <div class="flex flex-col gap-2">
              <p class="text-[#1F1048] font-medium text-lg">Your Team Name</p>
              <span class="text-[#1F1048] text-sm">
                <template v-if="team">
                    {{ team }}
                </template>
                <template v-else>
                    There is no description for this role.
                </template>
            </span>
            </div>
            <div v-if="user && roleInformation" class="flex justify-between items-center p-6 bg-[#F7F2FA] rounded-xl lg:min-w-[500px]">
              <div class="flex flex-col">
                <p v-if="user.name" class="text-[#64568F] font-medium text-lg">{{ user.name }}</p>
                <p v-else class="text-[#64568F] font-medium text-lg">Name not available</p>
            
                <span v-if="user.email" class="text-[#615B71] text-sm">{{ user.email }}</span>
                <span v-else class="text-[#615B71] text-sm">Email not available</span>
              </div>
            
              <span v-if="roleInformation.title" class="px-2 py-2 bg-[#E8DDFF] text-[#1F1048] rounded">
                {{ roleInformation.title }}
              </span>
              <span v-else class="px-2 py-2 bg-[#E8DDFF] text-[#1F1048] rounded">
                Role title not available
              </span>
            </div>
            
            <div v-else class="p-6 bg-[#F7F2FA] rounded-xl min-w-[391px] text-[#64568F] text-center">
              <p>Data is not available.</p>
            </div>
        </div>

        <div class="flex flex-col gap-2">
          <p class="text-[#1F1048] font-medium text-lg">Expectations</p>
          <span class="text-[#1F1048] text-sm">
            <template v-if="roleInformation.expectations">
                {{ roleInformation.expectations }}
            </template>
            <template v-else>
                There is no expectations for this role.
            </template>
           </span>
        </div>

        <div class="flex flex-col gap-2">
          <p class="text-[#1F1048] font-medium text-base">Assigned projects</p>
        
          <div v-if="products.length > 0" class="flex flex-wrap gap-2">
            <div
              class="pt-2 pb-3 px-1 bg-[#CAC4CF] rounded-[10px]"
              v-for="(product, index) in products"
              :key="index"
            >
              <span class="bg-white px-3 py-2 rounded-[8px]">
                {{ product }}
              </span>
            </div>
          </div>
          <p v-else class="text-gray-500">There are no current projects assigned.</p>
        </div>

    </div>
    
  </div>
</template>
<script>
import apiService from "@/services/apiServices";

export default {
  data() {
    return {
      roleInformation: {},
      team: "",
      products: [],
      user: [],
    };
  },
  methods: {
    async fetchData() {
      try {
        const response = await apiService.get("/api/role-information");

        const { role_information, team, products, user } = response;

        this.roleInformation = role_information;
        this.team = team;
        this.user = user;
        this.products = products;

        console.log(user)


      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
  },
  created() {
    this.fetchData();
  },
};
</script>

<style scoped>
/* Additional styles if needed */
</style>