<template>
  <div class="flex justify-center mt-5">
    <div class="flex items-center gap-2.5 w-[1128px] h-[194px] p-4 bg-white shadow-lg rounded-[28px_28px_30px_30px] opacity-100">
      <div class="flex items-center justify-center w-16 h-16 rounded-[16px] bg-[#E7DEF8]">
        <img
          src="Frame1.png"
          alt="Welcome Icon"
          class="w-16 h-16"
        />
      </div>
      <div class="flex flex-col">
        <h1 class="text-2xl font-normal leading-10 text-[#1F1048] m-0">
          Welcome to StarLabs team
        </h1>
        <p class="text-base leading-6 text-[#1F1048] mt-2 tracking-wide">
          We are thrilled to have you join our team and embark on this exciting journey together.
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Welcome',
};
</script>

<style scoped>
/* Scoped style for additional customization, if needed */
</style>


<style scoped>
/* Main container to provide top margin for spacing below the navbar */
.page-container {
  display: flex;
  justify-content: center;
  margin-top: 20px; /* Adjust this value for spacing below the navbar */
}

.welcome-banner {
  display: flex;
  align-items: center;
  gap: 30px;
  width: 1072px;
  padding: 20px;
  border-radius: 16px;
  background-color: #FFFFFF;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.icon {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 64px;
  height: 64px;
  padding: 2px 0;
  border-radius: 16px;
  background-color: #E7DEF8;
}

.welcome-text h1 {
  font-family: Roboto, sans-serif;
  font-size: 32px;
  font-weight: 400;
  line-height: 40px;
  color: #1F1048;
  margin: 0;
}

.welcome-text p {
  font-family: Roboto, sans-serif;
  font-size: 16px;
  line-height: 24px;
  letter-spacing: 0.5px;
  color: #1F1048;
  margin-top: 10px;
}
</style>
