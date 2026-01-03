import './assets/main.css';

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App from './App.vue';
import router from './router';

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

const app = createApp(App);

app.config.devtools = true;  // <--- activa Devtools

// Primero registramos Pinia
const pinia = createPinia();
app.use(pinia);
app.use(router);
app.use(Toast);

// app.mount('#app');

import { useAuthStore } from './stores/authStore';
const authStore = useAuthStore();

const initApp = async () => {
    if (authStore.token) {
        await authStore.fetchUser();
    }
    app.mount('#app');
};

initApp();
