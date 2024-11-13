import { createRouter, createWebHistory } from 'vue-router';
import Login from '../Components/Login.vue';
import Home from '../Components/Home.vue';


const routes = [
  { path: '/login', name: 'Login', component: Login },
  { path: '/', name: 'Home', component: Home }


];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;