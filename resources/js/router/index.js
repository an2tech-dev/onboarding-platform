import { createRouter, createWebHistory } from 'vue-router';
import Welcome from '../Components/Welcome.vue';

const routes = [
  { path: '/welcome', component: Welcome },
  { path: '/', redirect: '/welcome' },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;