<template>
  <!-- Contenido cargado -->
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <SidebarAdmin class="hidden md:block"/>
    
    <SidebarAll class="hidden md:block"/>
   
    <div class="flex-1 flex flex-col min-h-screen">
      <!-- Header -->
        <header class="bg-gray-900 shadow p-4 flex justify-between items-center">
            <h1 
                class="text-lg font-semibold text-gray-200">
                Bienvenido, {{ authStore.user?.name }} 👋
            </h1>
            <button
              @click="handleLogout"
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
import { useAuthStore } from '@/stores/authStore';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useToast } from "vue-toastification";

const currentYear = new Date().getFullYear(); // Año para el footer
const authStore = useAuthStore();
const router = useRouter();
const toast = useToast();

// ciclo de vida del componene
onMounted(async () => {
  // const user = await authStore.fetchUser();
});

// cerrar sesion
const handleLogout = async () => {
  try {
    const response = await authStore.logout();

    if (response.code === 200) {
      toast.success("Sesión cerrada correctamente");
      router.push({ name: "login" });
    }else {
      toast.warning(`No se pudo cerrar sesión correctamente. Código: ${response.code}`);
    }
  } catch (error: any) {
    toast.error(`Error cerrando sesión. Código: ${error.response?.status || "500"}`);
  }
}

</script>

