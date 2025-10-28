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
          component: HomeView,
          meta: { requiresAuth: true },
        },
        {
          path: 'tareas',
          name: 'task',
          component: TasksView,
          meta: { requiresAuth: true },
        },
        {
          path: 'perfil',
          name: 'profile',
          component: ProfileView,
          meta: { requiresAuth: true },
        }
      ],    
    },

    // Auth
    {
      path: '/login',
      name: "login",
      component: LoginView,
      meta: { requiresGuest: true },
    },
    {
      path: '/registrarse',
      name: 'register',
      component: RegisterView,
      meta: { requiresGuest: true },
    }
  ],
})



export default router
