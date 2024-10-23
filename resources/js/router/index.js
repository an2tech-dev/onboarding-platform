// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue'; 
import DataComponent from '../components/DataComponent.vue'; 

const routes = [
    { path: '/login', component: Login },
    { path: '/data', component: DataComponent }, 
    { path: '/', redirect: '/login' }, 
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;