<template>
  <div class="flex justify-center mt-5">
    <div class="flex items-center gap-[10px] w-[1120px] h-[180px] p-[24px] bg-white border border-[#E7DEF8] rounded-[24px] shadow-lg-custom">
      <div class="flex items-center justify-center w-[80px] h-[80px] rounded-[16px] bg-[#E7DEF8]">
        <img
          src="./Frame.png"
          alt="Welcome Icon"
          class="w-12 h-12"
        />
      </div>
      <div class="flex flex-col">
        <h1 class="text-2xl font-semibold text-[#1F1048] m-0">
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
.shadow-lg-custom {
  box-shadow: 0px 4px 20px rgba(31, 16, 72, 0.05);
}
</style>