// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../components/Home.vue';
import Processes from '../components/Processes.vue';
import Resources from '../components/Resources.vue';
import Floor1 from '../components/Floor1.vue';
import Floor2 from '../components/Floor2.vue';
import Welcome from '../components/Welcome.vue';

const routes = [
  { path: '/home', component: Home },
  { path: '/processes', component: Processes },
  { path: '/resources', component: Resources },
  { path: '/teams/floor1', component: Floor1 },
  { path: '/teams/floor2', component: Floor2 },
  // { path: '/', redirect: '/home' },
  { path: '/welcome', component: Welcome }, 
  { path: '/', redirect: '/welcome' } 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;