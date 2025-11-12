<template>
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="t in tasks"
          :key="t.id_task"
          class="flex flex-col group bg-info-content rounded-2xl p-4 transition-all duration-300 lg:p-8"
        >
          <div class="mb-3 text-right">
            <button 
                class="text-gray-50 px-3 rounded-2xl transition-all duration-300"
                :class="
                  t.state_level === 1 ? 'bg-amber-800 hover:scale-110 hover:bg-amber-600 hover:text-gray-200' :
                  t.state_level === 2 ? 'bg-blue-800 hover:scale-110 hover:bg-blue-500 hover:text-gray-200' :
                  t.state_level === 3 ? 'bg-emerald-700 hover:scale-110 hover:bg-emerald-500 hover:text-gray-200' :
                  'bg-gray-900'
                "
            >               
               {{ t.state }}
            </button>
          </div>
          <div class="flex items-center gap-x-2">
            <div>
              <h3 class="text-2xl font-bold text-gray-50">{{ t.title }}</h3>
              <span class="text-xs text-gray-300" v-if="t.due_date"><b>Fecha limite:</b> {{ new Date(t.due_date).toLocaleDateString('es-ES', { day: 'numeric', month: 'long' }) }}</span>
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
import { onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";

const toast = useToast();

const tasks = ref<{
  id_task: number,
  title: string,
  due_date: Date,
  priority: string,
  category: string,
  state: string,
  state_level: number,
  description: Text,
  metadata: string
}[]>([]);

onMounted(async () => {
    try {
      const response = await taskService.getAll();
      tasks.value = response.data;
    } catch (error) {
      console.error("Error cargando tareas:", error); 
    }
});

</script>

