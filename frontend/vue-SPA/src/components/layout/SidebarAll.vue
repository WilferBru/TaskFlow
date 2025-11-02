<template>
  <aside class="w-75 bg-white shadow-md p-2">
    <div class="flex flex-col h-full bg-gray-200 rounded-2xl">
      
      <!-- Logo + botón -->
      <div class="flex items-center justify-between py-3 px-4 mb-4">
        <RouterLink :to="{ name: 'home' }">
          <h2 class="text-2xl text-gray-900 font-bold">TaskFlow</h2>
        </RouterLink>

        <RouterLink
          v-if="route.name !== 'create_task'"
          :to="{ name: 'create_task' }"
          class="dark:bg-black px-4 py-2 rounded-3xl text-gray-50 hover:bg-gray-600 hover:text-shadow-gray-600"
        >
          Crear Tarea
        </RouterLink>
      </div>
      
      <div class="flex justify-center mb-4">   
        <div class="relative w-60">
          <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg 
              class="w-5 h-5 text-gray-700 dark:text-gray-700" 
              fill="currentColor" viewBox="0 0 20 20" 
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 
              01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
          </div>

          <input 
            type="text" 
            id="simple-search" 
            class="text-sm rounded-4xl w-full pl-10 p-2.5 bg-gray-300 placeholder-gray-700 text-gray-800" 
            placeholder="Buscar Tarea..." 
            required
          >
        </div>
      </div>
      <SelectSidebar />

    </div>
  </aside>
</template>


<script setup lang="ts">
import SelectSidebar from './SelectSidebar.vue';
import { useRoute } from 'vue-router';

const route = useRoute();
</script>