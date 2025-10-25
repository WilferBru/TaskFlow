<template>
  <div class="min-h-screen flex bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-50 bg-white shadow-md p-4">
      <h2 class="text-2xl font-bold mb-6">TaskFlow</h2>
      <nav class="space-y-2">
        <RouterLink
          :to="{ name: 'home' }"
          class="block px-4 py-2 rounded hover:bg-gray-100"
          :class="{ 'bg-gray-200 font-semibold': $route.name === 'home' }"
        >
          Inicio
        </RouterLink>
        <RouterLink
          :to="{ name: 'task' }"
          class="block px-4 py-2 rounded hover:bg-gray-100"
          :class="{ 'bg-gray-200 font-semibold': $route.name === 'task' }"
        >
          Mis Tareas
        </RouterLink>
        <RouterLink
          :to="{ name: 'profile' }"
          class="block px-4 py-2 rounded hover:bg-gray-100"
          :class="{ 'bg-gray-200 font-semibold': $route.name === 'profile' }"
        >
          Perfil
        </RouterLink>
      </nav>
    </aside>
    <div class="flex-1 flex flex-col min-h-screen">
      <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-gray-700">
                Bienvenido, Wilfer 👋
            </h1>
            <button
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
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
    const currentYear = new Date().getFullYear();
</script>
