<template>
    <dialog id="deleteTaskModal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box bg-gray-300 text-gray-800">
          <h3 class="text-lg font-bold">Borrar tarea {{ props.title }}</h3>
          <p class="py-4">¿Estas seguro de borrar la tarea <b>{{ props.title }}</b>?</p>
          <div class="modal-action">
            <form class="flex justify-between w-full">
                <button 
                    @click.prevent="closeModal"
                    class="btn bg-gray-700 border-0 hover:bg-gray-700 left-3"
                >
                    Cancelar
                </button>
                <button 
                    @click.prevent="deleteTask"
                    class="btn bg-red-500 border-0 hover:bg-red-700"
                >
                    Borrar
                </button>
            </form>
          </div>
        </div>
      </dialog>
</template>

<script setup lang="ts">
import taskService from '@/services/taskService';
import { useRouter } from 'vue-router';
import { useToast } from "vue-toastification";
import { useTaskSummaryStore } from '@/stores/taskSummaryStore';

const toast = useToast();
const router = useRouter();
const taskSummaryStore = useTaskSummaryStore();


const props = defineProps<{
    id_task: number;
    title: string;
}>();

const closeModal = () => {
  const modal = document.getElementById("deleteTaskModal") as HTMLDialogElement;
  modal?.close();
}

// borar tarea
const deleteTask = async () => {
    try {
        await taskService.delete(props.id_task);
        closeModal();
        toast.success("Tarea eliminada correctamente");
        router.push({ name: 'task' });
        taskSummaryStore.loadSummary()
    } catch (error) {
        console.error("Error al eliminar la tarea: ", error);
    }    
}

</script>