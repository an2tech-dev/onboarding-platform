import axios from 'axios';

class ApiService {
  constructor() {
    this.apiClient = axios.create({
      baseURL: 'http://onboarding-platform.test/api', 
      headers: {
        'Content-Type': 'application/json',
      },
    });
  }

  getAuthToken() {
    return localStorage.getItem('token'); 
  }

  setAuthHeader() {
    const token = this.getAuthToken();
    if (token) {
      this.apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
  }

  // POST method
  post(endpoint, data) {
    this.setAuthHeader(); 
    return this.apiClient
      .post(endpoint, data)
      .then(response => response.data)
      .catch(error => {
        console.error('Error posting data:', error);
        throw error;
      });
  }

  // GET method
  get(endpoint) {
    this.setAuthHeader(); 
    return this.apiClient
      .get(endpoint)
      .then(response => response.data)
      .catch(error => {
        console.error('Error fetching data:', error);
        throw error;
      });
  }

  // PUT method
  put(endpoint, data) {
    this.setAuthHeader();
    return this.apiClient
      .put(endpoint, data)
      .then(response => response.data)
      .catch(error => {
        console.error('Error updating data:', error);
        throw error;
      });
  }

  // DELETE method
  delete(endpoint) {
    this.setAuthHeader();
    return this.apiClient
      .delete(endpoint)
      .then(response => response.data)
      .catch(error => {
        console.error('Error deleting data:', error);
        throw error;
      });
  }
}

const apiService = new ApiService();
export default apiService;