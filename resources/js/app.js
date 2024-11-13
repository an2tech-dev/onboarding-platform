import { createApp } from 'vue';
import App from './Components/App.vue';
import router from './router/index.js';
import '../css/app.css';  

const app = createApp(App);
app.use(router); 
app.mount('#app'); 