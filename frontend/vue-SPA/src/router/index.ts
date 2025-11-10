import { createRouter, createWebHistory } from 'vue-router';
import MainLayout from '@/layouts/MainLayout.vue';

// Vistas
import HomeView from "@/views/HomeView.vue";
//tareas
import TasksView from "@/views/Task/TasksView.vue";
import CreareTaskView from '@/views/Task/CreareTaskView.vue';
//user
import ProfileView from "@/views/ProfileView.vue";

// Auth
import LoginView from '@/views/Auth/LoginView.vue';
import RegisterView from '@/views/Auth/RegisterView.vue';

/**
 * Admin
 */
// categories
import CategoriesView from '@/views/admin/category/CategoriesView.vue';
// state tasks
import StateTasks from '@/views/admin/stateTask/StateTasks.vue';
// users
import UsersView from '@/views/admin/users/UsersView.vue';

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
          path: 'crear-tareas',
          name: 'create_task',
          component: CreareTaskView,
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

    // admin
    {
      path: '/admin/',
      component: MainLayout,
      children: [
        // Categorias
        {
          path: 'categorias',
          name: 'categories',
          component: CategoriesView,
          meta: { requiresAuth: true },
        },

        // State tasks
        {
          path: 'estados-tareas',
          name: 'state-tasks',
          component: StateTasks,
          meta: { requiresAuth: true },
        },

        // Users
        {
          path: 'usuarios',
          name: 'users',
          component: UsersView,
          meta: { requiresAuth: true },
        },
      ]
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

// middleware global para proteger rutas
router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem("token");

  // Si no esta logueado y la ruta requeire auth -> redirige al login
  if (to.meta.requiresAuth && !isAuthenticated) {
    next({ name: "login" });
  }
  // si esta loguado y quiere ir a login o registre, sera redirigido a home
  else if (to.meta.requiresGuest && isAuthenticated) {
    next({ name: "home" });
  }else {
    next(); // puede seguir
  }
});

export default router
