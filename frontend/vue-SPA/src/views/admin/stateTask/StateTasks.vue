<template>
    <!-- component -->
<section class="container px-4 mx-auto bg-gray-200 rounded-2xl p-8 shadow-2xl">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-gray-800">Estado de Tareas</h2>

            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-800">En esta seccion puede visualizar los estados de las tareas que pueden usar los usarios</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            <!-- Botón para abrir el modal -->
            <button 
                class="btn bg-violet-700 hover:bg-violet-800" 
                @click="openCreateStateModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Agregar Estado</span>
            </button>            

        </div>
    </div>


    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th scope="col" class="px-12 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-200">
                                    ID
                                </th>
                                
                                <th scope="col" class="px-12 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-200">
                                    Estado
                                </th>

                                <th scope="col" class="px-4 py-3.5 text-sm font-bold text-left rtl:text-right text-gray-200">
                                    Creado
                                </th>

                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-600 divide-y  dark:divide-gray-700">
                            <tr
                                v-for="sta in stateTasks"
                                :key="sta.id_state"                                
                            >
                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h2 class="font-normal text-gray-800 dark:text-white ">{{ sta.id_state }}</h2>
                                        <!-- <p class="text-sm font-normal text-gray-600 dark:text-gray-400">catalogapp.io</p> -->
                                    </div>
                                </td>
                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h2 class="font-normal text-gray-800 dark:text-white ">{{ sta.state }}</h2>
                                        <!-- <p class="text-sm font-normal text-gray-600 dark:text-gray-400">catalogapp.io</p> -->
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        {{ new Date(sta.created_at).toLocaleDateString() }}
                                    </div>
                                </td>

                                <td class="text-sm whitespace-nowrap">
                                    <button 
                                        class="btn bg-gray-200 text-black" 
                                        :popovertarget="`popover-${sta.id_state}`" 
                                        :style="`anchor-name:--anchor-${sta.id_state}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                        </svg>
                                    </button>
                                    <ul 
                                        class="dropdown menu w-15 rounded-box bg-gray-200 text-black shadow-sm"
                                        popover 
                                        :id="`popover-${sta.id_state}`" 
                                        :style="`position-anchor:--anchor-${sta.id_state}`">
                                        <li>
                                            <button
                                                @click="openEditStateModal(sta)"
                                                class="flex items-center text-blue-500 justify-center w-10 h-10 rounded-full hover:bg-blue-700 hover:text-gray-100 transition"
                                            >
                                                <EditIcon />
                                            </button>
                                        </li>
                                        <li>
                                            <button 
                                                class="flex items-center text-red-500 justify-center w-10 h-10 rounded-full hover:bg-red-500 hover:text-gray-100 transition" 
                                                @click="ModalDeleteStateTask(`${sta.id_state}`)"
                                            >
                                                <DeleteIcon />
                                            </button>
                                        </li>
                                        <DeleteStateTaskModal 
                                            :modal-id="`${sta.id_state}`"
                                            :state="`${sta.state}`"
                                            @state-delete="deleteStateTask"
                                        />
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para crear y actualizar los estados -->
     <CreateStateTaskModal 
        @input-state="saveStateTask"
        :id_state="selectedState?.id_state"
        :state="selectedState?.state"
     />
</section>
</template>

<script setup lang="ts">
import stateTaskService from '@/services/stateTaskService';
import { onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";
import CreateStateTaskModal from '@/components/stateTask/CreateStateTaskModal.vue';
import EditIcon from '@/components/common/icons/EditIcon.vue';
import DeleteIcon from '@/components/common/icons/DeleteIcon.vue';
import DeleteStateTaskModal from '@/components/stateTask/DeleteStateTaskModal.vue';


const toast = useToast();

const stateTasks = ref<{
    id_state: number;
    state: string;
    created_at: Date;
}[]>([]);

onMounted(async () => {
    try {
       stateTasks.value = await stateTaskService.getAll(); 
    } catch (error) {
       console.error("Error cargando estados:", error);  
    }
});

// variable reactiva para guardar lso estados seleccionados
const selectedState = ref<{
    id_state?: number;
    state?: string;
}>({});

const openCreateStateModal = () => {
    selectedState.value = {}; // sin datos modo crear
    const modal = document.getElementById('createStateTask') as HTMLDialogElement;
    modal.showModal();
};

const openEditStateModal = (sta: any) => {
    selectedState.value = {...sta};
    const modal = document.getElementById('createStateTask') as HTMLDialogElement;
    modal.showModal();
};

const saveStateTask = async (data: { id_state?: number, state: string }) => {
    try {
        if (data.id_state) {
            const response = await stateTaskService.update(data);
            toast.success("Estado actualizado correctamente");
            const index = stateTasks.value.findIndex(
                (s) => s.id_state === data.id_state
            );
            if (index !== -1) stateTasks.value[index] = response.data;
            return response;
        } else {
           const response = await stateTaskService.create(data);
           toast.success("Estado creado correctamente"); 
           // acutalizar lista de estados
           stateTasks.value.push(response.data);
           return response;
        }
    } catch (error) {
        console.error("❌ Error creando el estado:", error);
    }
};

const ModalDeleteStateTask = (id_state: string) => {
    const modal = document.getElementById(id_state) as HTMLDialogElement | null;
    if (modal) {
        modal.showModal();
    } else {
        console.warn(`⚠️ No se encontró el modal con id ${id_state}`);
    }
};

const deleteStateTask = async (id_state: string) => {
    try {
        const response = await stateTaskService.delete(Number(id_state));
        toast.success("Esatdo eliminada correctamente");
        // Eliminar de la lista local
        stateTasks.value = stateTasks.value.filter(
            (s) => Number(s.id_state) !== Number(id_state)
        );
        return response.data;
    } catch (error: any) {
        console.error("❌ Error eliminando el estado:", error);
    }
}

</script>