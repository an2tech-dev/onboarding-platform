import axios from 'axios';

class ApiService {
  constructor() {
    this.apiClient = axios.create({
      baseURL: import.meta.env.VITE_API_URL || 'http://localhost/api', // Use VITE_API_URL from .env
      headers: {
        'Content-Type': 'application/json',
      },
    });
  };

  getAuthToken() {
    return localStorage.getItem('token'); 
  }

  setAuthHeader() {
    const token = this.getAuthToken();
    if (token) {
      this.apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
  }

  post(endpoint, data) {
    this.setAuthHeader(); 
    return this.apiClient.post(endpoint, data).then(response => response.data).catch(error => {
      console.error('Error posting data:', error);
      throw error;
    });
  }

  get(endpoint) {
    this.setAuthHeader(); 
    return this.apiClient.get(endpoint).then(response => response.data).catch(error => {
      console.error('Error fetching data:', error);
      throw error;
    });
  }

  put(endpoint, data) {
    this.setAuthHeader();
    return this.apiClient.put(endpoint, data).then(response => response.data).catch(error => {
      console.error('Error updating data:', error);
      throw error;
    });
  }

  delete(endpoint) {
    this.setAuthHeader();
    return this.apiClient.delete(endpoint).then(response => response.data).catch(error => {
      console.error('Error deleting data:', error);
      throw error;
    });
  }
}

const apiService = new ApiService();
export default apiService;