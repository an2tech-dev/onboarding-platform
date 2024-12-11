<template>
  <div class="bg-[#F4EFFC]">
    <div v-for="company in companies" :key="company.id" class="flex justify-center mt-5">
      <div class="shadow-container flex items-center gap-[10px]">
        <div class="flex items-center gap-[30px] w-full h-full p-[24px] bg-white border border-[#E7DEF8] rounded-[20px] shadow-lg-custom">
          <div class="flex items-center justify-center w-[132px] h-[132px] rounded-[16px] bg-[#E7DEF8] p-[34px] gap-[10px]">
            <img
              src="../../css/images/Frame1.png"
              alt="Welcome Icon"
              class="w-[64px] h-[64px]"
            />
          </div>
          <div class="flex flex-col">
            <h1 class="text-2xl text-[#1F1048] m-0">
              Welcome to {{ company.name }}
            </h1>
            <p class="text-base leading-6 text-[#1F1048] mt-2 tracking-wide">
              {{ company.description || 'We are thrilled to have you join our team and embark on this exciting journey together.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'WelcomeBanner',
  data() {
    return {
      companies: [],
    };
  },
  async created() {
    try {
      const response = await axios.get('/api/company', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      });
      this.companies = response.data;
    } catch (error) {
      console.error('Error fetching company data:', error);
    }
  },
};
</script>

<style scoped>
@import '../../css/fonts.css';

body {
  font-family: 'Roboto', sans-serif;
}

.shadow-container {
  width: 1128px;
  height: 194px;
  padding: 4px 4px 10px 4px;
  border-radius: 28px 28px 30px 30px;
  background-color: #E6E1E9;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05); 
}

.shadow-lg-custom {
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
}
</style>