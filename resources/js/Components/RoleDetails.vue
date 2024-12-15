<template>
  <div class="bg-white p-6 rounded-lg shadow-md max-w-screen-lg mx-auto">
    <!-- Title and Description -->
    <div>
      <h2 class="text-2xl text-gray-800 text-center sm:text-left">Role Overview</h2>
      <p class="text-gray-600 mt-2 text-center sm:text-left">
        As a Software Engineer at StarLabs, you will be responsible for developing and maintaining our software products. You will collaborate with cross-functional teams to design, implement, and deploy solutions that meet our customer needs.
      </p>
    </div>

    <!-- Team Information -->
    <div class="mt-6">
      <h3 class="text-lg font-semibold text-gray-800">Your team name</h3>
      <p class="text-gray-700 mb-4">TechTitans</p>
      <div class="flex items-center justify-between bg-purple-50 p-4 rounded-lg shadow-sm">
        <!-- Profile Info -->
        <div class="flex items-center">
          <img
            src="https://via.placeholder.com/40"
            alt="Team Leader"
            class="w-10 h-10 rounded-full mr-4"
          />
          <div>
            <p class="text-purple-800 font-medium">Alex Onfroy</p>
            <p class="text-gray-600 text-sm">alex@onfroy.com</p>
          </div>
        </div>
        <!-- Team Leader Badge -->
        <span class="bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-md font-semibold">
          Team leader
        </span>
      </div>
    </div>

    <!-- Expectations -->
    <div class="mt-6">
      <h3 class="text-lg font-semibold text-gray-800">Expectations</h3>
      <ul class="list-disc list-inside text-gray-700 mt-2">
        <li>Demonstrate technical proficiency in programming languages and frameworks.</li>
        <li>Solve complex problems effectively and work collaboratively with the team.</li>
        <li>Stay updated on industry trends and communicate effectively with stakeholders.</li>
      </ul>
    </div>

    <!-- Next Steps -->
    <div class="mt-6">
      <h3 class="text-lg font-semibold text-gray-800">Next Steps</h3>
      <ul class="list-disc list-inside text-gray-700 mt-2">
        <li>Introductory meetings with your team members to get to know them better and understand their roles within the organization.</li>
        <li>Take some time to review project documentation, team guidelines, and relevant resources to familiarize yourself with our projects and processes.</li>
        <li>Don't hesitate to reach out to your manager or colleagues if you have any questions or need clarification on any aspect of your role or projects.</li>
      </ul>
    </div>

    <!-- Assigned Projects -->
    <div class="mt-6">
      <h3 class="text-lg font-semibold text-gray-800">Assigned Projects</h3>
      <div class="flex flex-wrap gap-3 mt-4">
        <div class="border border-gray-300 text-gray-700 text-sm px-4 py-1 rounded-full shadow-sm bg-white">
          AveHR
        </div>
        <div class="border border-gray-300 text-gray-700 text-sm px-4 py-1 rounded-full shadow-sm bg-white">
          MetryV
        </div>
        <div class="border border-gray-300 text-gray-700 text-sm px-4 py-1 rounded-full shadow-sm bg-white">
          Onboarding Platform
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RoleDetails",
};
</script>

<style scoped>
/* Additional styles if needed */
</style>