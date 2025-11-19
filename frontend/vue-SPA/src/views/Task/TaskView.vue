<template>
    <div class="max-w-4xl mx-auto p-6">
        <div class="mb-4 flex items-center gap-3">
            <RouterLink
                :to="{ name: 'task' }"
                class="text-sm text-gray-700 hover:underline"
            >
               ← Voler
            </RouterLink>
            <span 
                class="text-gray-600"
            >/</span>
            <h2
                class="text-gray-700 text-lg font-semibold"
            >
                Detalles de tarea
            </h2>
        </div>  
        <div
            v-if="loading"
            class="p-8 bg-white text-gray-700 rounded-lg shadow"
        >
            Cargando Tarea...
        </div>      
        <div
            v-else-if="task"
            class="bg-white text-gray-700 rounded-lg shadow p-6 space-y-6"
        >
            <div class="text-sm text-gray-400 select-none">
                <span
                v-if="!editDate"
                @click="startEditDate"
                ref="due_dateEl"                
                class="cursor-pointer"
                ></span>
                <input 
                    v-else
                    type="date"
                    class="bg-transparent outline broder-b border-gray-300 text-gray-600"
                    v-model="local.due_date"
                    @blur="finishEditDate"
                    @keyup.enter="finishEditDate"

                >
            </div>            
            <!-- Titulo editable -->
            <div class="flex items-center gap-4">
                <div
                    ref="titleEl"
                    contenteditable="true"
                    class="text-2xl font-bold outline-none resize-none leading-tight wrap-break-word flex-1"
                    :aria-label="'Titulo de la tarea ' + (task.title ?? '')"
                ></div>

                <!-- Dropdown de estado -->
                <div
                    class="relative select-none"
                >
                    <span
                        ref="stateEl"
                        @click="toggleDropdown"
                        class="text-sm px-3 py-1.5 cursor-pointer"
                        :class="
                            task.state_level === 1 ? 'text-orange-400 font-bold' :
                            task.state_level === 2 ? 'text-blue-500 font-bold' :
                            task.state_level === 3 ? 'text-green-600 font-bold' :
                            'bg-gray-900'
                        "
                    ></span>
                    <!-- Dropdown -->
                    <div
                        v-if="dropOpen"
                        class="absolute right-0 mt-1 bg-gray-700 text-gray-200 border rounded-xl shadow w-40 z-20"
                    >
                        <div
                            v-for="s in state.filter(st => st.id_state !== task?.id_state)"
                            :key="s.id_state"
                            class="px-3 py-2 text-sm rounded-xl hover:bg-gray-500 hover:text-white"
                        >
                            {{ s.state }}
                        </div>
                    </div>
                 </div>
            </div>            
        </div>
    </div>
</template>

<script setup lang="ts">
import categoryService from '@/services/categoryService';
import stateTaskService from '@/services/stateTaskService';
import taskService from '@/services/taskService';
import { finished } from 'stream';
import { onMounted, ref, nextTick, onBeforeUnmount } from 'vue';
import { RouterLink, useRoute } from 'vue-router';


interface TaskData {
    id_task: number,
    title: string,
    due_date: Date,
    priority: string,
    metadata: string[],
    id_category: number,
    category: string,
    id_state: number,
    state: string,
    state_level: number,
    description: string,
    created_at: Date
}

const state = ref<{
    id_state: number,
    state: string,
    level: number
}[]>([]);

const category = ref<{
    id_category: number,
    category: string
}[]>([]);

// valores clonados de la bd para ser editables
const local = ref({
    title: "",
    due_date: new Date(),
    priority: "",
    metadata: [] as string[],
    id_category: 0,
    id_state: 0,
    state: "",
    description: "",
});

const route = useRoute();
const taskId = Number(route.params.id_task);
const loading = ref(true);
const task = ref<TaskData | null>(null);

// dropdown
const dropOpen = ref(false);

// refs editables
const titleEl = ref<HTMLElement | null>(null);
const due_dateEl = ref<HTMLElement | null>(null);
const priorityEl = ref<HTMLElement | null>(null);
const metadataEl = ref<HTMLElement | null>(null);
const id_categoryEl = ref<HTMLElement | null>(null);
const id_stateEl = ref<HTMLElement | null>(null);
const stateEl = ref<HTMLElement | null>(null);
const descriptionEl = ref<HTMLElement | null>(null);

// editar fecha limite
const editDate = ref(false);

// Recibimos la tarea, estado y categoria
async function loadTask() {
    loading.value = true;
    try {
        const response = await taskService.show(taskId);
        task.value = response.data as TaskData;

        // importante llenar el local con los valores originales
        local.value = {...task.value};

        // estado de tareas
        const stateRes = await stateTaskService.getAll();
        state.value = stateRes;

        // categorias
        const catRes = await categoryService.getAll();
        category.value = catRes;

        // esperar a que vue actualice el DOM
        await nextTick();
    } catch (error) {
        console.error('Error cargando tarea', error);
    } finally {
        loading.value = false;
    }
}

// abrir dropdown 
const toggleDropdown = () => {
    dropOpen.value = !dropOpen.value;
}

// evento global para cerrar dropdown del estado al darle click fuera
function handleClickOutside(e: MouseEvent) {
    const target = e.target as HTMLElement;
    const dropdown = stateEl.value?.parentElement // contennedor wapper

    if (dropdown && !dropdown.contains(target)) {
        dropOpen.value = false;
    }
}

onMounted( async () => {
    if (!taskId) return;

    await loadTask(); // ejecutamos tarea
    await nextTick();

    window.addEventListener('click', handleClickOutside); // cada que el usuario haga click en cualqueir parte de la apntalal cierre el drop

    if (titleEl.value) titleEl.value.innerText = local.value.title;
    if (descriptionEl.value) descriptionEl.value.innerText = local.value.description;
    if (priorityEl.value) priorityEl.value.innerText = local.value.priority;
    if (metadataEl.value) metadataEl.value.innerText = local.value.metadata.join(", ");
    // Poner el formato de fecha deseable
    if (due_dateEl.value) {
        if (!local.value.due_date) {
            due_dateEl.value.innerText = 'Sin fecha límite';
            return;
        }
        const formatted = new Date(local.value.due_date).toLocaleDateString(
            'es-ES',
            {day: 'numeric', month: 'long'}
        );
        due_dateEl.value.innerText = `Fecha limite: ${formatted}`;
    }
    if (id_categoryEl.value) id_categoryEl.value.innerText = String(local.value.id_category);
    if (id_stateEl.value) id_stateEl.value.innerText = String(local.value.id_state);
    if (stateEl.value) stateEl.value.innerText = String(local.value.state);
});

// quitar el listener global al cambiar de componente o vista
onBeforeUnmount(() => {
    window.removeEventListener('click', handleClickOutside)
});

/**
 * abrir y cerrar input para editar la fecha limite
 */

 function startEditDate() {
    editDate.value = true;
 }

 async function finishEditDate() {
    editDate.value = false;

    // esperar a que vue muestre de neuvo el span 
    await nextTick();

    if (!due_dateEl.value) return;

    // si no hay fecha m,sotramos sin fecha limite
    if (!local.value.due_date) {
        due_dateEl.value.innerText = "Sin fecha límite";
        return;
    }
    
    // si hay fecha -> formatearla
    const formatted = new Date(local.value.due_date + "T00:00:00").toLocaleDateString(
        'es-ES',
        { day: 'numeric', month: 'long' }
    );
    due_dateEl.value.innerText = `Fecha límite: ${formatted}`;
 }

</script>