<template>
  <div class="container">
    <div class="welcome-section">
      <h1>Welcome to An2tech team</h1>
      <p>Ketu eshte fillimi jone me Vue, faleminderit per vemendjen,nuk duam pytje.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Welcome',
};
</script>

<style scoped>
.container {
  background-color: #f2ebf9; 
  height: 100vh; 
  display: flex;
  justify-content: center;
  align-items: center;
}

.welcome-section {
  background-color: #fff;
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.welcome-section h1 {
  font-size: 24px;
  color: #6534ac; 
  margin-bottom: 10px;
}

.welcome-section p {
  font-size: 16px;
  color: #666;
}
</style>