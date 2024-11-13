// axios.js
import axios from 'axios';

axios.defaults.baseURL = 'http://onboarding-platform.test/api';

axios.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default axios;