import { createRouter, createWebHistory } from 'vue-router';
import MainLayout from '@/layouts/MainLayout.vue';

// Vistas
import HomeView from "@/views/HomeView.vue";
import TasksView from "@/views/TasksView.vue";
import ProfileView from "@/views/ProfileView.vue";

// Auth
import LoginView from '@/views/Auth/LoginView.vue';
import RegisterView from '@/views/Auth/RegisterView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: MainLayout,
      children: [
        {
          path: '',
          name: 'home',
          component: HomeView
        },
        {
          path: 'Tareas',
          name: 'task',
          component: TasksView
        },
        {
          path: 'Perfil',
          name: 'profile',
          component: ProfileView,
        }
      ],    
    },

    // Auth
    {
      path: '/Login',
      name: "login",
      component: LoginView,
    },
    {
      path: '/Registrarse',
      name: 'register',
      component: RegisterView,
    }
  ],
})

export default router
