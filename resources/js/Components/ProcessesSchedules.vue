<template>
  <div class="processes-and-schedules px-8 py-12 rounded-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Workflow Management</h1>
    <p class="text-lg text-gray-600 mb-6">
      At Startux, we follow modern development methodologies to ensure efficiency and collaboration in our projects. You'll likely encounter:
    </p>

    <!-- Agile Methodology and Scrum Framework Section -->
    <div class="flex flex-wrap gap-8 mb-12">
      <img src="../../css/images/Frame2.png" alt="Agile Methodology" class="max-w-full max-h-full">
      <img src="../../css/images/Frame3.png" alt="Scrum Framework" class="max-w-full max-h-full">
    </div>

    <!-- Meeting Rhythms Section -->
    <h2 class="text-xl font-bold text-gray-800 mb-6">Meeting Rhythms</h2>
    <p class="text-lg text-gray-600 mb-6">Communication is key to our success, and we maintain a structured 
      meeting schedule to keep everyone informed and aligned:</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <!-- Daily Stand-up Meetings -->
      <div class="p-4 bg-purple-100 shadow rounded-lg">
        <h3 class="text-lg font-bold mb-2">Daily Stand-up Meetings</h3>
        <p class="text-gray-600 mb-4">Join daily sessions to share work updates, remove obstacles, and synchronize priorities.</p>
        <p class="text-sm font-semibold mb-2">Standard Schedule</p>
        <div class="bg-white border-2 border-purple-100 rounded-lg p-3 shadow-lg gap-10 ">
          <p class="text-sm ">09:00am to 09:15am</p>
        </div>
      </div>

      <!-- Sprint Planning -->
      <div class="p-4 bg-purple-100 shadow rounded-lg">
        <h3 class="text-lg font-bold mb-8">Sprint Planning</h3>
        <p class="text-gray-600 mb-4">Design sprint goals, define deliverables, and allocate tasks for effective collaboration.</p>
        <p class="text-sm font-bold mb-3">Duration time</p>
        <div class="bg-white border-2 border-purple-100 rounded-lg p-3 shadow-lg gap-10">
          <p class="text-sm">1-4 weeks</p>
        </div>
      </div>

      <!-- Retrospective Meetings -->
      <div class="p-4 bg-purple-100 shadow rounded-lg">
        <h3 class="text-lg font-bold mb-2">Retrospective Meetings</h3>
        <p class="text-gray-600 mb-4">Analyze team performance, identify challenges, and improve processes.</p>
        <p class="text-sm font-bold mb-2">Frequency</p>
        <div class="bg-white border-2 border-purple-100 rounded-lg p-3 shadow-lg gap-10">
          <p class="text-sm ">Monthly or Quarterly</p>
        </div>
      </div>

      <!-- Performance Review -->
      <div class="p-4 bg-purple-100 shadow rounded-lg">
        <h3 class="text-lg font-bold mb-2">Performance Review</h3>
        <p class="text-gray-600 mb-4">Regular feedback sessions for personal growth and organizational development.</p>
        <p class="text-sm font-bold mb-2">Conducted</p>
        <div class="bg-white border-2 border-purple-100 rounded-lg p-3 shadow-lg gap-10">
          <p class="text-sm">Every 6 months</p>
        </div>
      </div>
    </div>

    <!--Typical Schedules-->
    <div class="typical-schedule-section px-2 py-4">
  <h2 class="text-xl font-semibold text-gray-800 mb-4">Typical Schedules</h2>
  <p class="text-lg text-gray-600 mb-6">We value work-life balance and offer flexibility to accommodate your needs.</p>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Standard Work Hours -->
    <div class="p-6 bg-purple-100 rounded-lg shadow">
      <div class="flex items-center mb-6">
        <img src="../../css/images/photo1.png" alt="Clock Icon">
      </div>
      <h3 class="text-lg font-semibold text-gray-800 mb-4">Standard Work Hours</h3>
      <p class="text-gray-700">
        Our standard work hours are typically from 9:00 AM to 5:00 PM, but we also offer flexibility to adjust your schedule as needed.
      </p>
    </div>
    <!-- Vacation and Leave Policies -->
    <div class="p-6 bg-purple-100 rounded-lg shadow">
      <div class="flex items-center mb-6">
        <img src="../../css/images/photo2.png" alt="Calendar Icon">
      </div>
      <h3 class="text-lg font-bold text-gray-800 mb-4">Vacation and Leave Policies</h3>
      <p class="text-gray-700">
        Apply for vacations and leaves via AveHR. Follow policies for efficient time management and productivity.
      </p>
    </div>
    <!-- Holiday Schedule -->
    <div class="p-6 bg-purple-100 rounded-lg shadow">
      <div class="flex items-center mb-6">
        <img src="../../css/images/photo3.png" alt="Holiday Icon">
      </div>
      <h3 class="text-lg font-bold text-gray-800 mb-4">Holiday Schedule</h3>
      <p class="text-gray-700">
        You’ll receive a company-wide holiday schedule in advance, allowing you to plan your time accordingly.
      </p>
    </div>
  </div>
</div>


   
<!-- Tech Support Section -->
 <div class="px-2 py-4">
<h2 class="text-xl font-semibold text-gray-800 mb-8">Tech support hub</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
  <!-- Connectivity Issues -->
  <div class="p-4 bg-purple-50 rounded-lg shadow mb-6">
    <div class="flex items-center mb-6">
      <img src="../../css/images/icon1.png" alt="Connectivity Icon">
    </div>
    <h3 class="text-lg font-bold text-gray-700 mb-4">Connectivity Issues</h3>
    <p class="mb-4">Connectivity issues are communicated through designated Teams channels for quick response and collaboration.</p>
    <ul class="text-sm text-gray-600 list-disc pl-5">
      <li>Internet/Wi-Fi problems</li>
      <li>Network configuration</li>
      <li>Slow connection</li>
    </ul>
  </div>
  <!-- Device Troubleshooting -->
  <div class="p-4 bg-purple-50 rounded-lg shadow mb-6">
    <div class="flex items-center mb-6">
      <img src="../../css/images/icon2.png" alt="Device Troubleshooting Icon">
    </div>
    <h3 class="text-lg font-bold text-gray-700 mb-4">Device Troubleshooting</h3>
    <p class="mb-4">Device troubleshooting is reported through SL Ticket System to ensure issues are properly tracked and addressed.</p>
    <ul class="text-sm text-gray-600 list-disc pl-5">
      <li>Computer/Laptop Issues</li>
      <li>Printer/Scanner Errors</li>
      <li>RFID Card</li>
    </ul>
  </div>
  <!-- PC Admin Access -->
  <div class="p-4 bg-purple-50 rounded-lg shadow mb-6">
    <div class="flex items-center mb-6">
      <img src="../../css/images/icon3.png" alt="Admin Access Icon">
    </div>
    <h3 class="text-lg font-bold text-gray-700 mb-4">PC Admin Access Request</h3>
    <p class="mb-4">To have administrative access on your PC, please refrain from using "make me admin" on your desktop.</p>
    <ul class="text-sm text-gray-600 list-disc pl-5">
      <li>When downloading</li>
      <li>Deleting anything</li>
    </ul>
  </div>
  <!-- VPN Setup -->
  <div class="p-4 bg-purple-50 rounded-lg shadow mb-6">
    <div class="flex items-center mb-6">
      <img src="../../css/images/icon4.png" alt="VPN Setup Icon">
    </div>
    <h3 class="text-lg font-bold text-gray-700 mb-6">VPN Setup and Usage</h3>
    <p class="mb-4">VPN is installed on your computer to ensure secure access to company resources from any location.</p>
    <ul class="text-sm text-gray-600 list-disc pl-5">
      <li>Remote access</li>
      <li>Secure browsing</li>
      <li>Secure communication</li>
    </ul>
  </div>
</div>
  </div>
  </div>
</template>

<script>
export default {
  name: 'ProcessesSchedules',
};
</script>

<style scoped>
.processes-and-schedules {
  background-color: white;
}
</style>
