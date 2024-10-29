// resources/js/app.js
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router'; 

import '../css/app.css'; 
createApp(App).use(router).mount('#app'); 
