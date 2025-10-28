<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <SidebarAdmin class="hidden md:block"/>
    
    <SidebarAll class="hidden md:block"/>
   
    <div class="flex-1 flex flex-col min-h-screen">
      <!-- Header -->
        <header class="bg-gray-900 shadow p-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-200">
                Bienvenido, Wilfer 👋
            </h1>
            <button
              class="bg-blue-700 text-white px-4 py-4 rounded hover:bg-blue-700 transition"
            >
                Cerrar sesión
            </button>
        </header>

        <!-- Contenido dinamico -->
        <main class="flex-1 p-6">
            <RouterView />
        </main>

        <!-- Footer -->
         <footer class="bg-white shadow-inner text-center p-4 text-sm text-gray-500">
            © {{ currentYear }} TaskFlow. Todos los derechos reservados.
         </footer>
    </div>
  </div>
</template>

<script setup lang="ts">
// import { ref } from 'vue';
import SidebarAdmin from '@/components/layout/SidebarAdmin.vue';
import SidebarAll from '@/components/layout/SidebarAll.vue';

const currentYear = new Date().getFullYear(); // Año para el footer
</script>

