<template>
  <div class="flex justify-center mt-5">
    <!-- Shadow Container -->
    <div class="shadow-container flex items-center gap-[10px]">
      <!-- Card Container -->
      <div class="flex items-center gap-[30px] w-full h-full p-[24px] bg-white border border-[#E7DEF8] rounded-[20px] shadow-lg-custom">
        <div class="flex items-center justify-center w-[132px] h-[132px] rounded-[16px] bg-[#E7DEF8] p-[34px] gap-[10px]">
          <img
            src="./Frame.png"
            alt="Welcome Icon"
            class="w-16 h-16"
          />
        </div>
        <div class="flex flex-col">
          <h1 class="text-2xl  text-[#1F1048] m-0">
            Welcome to StarLabs team
          </h1>
          <p class="text-base leading-6 text-[#1F1048] mt-2 tracking-wide">
            We are thrilled to have you join our team and embark on this exciting journey together.
          </p>
        </div>
      </div>
    </div>
  </div>


    <!-- Body Section -->
    <div class="body-section w-[840px] height-[590px] max-w-5xl mt-10 bg-[#FAF6FF] p-8 rounded-[20px] shadow-lg">
      <h2 class="text-xl text-[#1F1048] font-semibold mb-4">Exploring our company</h2>

      <!-- Description -->
      <p class="text-base text-[#1F1048] mb-6">
        Starlabs is a leading provider of Information and Communication Technology (ICT) outsourcing solutions, dedicated to empowering businesses with innovative and reliable IT services. With a commitment to excellence and a customer-centric approach, we strive to become a trusted partner in driving digital transformation for organizations worldwide.
      </p>

      <!-- Company Info -->
      <div class="grid grid-cols-4 gap-4 text-center mb-8">
        <div>
          <h3 class="text-sm font-semibold text-[#1F1048]">Established</h3>
          <p class="text-lg text-[#1F1048]">2015</p>
        </div>
        <div>
          <h3 class="text-sm font-semibold text-[#1F1048]">Team members</h3>
          <p class="text-lg text-[#1F1048]">200 members</p>
        </div>
        <div>
          <h3 class="text-sm font-semibold text-[#1F1048]">Office size</h3>
          <p class="text-lg text-[#1F1048]">1700 square meters</p>
        </div>
        <div>
          <h3 class="text-sm font-semibold text-[#1F1048]">Floors</h3>
          <p class="text-lg text-[#1F1048]">4 Floors + Gaming Room & Rooftop</p>
        </div>
      </div>

      <!-- Products Section -->
      <h3 class="text-lg font-semibold text-[#1F1048] mb-4">Our products</h3>
      <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="product-card p-4 bg-white border border-[#E7DEF8] rounded-[12px] shadow-sm">
          <img src="./AveHR.png" alt="AveHR Logo" class="w-12 h-12 mx-auto mb-4" />
          <h4 class="text-center text-[#1F1048] font-semibold">AveHR Platform</h4>
          <p class="text-center text-sm text-[#1F1048]">Welcome to StarLabs revolutionary HR platform, AveHR.</p>
        </div>
        <!-- Repeat similar cards for other products if necessary -->
      </div>

      <!-- Benefits Section -->
      <h3 class="text-lg font-semibold text-[#1F1048] mb-4">Benefits</h3>
      <div class="flex flex-wrap gap-4">
        <span class="benefit-badge">Health insurance</span>
        <span class="benefit-badge">52 days remote work</span>
        <span class="benefit-badge">Team retreats</span>
        <span class="benefit-badge">Chill area</span>
        <span class="benefit-badge">English course</span>
        <span class="benefit-badge">Wellness coach</span>
      </div>
    </div>
</template>

<script>
export default {
  name: 'Welcome',
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
* {
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


.body-section {
  background-color: #FAF6FF;
}


.benefit-badge {
  display: inline-block;
  padding: 8px 16px;
  background-color: #E7DEF8;
  color: #1F1048;
  font-size: 0.875rem;
  border-radius: 8px;
  font-weight: 500;
  text-align: center;
}



</style>
