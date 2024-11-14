import { createRouter, createWebHistory } from 'vue-router';
import Login from '../Components/Login.vue';
import Home from '../Components/Home.vue';
import Overview from '../Components/Overview.vue'; 
import Teams from '../Components/Teams.vue'; 
import RoleDetails from '../Components/RoleDetails.vue';
import TechnologyStack from '../Components/TechnologyStack.vue'; 
import ProcessesSchedules from '../Components/ProcessesSchedules.vue'; 
import Resources from '../Components/Resources.vue'; 
import SignOut from '../Components/SignOut.vue'; 



const routes = [
  { path: '/login', name: 'Login', component: Login },
  { path: '/', name: 'Home', component: Home },
  { path: '/overview', name: 'Overview', component: Overview },
  { path: '/teams', name: 'Teams', component: Teams },
  { path: '/role-details', name: 'RoleDetails', component: RoleDetails },
  { path: '/technology-stack', name: 'TechnologyStack', component: TechnologyStack },
  { path: '/processes-schedules', name: 'ProcessesSchedules', component: ProcessesSchedules },
  { path: '/resources', name: 'Resources', component: Resources },
  { path: '/sign-out', name: 'SignOut', component: SignOut }


];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;