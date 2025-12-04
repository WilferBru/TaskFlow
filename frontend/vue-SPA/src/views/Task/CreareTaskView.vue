<template>
  <div class="bg-gray-200 rounded-2xl p-8 shadow-2xl">
    <h1 class="text-black font-bold text-2xl text-center">Crea una tarea ✍️</h1>
    <p class="font-sans text-black mt-4 text-center">
        Crea las tareas que necesites y ordenalas por categorias o estados de avance, 
        puedes crear hast 10 atributos por tarea.
    </p>
    <div class="mt-9">
        <label class="block text-black text-sm font-medium mb-2">
            Titulo
        </label>
        <input
            v-model="title"
            placeholder="Agregue un titulo a su tarea"
            class="w-full max-w-xl px-4 py-3 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
            :class="emptyTitle"
        />
        <p
            class="text-sm text-red-500 font-medium mt-3 ml-2"
            v-if="messageErrorTitle"
        >
            El campo titulo es obligatorio
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
            <label class="block text-black text-sm font-medium mb-2">
                Categoria
            </label>
            <select
                v-model="category"
                class="w-full px-4 py-3 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                :class="emptyCategory"
            >
                <option value="" disabled>Seleccione una categoría</option>
                <option 
                    v-for="cat in categories"
                    :key="cat.id_category"
                    :value="cat.id_category"
                >
                    {{ cat.category }}
                </option>
            </select>
            <p
            class="text-sm text-red-500 font-medium mt-3 ml-2"
            v-if="messageErrorCategory"
            >
                El campo Categoria es obligatorio
            </p>
        </div>
        <div>
            <label class="block text-black text-sm font-medium mb-2">
                Estado
            </label>
            <select
                v-model="stateTask"
                class="w-full px-4 py-3 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                :class="emptyState"
            >
                <option value="" disabled>Seleccione un estado</option>
                <option 
                    v-for="sta in states_tasks"
                    :key="sta.id_state"
                    :value="sta.id_state"
                >
                    {{ sta.state }}
                </option>
            </select>
            <p
            class="text-sm text-red-500 font-medium mt-3 ml-2"
            v-if="messageErrorState"
        >
            El campo Estado es obligatorio
        </p>
        </div>
        
        <div>
            <label class="block text-black text-sm font-medium mb-2">
                Prioridad
            </label>
            <select
                v-model="priority"
                name="country"
                class="w-full px-4 py-3 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                :class="emptyPriority"
            >
                <option value="" disabled>Seleccionar</option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
            <p
            class="text-sm text-red-500 font-medium mt-3 ml-2"
            v-if="messageErrorPriority"
        >
            El campo Prioridad es obligatorio
        </p>
        </div>
        
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Fecha de vencimiento
        </label>
        <input
            v-model="due_date"
            type="date"
            name="lastName"
            value=""

            class="w-full px-4 py-3 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
        </div>
    </div>  

    <div class="mt-6">
        <label class="block text-black text-lg font-medium mb-2">
            Atributos de tu tarea
        </label>
        <TaskMetadata v-model="metadata"/>
    </div>

    <div class="mt-6">
        <label class="block text-black text-sm font-medium mb-2">
            Descripción
        </label>
        <textarea 
            v-model="description"
            class="
            w-4xl py-7 px-7 h-39 bg-slate-300 text-black border-slate-600 
            rounded-lg placeholder-gray-600 focus:outline-none 
            focus:ring-2 focus:ring-sky-400 
            focus:border-transparent transition
            "
            placeholder="Describe tu tarea..."
        ></textarea>
    </div>

    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-sky-400">
        <!-- <button
        class="px-6 py-2.5 text-black hover:text-slate-300 transition font-medium"
        >
         Cancel
        </button> -->
        <button
        @click="saveTask"
        class="dark:bg-black px-4 py-2 rounded-3xl text-gray-50 hover:bg-gray-600 hover:text-shadow-gray-600"
        >
            Crear
        </button>
    </div>
</div>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import TaskMetadata from '@/components/task/TaskMetadata.vue';
import { useToast } from "vue-toastification";
import taskService from '@/services/taskService';
import categoryService from '@/services/categoryService';
import stateTaskService from '@/services/stateTaskService';
import { useRouter } from 'vue-router';
import { useRoute } from 'vue-router';

const toast = useToast();

const router = useRouter();

// datos d ela tarea
const route = useRoute();
const taskId = Number(route.params.id_task); // obtneer el id por la url

const title = ref("");
const category = ref("");
const stateTask = ref("");
const priority = ref("");
const due_date = ref("");
const metadata = ref<string[]>([]);
const description = ref("");

// Errores de los input
const emptyTitle = ref("");
const emptyCategory = ref("");
const emptyState = ref("");
const emptyPriority = ref("");
const messageErrorTitle = ref(false);
const messageErrorCategory = ref(false);
const messageErrorState = ref(false);
const messageErrorPriority = ref(false);

const categories = ref<{ id_category:number, category: string }[]>([]); // Array de categorias

const states_tasks = ref<{ id_state:number, state: string }[]>([]); // Array de estado de tareas

watch(
    () => route.params.id_task,
    (newValue) => {
        const id = Number(newValue);

        if (!id) {
            // Si NO hay id_task estamos en modo CREAR
            title.value = "";
            category.value = "";
            stateTask.value = "";
            priority.value = "";
            due_date.value = "";
            metadata.value = [];
            description.value = "";
        }
    },
    { immediate: true }
);

onMounted( async () => {
    // si existe un id_task editamos
    if (taskId) {
        try {
            const res = await taskService.show(taskId);
            const t = res.data;
            // llenamos los campos del form
            title.value = t.title ?? "";
            category.value = t.category_id?.toString() ?? "";
            stateTask.value = t.state_id?.toString() ?? "";
            priority.value = t.priority ?? "";
            if (t.due_date) {
                due_date.value = t.due_date.split("T")[0];
            } else {
                due_date.value = "";
            }
            metadata.value = [...(t.metadata ?? [])];
            description.value = t.description ?? "";
        } catch (error) {
            console.error("❌ Error cargando la tarea a editar:", error);
        }
    }
    try {
        categories.value = await categoryService.getAll();
    } catch (err) {
        console.error("Error cargando categorías:", err);
    }

    try {
        states_tasks.value = await stateTaskService.getAll();
    } catch (err) {
        console.error("Error cargando estados:", err);
    }
});

// quitar las alertas de validacion cuando escriban en los input
watch([title, category, stateTask, priority], () => {
    if (title.value.trim()) {
        emptyTitle.value = "";
        messageErrorTitle.value = false;
    }
    
    if (category.value) {
        emptyCategory.value = "";
        messageErrorCategory.value = false;
    }
    
    if (stateTask.value) {
        emptyState.value = "";
        messageErrorState.value = false;
    }
    
    if (priority.value) {
        emptyPriority.value = "";
        messageErrorPriority.value = false;
    }
});

const saveTask = async () => {
    if (!title.value) {
        emptyTitle.value = "border-2 border-red-600";
        messageErrorTitle.value = true;
        return;
    }
    
    if (!category.value) {
        emptyCategory.value = "border-2 border-red-600";
        messageErrorCategory.value = true;
        return;
    }
    
    if (!stateTask.value) {
        emptyState.value = "border-2 border-red-600";
        messageErrorState.value = true;
        return;
    }
    
    if (!priority.value) {
        emptyPriority.value = "border-2 border-red-600";
        messageErrorPriority.value = true;
        return;
    }

    const payload = {
        title: title.value,
        category_id: category.value,
        state_id: stateTask.value,
        priority: priority.value,
        due_date: due_date.value,
        metadata: metadata.value,
        description: description.value, 
    };

    // si la props task no esta vacia entonces se actauliza de lo contario se crea
    if (taskId) {
        // actualizamos
        try {         

            await taskService.update(taskId, payload);

            toast.success("Tarea actualizada correctamente");
            router.push({ name: 'task.show', params: { id_task: taskId} });

        } catch (error) {
            console.error("❌ Error al actualizar la tarea:", error);
        }
    } else {
        // creamos
        try {
            await taskService.create(payload);
            // console.log(payload);
            toast.success("Tarea creada correctamente");
            router.push({ name: 'task' });
        } catch (error) {
            console.error("❌ Error creando tarea:", error);
        }
    }
    
}

</script>
