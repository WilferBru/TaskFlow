<template>
  <div class="max-w-4xl mx-auto p-6">

    <!-- Encabezado navegación -->
    <div class="mb-4 flex items-center gap-3">
      <RouterLink :to="{ name: 'task' }" class="text-sm text-gray-700 hover:underline">
        ← Todas las tareas
      </RouterLink>
      <span class="text-gray-600">/</span>
      <h2 class="text-gray-700 text-lg font-semibol">Detalles de tarea</h2>
    </div>

    <!-- Estado de carga -->
    <div v-if="loading" class="p-8 bg-info-content text-gray-100 rounded-lg shadow">
      Cargando tarea...
    </div>

    <!-- Vista principal -->
    <div v-else-if="task" class="bg-info-content text-gray-100 rounded-lg shadow p-6 space-y-6">

      <!-- Fecha límite -->
      <div class="text-sm text-gray-300 select-none flex justify-between w-full">
          <div>
            Fecha límite:
            <span 
                class="font-medium"
                :class="dueDateInfo.color"
            >
                {{ formattedDate }} 
                <span v-if="dueDateInfo.message">
                  ({{ dueDateInfo.message }})
                </span>
            </span>
          </div>
          <!-- boton para acciones de la tarea -->
          <div class="relative">
            <!-- Boton para editar y borrar -->
            <OptionIcon
              class="text-gray-50 w-6 h-6"
            />
            <!-- <ul          
              class="absolute right-0.5 mt-2 w-30 bg-gray-100 dark:text-gray-800 rounded-box z-20 shadow-lg"
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
            </ul> -->
          </div>
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
            v-if="authStore.user?.role === 'admin' && authStore.user?.id_user !== task.user_id"
        >
            Tarea del usuario: {{ task.user_id }}
        </h3>

        <!-- Estado -->
        <div
          v-if="task.user_id === authStore.user?.id_user"
          class="relative inline-block"
         >
          <div
            class="text-sm px-3 py-1.5 rounded-lg font-bold cursor-pointer"
            :class="stateColor"
            @click="showDrop"
          >
            {{ task.state }}
          </div>

          <ul 
            v-if="openDropdown"          
            class="absolute right-0.5 mt-2 w-30 bg-gray-100 dark:text-gray-800 rounded-box z-20 shadow-lg"
          >
            <li
              v-for="s in stateTask.filter(st => st.id_state !== task?.id_state)" 
              :key="s.id_state"
            >              
              <button
                class="w-full text-left px-4 py-2 hover:bg-gray-300 hover:text-black rounded-box"
                @click="selectedState(task, s)"
              >
                {{ s.state }}
              </button>
            </li>
          </ul>
        </div>

      </div>

      <!-- Descripción -->
      <p class="text-gray-100 leading-relaxed whitespace-pre-line">
        {{ task.description || 'Sin descripción' }}
      </p>

      <hr class="border-gray-200"/>

      <!-- Detalles adicionales -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Categoría -->
        <div>
          <h3 class="text-sm text-gray-300 flex items-center gap-1">
            Categoría
            <TagIcon
              class="w-4 h4"
            />
          </h3>
          <p class="font-medium mt-2">{{ task.category }}</p>
        </div>

        <!-- Prioridad -->
        <div>
          <h3 class="text-sm text-gray-300 flex items-center gap-1">
            Prioridad
            <MegaphoneIcon 
              class="w-4 h-4"
            />
          </h3>
          <p 
            class="font-medium mt-2"
            :class="priorityColor"
          >
            {{ task.priority || 'Sin prioridad' }}
          </p>
        </div>

        <!-- Metadata -->
        <div>
          <h3 class="text-sm text-gray-300 flex items-center gap-1"
          >
            Atributos
            <SquareIcon 
              class="w-4 h-4"
            />
          </h3>
          <div v-if="task.metadata.length" class="mt-3 flex flex-wrap gap-2">
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
          <h3 class="text-sm text-gray-300 flex items-center gap-1"
          >
            Creada
            <CalendarIcon
              class="w-4 h-4"
            />
          </h3>
          <p class="font-medium mt-3">{{ createdAt }}</p>
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
import TagIcon from '@/components/common/icons/TagIcon.vue';
import MegaphoneIcon from '@/components/common/icons/MegaphoneIcon.vue';
import SquareIcon from '@/components/common/icons/SquareIcon.vue';
import CalendarIcon from '@/components/common/icons/CalendarIcon.vue';
import OptionIcon from '@/components/common/icons/OptionIcon.vue';

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

// color de el estado segun el nivel
const stateColor = computed(() => {
  const level = task.value?.state_level;
  if (level === 1) return "bg-orange-500";
  if (level === 2) return "bg-blue-500";
  if (level === 3) return "bg-green-600";
  return "text-gray-100";
});

// color de la prioridad
const priorityColor = computed(() => {
  const priority = task.value?.priority;
  if (priority === "alta") return "text-red-500";
  if (priority === "media") return "text-amber-500";
  if (priority === "baja") return "text-green-500";
  return "text-gray-100";
});

// color de la fecha limite segun el estado de esta misma 
const dueDateInfo = computed(() => {
  const state = task.value?.state_level;
  const due_date = task.value?.due_date;
  if (!due_date) return {
    color: "text-gray-200",
    message: "",
  };

  const today = new Date();
  const limit = new Date(due_date);

  // normalizamos horas para comparar solo fechas
  today.setHours(0, 0, 0, 0);
  limit.setHours(0, 0, 0, 0);

  if (state === 3) {
    return {
      color: "text-green-500",
      message: "Completado",
    };
  }

  if (today.getTime() === limit.getTime()) {
    // Es hoy
    return {
      color: "text-amber-300",
      message: "Vence Hoy"
    };
  }

  if (today > limit) {
    // fecha paso -> vencia
    return {
      color: "text-red-400",
      message: "Vencida",
    };
  }

  return {
    color: "text-gray-200",
    message: "",
  };
});

</script>
