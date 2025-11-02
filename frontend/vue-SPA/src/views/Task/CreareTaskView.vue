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
            type="email"
            name="email"
            value=""
            class="w-full max-w-xl px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Categoria
        </label>
        <select
            v-model="category"
            name="country"
            value=""
            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
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
        </div>
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Estado
        </label>
        <select
            v-model="stateTask"
            value=""
            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
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
        </div>
        
        <div>
        <label class="block text-black text-sm font-medium mb-2">
            Prioridad
        </label>
        <select
            v-model="priority"
            name="country"
            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        >
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>
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

            class="w-full px-4 py-3 bg-slate-300 border border-slate-600 rounded-lg text-black placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
        />
        </div>
    </div>  

    <div class="mt-6">
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
import { onMounted, ref } from 'vue';
import TaskMetadata from '@/components/task/TaskMetadata.vue';
import { useToast } from "vue-toastification";
import taskService from '@/services/taskService';
import categoryService from '@/services/categoryService';
import stateTaskService from '@/services/stateTaskService';

const toast = useToast();

const title = ref("");
const category = ref("");
const stateTask = ref("");
const priority = ref("");
const due_date = ref("");
const metadata = ref<string[]>([]);
const description = ref("");

const categories = ref<{ id_category:number, category: string }[]>([]); // Array de categorias

const states_tasks = ref<{ id_state:number, state: string }[]>([]); // Array de estado de tareas

onMounted( async () => {
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
const saveTask = async () => {
    if (!title.value || !category.value || !stateTask.value || !priority.value) {
        toast.error("Faltan campso por llenar");
        return;
    }

    try {
        const payload = {
        title: title.value,
        category: category.value,
        state: stateTask.value,
        priority: priority.value,
        due_date: due_date.value,
        metadata: metadata.value,
        description: description.value, 
        };

        const response = await taskService.createTask(payload);
        toast.success("Tarea creada correctamente");
        return response;
    } catch (error) {
        console.error("❌ Error creando tarea:", error);
    }
}

</script>
