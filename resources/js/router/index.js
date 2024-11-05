import { createRouter, createWebHistory } from 'vue-router';
import Overview from '../Components/Overview.vue';
import Teams from '../Components/Teams.vue';
import RoleDetails from '../Components/RoleDetails.vue';
import TechnologyStack from '../Components/TechnologyStack.vue';
import ProcessesSchedules from '../Components/ProcessesSchedules.vue';
import ResourcesDirectory from '../Components/ResourcesDirectory.vue';
import SignOut from '../Components/SignOut.vue';

const routes = [
  { path: '/overview', component: Overview },
  { path: '/teams', component: Teams },
  { path: '/role-details', component: RoleDetails },
  { path: '/technology-stack', component: TechnologyStack },
  { path: '/processes-schedules', component: ProcessesSchedules },
  { path: '/resources', component: ResourcesDirectory },
  { path: '/sign-out', component: SignOut },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;