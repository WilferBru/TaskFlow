<template>
<div class="container mx-auto px-4 py-8">
  <div 
    v-if="tasks.length === 0"
    class="flex flex-col items-center justify-center text-center py-10"
  >
    <p class="text-xl font-semibold text-gray-700">🎉 No tienes tareas por ahora</p>
    <p class="text-sm text-gray-500 mt-1">Crea una nueva tarea para comenzar.</p>
  </div>
  <!-- Tareas -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div
      v-for="t in tasks"
      :key="t.id_task"
      class="flex flex-col group bg-info-content rounded-2xl p-4 transition-all duration-300 lg:p-8"
    >
      <div 
        class="mb-3 text-right"
      >
        <div
          v-if="t.user_id === authStore.user?.id_user"
          class="dropdown dropdown-end relative"
        >
          <button
            @click="openDropdown === t.id_task ? openDropdown = null : openDropdown = t.id_task"
            class="btn rounded-2xl text-white"
            :class="
              t.state_level === 1 ? 'bg-amber-800 hover:bg-amber-600' :
              t.state_level === 2 ? 'bg-blue-800 hover:bg-blue-500' :
              t.state_level === 3 ? 'bg-emerald-700 hover:bg-emerald-500' :
              'bg-gray-900'
            "
          >
            {{ t.state }}
          </button>

          <ul
            v-if="openDropdown === t.id_task"
            class="absolute right-0 mt-2 w-52 bg-base-200 text-gray-900 dark:text-gray-100 rounded-box z-20 shadow-lg"
          >
            <li
              v-for="s in state.filter(st => st.id_state !== t.id_state)"
              :key="s.id_state"
            >
              <button
                class="w-full text-left px-4 py-2 hover:bg-gray-300 hover:text-black rounded"
                @click="selectedState(t, s)"
              >
                {{ s.state }}
              </button>
            </li>
          </ul>
        </div>
        <!-- Mostrar de quien es la tarea -->
          <div
          v-else
          class="dropdown dropdown-end relative"
          >
            <h4 class="font-medium">Tarea del user: {{ t.user_id }}</h4>
          </div>
      </div>
      <RouterLink
        :to="{ name: 'task.show', params: { id_task: t.id_task } }"
      >
        <div            
          class="flex items-center gap-x-2">
          <div>
            <h3 class="text-2xl font-bold text-gray-50">{{ t.title }}</h3>
            <span class="text-xs text-gray-300" v-if="t.due_date"><b>Fecha limite:</b> {{ formatDueDate(t.due_date) }}</span>
            <span class="text-xs text-gray-300" v-else><b>Sin fecha limite</b></span>
          </div>
        </div>
        <div class="my-4 flex-1"> 
          <div class="text-sm font-medium">
            <p
              v-if="t.description"
            >
              {{ t.description }}
            </p>
            <p v-else>
              Sin descripción
            </p>
          </div>
        </div>
    </RouterLink>
      <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-700">
        <span 
          class="text-sm font-medium text-gray-50 px-3 rounded-2xl" title="prioridad"
          :class="
            t.priority === 'alta' ? 'bg-red-400' :
            t.priority === 'media' ? 'bg-amber-600' :
            t.priority === 'baja' ? 'bg-blue-500' :
            'bg-gray-900'
          "
        >
          {{ t.priority }}
        </span>
        <div class="px-3 font-medium transition-all duration-300 rounded-2xl" title="categoria">
          <TagIcon class="inline-block mr-1 w-4 h-4"/> 
          {{ t.category }}
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script setup lang="ts">
// import ListTask from '@/components/common/icons/listTask.vue';
import TagIcon from '@/components/common/icons/TagIcon.vue';
import taskService from '@/services/taskService';
import stateTaskService from '@/services/stateTaskService';
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";
import { useAuthStore } from '@/stores/authStore';

const toast = useToast();

const authStore = useAuthStore();

const openDropdown = ref<number | null>(null);

function formatDueDate(due: string | Date | null | undefined): string {
  if (!due) return "Sin fecha límite";

  let dateOnly = "";

  // Si viene como Date: extraer manual YYYY-MM-DD
  if (due instanceof Date) {
    const y = due.getFullYear();
    const m = String(due.getMonth() + 1).padStart(2, "0");
    const d = String(due.getDate()).padStart(2, "0");
    dateOnly = `${y}-${m}-${d}`;
  } else {
    // Si viene en string
    dateOnly = due.split("T")[0] ?? due;
  }

  const parts = dateOnly.split("-");
  if (parts.length !== 3) return "Sin fecha límite";

  const [year, month, day] = parts;

  const date = new Date(Number(year), Number(month) - 1, Number(day));

  return date.toLocaleDateString("es-ES", {
    day: "numeric",
    month: "long",
  });
}

const tasks = ref<{
  id_task: number,
  title: string,
  user_id: number,
  due_date: Date,
  priority: string,
  id_category: number,
  category: string,
  id_state: number,
  state: string,
  state_level: number,
  description: Text,
  metadata: string
}[]>([]);

const state = ref<{
  id_state: number,
  state: string,
  level: number
}[]>([]);

const handleClickOutside = (event: MouseEvent) => {
  // si el click está dentro de algún elemento con clase "dropdown", no hacemos nada
  const clickedInsideDropdown = (event.target as HTMLElement).closest('.dropdown');
  if (!clickedInsideDropdown) {
    openDropdown.value = null; // cierra cualquier dropdown abierto
  }
};

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside);
});

onMounted(async () => {
  document.addEventListener('click', handleClickOutside); // cerrar drops al hjacer click afuera
    // Obtener las tareas
    try {
      const response = await taskService.getAll();
      tasks.value = response.data;
    } catch (error) {
      console.error("Error cargando tareas:", error); 
    }
    
    // obtner los estados de tareas
    try {
      const response = await stateTaskService.getAll();
      state.value = response;
    } catch (error) {
      console.error("Error cargando estado de tareas: ", error); 
    }
});

const selectedState = async (task: any, stateItem: any) => {
  try {
    await taskService.updateState({
      id_task: task.id_task,
      state_id: stateItem.id_state
    });

    // actualizar en la UI
    task.state = stateItem.state;
    task.id_state = stateItem.id_state;
    task.state_level = stateItem.level;

    // cerrar el dropdown al seleccionar
    openDropdown.value = null;

    toast.success(`Se actualizo el estado de la tarea ${task.title}`);
  } catch (error) {
    console.error(error);
    toast.error("Error actualizando estado");
  }
};

</script>

