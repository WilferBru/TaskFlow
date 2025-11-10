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
            <div class="dropdown dropdown-end">
              <div tabindex="0" role="button" class="m-1 bg-gray-300 items-center w-10 h-10 rounded-4xl">
                <UserIcon />
              </div>
              <ul tabindex="-1" class="dropdown-content menu bg-gray-200 rounded-box z-1 w-52 p-2 shadow-sm">
                <li class="px-2 py2 text-gray-700">
                  <RouterLink
                    to=""
                    class="hover:bg-gray-700 hover:text-gray-200"
                  >
                    Perfil
                  </RouterLink>
                </li>
                <li class="px-2 py2 text-gray-700">
                  <button
                    onclick="logout.showModal()"                    
                    class="hover:bg-gray-700 hover:text-gray-200"
                  >
                    Cerrar Sesion
                  </button>
                </li>
              </ul>
            </div>
        </header>
        <!-- Modal para cerrqar sesion -->
        <dialog id="logout" class="modal">
          <div class="modal-box">
            <h3 class="text-lg font-bold">¿Quieres cerrar sesion?</h3>
            <p class="py-4">Preciona salir para cerrar sesion</p>
            <div class="modal-action">
              <form method="dialog">
                <button 
                  class="btn bg-red-500 hover:bg-red-400"
                >
                  Cancelar
                </button>
                <button 
                  type="button"
                  class="btn bg-blue-500 hover:bg-blue-400" 
                  @click="handleLogout"
                >
                  Salir
                </button>
              </form>
            </div>
          </div>
        </dialog>
        <!-- Contenido dinamico -->
        <main class="flex-1 p-6">
            <RouterView />
        </main>

        <!-- Footer -->
         <footer class="bg-white shadow-inner text-center p-4 text-sm text-gray-500">
            © {{ currentYear }} TaskFlow. Software desarrolaldo por <b>Wilfer Bru</b>
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
import UserIcon from '@/components/common/icons/UserIcon.vue';
import { text } from 'stream/consumers';

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

