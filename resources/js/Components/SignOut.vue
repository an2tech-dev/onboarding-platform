<template>
  <p class="text-xl text-gray-700">Signing out...</p>
</template>

<script>
export default {
  name: 'SignOut',
  beforeMount() {
    // Remove authentication token
    localStorage.removeItem('token');

    // Redirect to login
    this.$router.push({ name: 'Login' });
  }
};
</script>
