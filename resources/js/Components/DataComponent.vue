<template>
    <div>
        <h1>Product List</h1>
        <ul>
            <li v-for="product in products" :key="product.id">{{ product.name }}</li>
        </ul>
    </div>
</template>

<script>
import apiService from '@/services/apiService'; 

export default {
    data() {
        return {
            products: [],
            errorMessage: '',
        };
    },
    async created() {
        await this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            try {
                const token = localStorage.getItem('token'); 
                const response = await apiService.fetchData('/api/products', {
                    headers: {
                        Authorization: `Bearer ${token}`, 
                    },
                });
                this.products = response; 
            } catch (error) {
                this.errorMessage = 'Error fetching products.';
                console.error('Error fetching products:', error);
            }
        },
       
         
    },
};
</script>