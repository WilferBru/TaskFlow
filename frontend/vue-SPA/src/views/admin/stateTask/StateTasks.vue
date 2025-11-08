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
                                        <h2 class="font-normal text-gray-800 dark:text-white ">{{ sta.state }}</h2>
                                        <!-- <p class="text-sm font-normal text-gray-600 dark:text-gray-400">catalogapp.io</p> -->
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        {{ new Date(sta.created_at).toLocaleDateString() }}
                                    </div>
                                </td>

                                <!-- <td class="text-sm whitespace-nowrap">
                                    <button 
                                        class="btn bg-gray-200 text-black" 
                                        :popovertarget="`popover-${cat.id_category}`" 
                                        :style="`anchor-name:--anchor-${cat.id_category}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                        </svg>
                                    </button>
                                    <ul 
                                        class="dropdown menu w-15 rounded-box bg-gray-200 text-black shadow-sm"
                                        popover 
                                        :id="`popover-${cat.id_category}`" 
                                        :style="`position-anchor:--anchor-${cat.id_category}`">
                                        <li>
                                            <button
                                                @click="openEditModal(cat)"
                                                class="flex items-center text-blue-500 justify-center w-10 h-10 rounded-full hover:bg-blue-700 hover:text-gray-100 transition"
                                            >
                                                <EditIcon />
                                            </button>
                                        </li>
                                        <li>
                                            <button 
                                                class="flex items-center text-red-500 justify-center w-10 h-10 rounded-full hover:bg-red-500 hover:text-gray-100 transition" 
                                                @click="ModalDeleteCategory(`${cat.id_category}`)"
                                            >
                                                <DeleteIcon />
                                            </button>
                                        </li>
                                        <DeleteCategoryModal 
                                            :modal-id="`${cat.id_category}`"
                                            :category="`${cat.category}`"
                                            @category-delete="deleteCategory"
                                        />
                                    </ul>
                                </td> -->
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
        :id_stateTask="selectedState?.id_state"
        :stateTask="selectedState?.state"
     />
</section>
</template>

<script setup lang="ts">
import stateTaskService from '@/services/stateTaskService';
import { onMounted, ref } from 'vue';
import { useToast } from "vue-toastification";
import CreateStateTaskModal from '@/components/stateTask/CreateStateTaskModal.vue';

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
    selectedState.value = {}; // sind atos modo crear
    const modal = document.getElementById('createStateTask') as HTMLDialogElement;
    modal.showModal();
};

const openEditStateModal = (sta: any) => {
    selectedState.value = {...sta}; // sind atos modo crear
    const modal = document.getElementById('createStateTask') as HTMLDialogElement;
    modal.showModal();
};

const saveStateTask = async (data: { id_state?: number, state: string }) => {
    try {
        if (data.id_state) {
            console.log("actualizado");
        } else {
           const response = await stateTaskService.create(data);
           toast.success("Esatdo creado correctamente"); 
           // acutalizar lista de estados
           stateTasks.value.push(response.data);
           return response;
        }
    } catch (error) {
        console.error("❌ Error creando el estado:", error);
    }
};

</script>