<template>
  <div class="login-container">
    <div class="login-form">
      <div class="form-header">
        <h2>An2Tech</h2>
      </div>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" v-model="email" id="email" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" v-model="password" id="password" required />
        </div>
        <button type="submit" class="btn-login">Login</button>
      </form>
      <p class="forgot-password">Forgot Password? Click to reset</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
import apiService from '@/services/apiService';

export default {
  data() {
    return {
      email: '',
      password: '',
      errorMessage: '',
    };
  },
  methods: {
    async handleLogin() {
      try {
        const response = await apiService.postData('/api/login', {
          email: this.email,
          password: this.password,
        });
        localStorage.setItem('token', response.token);
        this.$router.push('/welcome');
      } catch (error) {
        this.errorMessage = 'Login failed. Please check your credentials.';
        console.error('Login error:', error);
      }
    },
  },
};
</script>

<style scoped>
.login-container {
  background-color: #f2ebf9; 
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.login-form {
  background-color: #fff;
  padding: 40px;
  width: 300px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  text-align: center;
}

.form-header {
  margin-bottom: 20px;
}


.form-group {
  margin-bottom: 15px;
  text-align: left;
}

.form-group label {
  font-size: 14px;
  color: #6534ac;
  display: block;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

.btn-login {
  width: 100%;
  padding: 12px;
  background-color: #6534ac;
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 10px;
}

.btn-login:hover {
  background-color: #532b91;
}

.forgot-password {
  font-size: 12px;
  color: #6534ac;
  margin-top: 15px;
  cursor: pointer;
}

.error-message {
  color: red;
  margin-top: 15px;
}
</style>