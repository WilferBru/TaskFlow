<template>
    <dialog v-if="open" class="modal modal-open">
        <div class="bg-gray-300 modal-box">

            <!-- Título -->
            <h3 class="text-lg font-bold text-gray-800 mb-4">
            Filtrar tareas
            </h3>

            <!-- Contenido -->
            <div class="space-y-4">

            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Estado
                </label>
                <select
                    v-model="localFilters.state"
                    class="select select-bordered w-full"
                >
                <option :value="null">Todos</option>
                <option
                    v-for="sta in states"
                    :key="sta.id_state"
                    :value="sta.id_state"
                >
                    {{ sta.state }}
                </option>
                </select>
            </div>

            <!-- Prioridad -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Prioridad
                </label>
                <select
                    v-model="localFilters.priority"
                    class="select select-bordered w-full"
                >
                <option :value="null">Todas</option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
                </select>
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Categoría
                </label>
                <select
                    v-model="localFilters.category"
                    class="select select-bordered w-full"
                >
                <option :value="null">Todas</option>
                <option
                    v-for="cat in categories"
                    :key="cat.id_category"
                    :value="cat.id_category"
                >
                    {{ cat.category }}
                </option>
                </select>
            </div>

            </div>

            <!-- Acciones -->
            <div class="modal-action">
            <button
                class="btn bg-red-500 border-0"
                @click="emit('close')"
            >
                Cancelar
            </button>

            <button
                class="btn btn-primary"
                @click="emit('apply', localFilters)"
            >
                Aplicar filtros
            </button>
            </div>

        </div>
        </dialog>

</template>

<script setup lang="ts">
import { ref } from 'vue'


const localFilters = ref({
    state: null as number | null,
    priority: null as string | null,
    category: null as number | null,
});

interface Category {
  id_category: number
  category: string
}

interface StateTask {
  id_state: number
  state: string
  level: number
}

const { open, categories, states } = defineProps<{
    open: boolean;
    categories: Category[];
    states: StateTask[];
}>();

const emit = defineEmits<{
    (e: 'close'): void
    (e: 'apply', filters: {
        state: number | null
        priority: string | null
        category: number | null
    }): void
}>();

</script>