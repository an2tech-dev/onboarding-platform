import axios from 'axios';

const apiService = {
    async fetchData(endpoint, config = {}) {
        try {
            const response = await axios.get(endpoint, config);
            return response.data;
        } catch (error) {
            console.error('Error fetching data:', error);
            throw error;
        }
    },

    async postData(endpoint, data) {
        try {
            const response = await axios.post(endpoint, data);
            return response.data;
        } catch (error) {
            console.error('Error posting data:', error);
            throw error;
        }
    },

};

export default apiService;