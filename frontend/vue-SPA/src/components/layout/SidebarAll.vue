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
            class="text-sm rounded-4xl w-full pl-10 p-2.5 bg-gray-300 placeholder-gray-700 text-gray-800 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition" 
            placeholder="Buscar Tarea..." 
            required
          >
        </div>
      </div>
      <div class="grow overflow-y-auto px-6 pb-6">

        <!-- Filtros -->
        <div class="mt-2">
          <h2 class="text-lg font-bold text-gray-800 mb-3">Filtrar Tareas</h2>

          <button
            class="block w-full bg-emerald-500 text-gray-200 text-center py-2 rounded-xl mb-3 hover:bg-emerald-600 hover:text-gray-200 transition"
            popovertarget="popover-1" style="anchor-name:--anchor-1"
          >
            👍​ Ver tareas completadas
          </button>
          
          <RouterLink
            to="/"
            class="block w-full bg-blue-400 text-gray-200 text-center py-2 rounded-xl mb-3 hover:bg-blue-500 hover:text-gray-200 transition"
          >
            ⚡ Ver tareas en proceso
          </RouterLink>

          <RouterLink
            to="/"
            class="block w-full bg-amber-200 text-gray-600 text-center py-2 rounded-xl hover:bg-amber-400 hover:text-gray-600 transition"
          >
            ⏳ Ver tareas pendientes
          </RouterLink>
        </div>

        <!-- RESUMEN -->
        <div class="mt-8">
          <h2 class="text-lg font-bold text-gray-800 mb-4">Resumen de tareas</h2>

          <div class="space-y-2">

            <p class="flex justify-between">
              <span class="text-gray-600">📝 Total:</span>
              <span class="font-bold text-gray-900">{{ summaryTaskStore.total }}</span>
            </p>

            <p class="flex justify-between">
              <span class="text-red-600">🔥 Alta:</span>
              <span class="font-bold text-red-700">{{ summaryTaskStore.alta }}</span>
            </p>

            <p class="flex justify-between">
              <span class="text-yellow-600">⚠️ Media:</span>
              <span class="font-bold text-yellow-700">{{ summaryTaskStore.media }}</span>
            </p>

            <p class="flex justify-between">
              <span class="text-green-600">🟢 Baja:</span>
              <span class="font-bold text-green-700">{{ summaryTaskStore.baja }}</span>
            </p>

          </div>
        </div>

        <!-- TIP -->
        <div class="mt-10 bg-gray-300 rounded-xl p-4 text-gray-700 text-sm italic">
          💡 {{ randomTip }}
        </div>

      </div>

    </div>
  </aside>
</template>


<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useTaskSummaryStore } from '@/stores/taskSummaryStore';

const summaryTaskStore = useTaskSummaryStore();
const route = useRoute();
const randomTip = ref<string>("");

// concejo 
const tips = [
  "Organiza tu día creando primero tus tareas más importantes.",
  "Toma descansos cortos para mantener tu productividad alta.",
  "Revisa tus tareas pendientes antes de comenzar el día.",
  "No acumules tareas: completa las rápidas en menos de 2 minutos.",
  "Usa el filtro de búsqueda para encontrar tus tareas por estado, categoría o título.",
  "Recuerda que puedes crear hasta 10 atributos por tarea y editarlos o eliminarlos cuando quieras.",
  "No olvides cambiar el estado de tus tareas para evitar información desactualizada.",
  "Ten siempre en cuenta las fechas límite, especialmente en tareas de alta prioridad.",
];

onMounted(() => {
  // resumen de las tareas
  summaryTaskStore.loadSummary();
  // Tip inicial
  randomTip.value = tips[Math.floor(Math.random() * tips.length)]!;

  // Cambiar cada 5 min (300000 ms)
  setInterval(() => {
    randomTip.value = tips[Math.floor(Math.random() * tips.length)]!;
  }, 300000);
});


</script>