import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { routes } from './routes';
import 'bootstrap/dist/css/bootstrap.min.css'
import 'toastr/build/toastr.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css'

import App from './pages/App.vue';

let app = createApp(App);

const router = createRouter({
    history: createWebHistory('pranav/task_manager'),
    routes: routes
});

app.use(router);
app.mount('#app');
