<template>
  <div class="max-w-4xl mx-auto p-6">

    <!-- Encabezado navegación -->
    <div class="mb-4 flex items-center gap-3">
      <RouterLink :to="{ name: 'task' }" class="text-sm text-gray-700 hover:underline">
        ← Todas las tareas
      </RouterLink>
      <span class="text-gray-600">/</span>
      <h2 class="text-gray-700 text-lg font-semibold">Detalles de tarea</h2>
    </div>

    <!-- Estado de carga -->
    <div v-if="loading" class="p-8 bg-white text-gray-700 rounded-lg shadow">
      Cargando tarea...
    </div>

    <!-- Vista principal -->
    <div v-else-if="task" class="bg-white text-gray-700 rounded-lg shadow p-6 space-y-6">

      <!-- Fecha límite -->
      <div class="text-sm text-gray-400 select-none">
            Fecha límite:
            <span 
                class="font-medium text-gray-700"
            >
                {{ formattedDate }}
            </span>
      </div>

      <!-- Título y estado -->
      <div class="flex items-center gap-4">
        <h1
            class="text-2xl font-bold outline-none resize-none leading-tight wrap-break-word flex-1"
            :aria-label="'Titulo de la tarea' + (task.title ?? '')"            
        >
          {{ task.title }} 
        </h1>
        
        <h3
            v-if="authStore.user?.role === 'admin'"
        >
            Id del usuario: {{ task.user_id }}
        </h3>

        <!-- Estado -->
        <div class="relative inline-block">
          <div
            class="text-sm px-3 py-1.5 rounded-lg font-bold cursor-pointer"
            :class="stateColor"
            @click="showDrop"
          >
            {{ task.state }}
          </div>

          <ul 
            v-if="openDropdown"          
            class="absolute right-0.5 mt-2 w-52 bg-gray-100 dark:text-gray-800 rounded-box z-20 shadow-lg"
          >
            <li
              v-for="s in stateTask.filter(st => st.id_state !== task?.id_state)" 
              :key="s.id_state"
            >              
              <button
                class="w-full text-left px-4 py-2 hover:bg-gray-300 hover:text-black rounded"
                @click="selectedState(task, s)"
              >
                {{ s.state }}
              </button>
            </li>
          </ul>
        </div>

      </div>

      <!-- Descripción -->
      <p class="text-gray-700 leading-relaxed whitespace-pre-line">
        {{ task.description || 'Sin descripción' }}
      </p>

      <hr class="border-gray-200"/>

      <!-- Detalles adicionales -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Categoría -->
        <div>
          <h3 class="text-sm text-gray-500">Categoría</h3>
          <p class="font-medium">{{ task.category }}</p>
        </div>

        <!-- Prioridad -->
        <div>
          <h3 class="text-sm text-gray-500">Prioridad</h3>
          <p class="font-medium">{{ task.priority || 'Sin prioridad' }}</p>
        </div>

        <!-- Metadata -->
        <div>
          <h3 class="text-sm text-gray-500">Atributos</h3>
          <div v-if="task.metadata.length">
            <span
              v-for="(tag, i) in task.metadata"
              :key="i"
              class="text-xs px-2 py-1 bg-gray-100 rounded-full text-gray-600 mr-2"
            >
              {{ tag }}
            </span>
          </div>
          <p v-else class="text-gray-400">Sin etiquetas</p>
        </div>

        <!-- Fecha de creación -->
        <div>
          <h3 class="text-sm text-gray-500">Creada</h3>
          <p class="font-medium">{{ createdAt }}</p>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useRoute, RouterLink } from 'vue-router';
import taskService from '@/services/taskService';
import { useAuthStore } from '@/stores/authStore';
import stateTaskService from '@/services/stateTaskService';

interface TaskData {
  id_task: number;
  user_id: number;
  title: string;
  due_date: string | null;
  priority: string;
  metadata: string[];
  id_category: number;
  category: string;
  id_state: number;
  state: string;
  state_level: number;
  description: string;
  created_at: string;
}

const route = useRoute();
const taskId = Number(route.params.id_task);

const authStore = useAuthStore();

const loading = ref(true);
const task = ref<TaskData | null>(null);

const stateTask = ref<{
  id_state: number;
  state: string;
  level: number;
}[]>([]);

// dropdown para cambiar el estadod ela tarea
const openDropdown = ref(false);

onMounted(async () => {
  try {
    const [resTask, resState] = await Promise.all([
      taskService.show(taskId), // trer solo la tarea
      stateTaskService.getAll(), // traer los estados
    ]);

    task.value = resTask.data;
    stateTask.value = resState;

  } catch (e) {
    console.error("Error al cargar datos", e);
  } finally {
    loading.value = false;
  }
});

// mostrar dropdown y actualizar estado de tareas
const showDrop = () => {
  openDropdown.value = !openDropdown.value
}

const selectedState = async (task: any, stateItem: any) => {
  try {
    await taskService.updateState({
      id_task: task.id_task,
      state_id: stateItem.id_state
    });

    // Actualizar en la UI
    task.state = stateItem.state;
    task.id_state = stateItem.id_state;
    task.state_level = stateItem.level;

    // cerrar el dropdown al actualizar
    openDropdown.value = false;
    
  } catch (error) {
    console.error("Error al actualizar estado: ", error);
  }
}

// formato de fecha legible para la fecha limite
const formattedDate = computed(() => {
  if (!task.value?.due_date) return "Sin fecha límite"
  return new Date(task.value.due_date).toLocaleDateString(
    "es-ES",
    { day: "numeric", month: "long" }
  );
});

// formato de fecha legible para created_at
const createdAt = computed(() => {
  if (!task.value?.created_at) return ""
  return new Date(task.value.created_at).toLocaleDateString(
    "es-ES",
    { day: "numeric", month: "long", year: "numeric" }
  );
});

const stateColor = computed(() => {
  const level = task.value?.state_level;
  if (level === 1) return "text-orange-500";
  if (level === 2) return "text-blue-500";
  if (level === 3) return "text-green-600";
  return "text-gray-700";
});

</script>
