<template>
    <!-- component -->
<section class="container px-4 mx-auto bg-gray-200 rounded-2xl p-8 shadow-2xl">
    <div class="sm:flex sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-gray-800">Categorias</h2>

                <!-- <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">240 vendors</span> -->
            </div>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-800">Ene sta seccion puede visualizar las ctaergorias que pueden usar los usarios</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            <!-- Botón para abrir el modal -->
            <button 
                class="btn bg-violet-700 hover:bg-violet-800" 
                @click="openCreateModal">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Agregar Tarea</span>
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
                                    Categoria
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
                                v-for="cat in categories"
                                :key="cat.id_category"                                
                            >
                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                    <div>
                                        <h2 class="font-normal text-gray-800 dark:text-white ">{{ cat.category }}</h2>
                                        <!-- <p class="text-sm font-normal text-gray-600 dark:text-gray-400">catalogapp.io</p> -->
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-emerald-500 gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                        {{ new Date(cat.created_at).toLocaleDateString() }}
                                    </div>
                                </td>

                                <td class="text-sm whitespace-nowrap">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear categoria y actualizar -->
    <CreateCategoryModel 
        @input-category="saveCategory"
        :id_category="selectedCategory?.id_category"
        :category="selectedCategory?.category"
    />
</section>
</template>

<script setup lang="ts">
import EditIcon from '@/components/common/icons/EditIcon.vue';
import DeleteIcon from '@/components/common/icons/DeleteIcon.vue';
import categoryService from '@/services/categoryService';
import { onMounted, ref } from 'vue';
import CreateCategoryModel from '@/components/category/createCategoryModel.vue';
import { useToast } from "vue-toastification";
import DeleteCategoryModal from '@/components/category/deleteCategoryModal.vue';

const toast = useToast();

const categories = ref<{ 
    id_category: number, 
    category: string,
    created_at: Date
}[]>([]);


onMounted(async () => {
    try {
        categories.value = await categoryService.getAll();
    } catch (error) {
       console.error("Error cargando categorías:", error); 
    }
});

// variable reactiva para guardar la categoría seleccionada
const selectedCategory = ref<{ id_category?: number; category?: string }>({});

// abrir modal para CREAR
const openCreateModal = () => {
  selectedCategory.value = {}; // sin datos → modo crear
  const modal = document.getElementById('createCategory') as HTMLDialogElement;
  modal.showModal();
};

// abrir modal para EDITAR
const openEditModal = (cat: any) => {
  selectedCategory.value = { ...cat }; // con datos → modo editar
  const modal = document.getElementById('createCategory') as HTMLDialogElement;
  modal.showModal();
};


const saveCategory = async (data: {id_category?: number, category: string }) => {
    try {
        if (data.id_category) {
            const response = await categoryService.update(data);
            toast.success("Categoria actualizada correctamente");
            // actualizar solo la categoria editada
            const index = categories.value.findIndex(
                (c) => c.id_category === data.id_category
            );
            if (index !== -1) categories.value[index] = response.data;
            return response;
        } else {
            const response = await categoryService.create(data);
            toast.success("Categoria creada correctamente");
            // actualizar lista
            categories.value.push(response.data);
            return response;
        }        
        
    } catch (error) {
        console.error("❌ Error creando la categoria:", error);
    }
};

const ModalDeleteCategory = (id_category: string) => {
  const modal = document.getElementById(id_category) as HTMLDialogElement | null;
  if (modal) {
    modal.showModal();
  } else {
    console.warn(`⚠️ No se encontró el modal con id ${id_category}`);
  }
};

const deleteCategory = async (id_category: string) => {
    try {
        const response = await categoryService.delete(id_category);
        toast.success("Categoria eliminada correctamente");
        // eliminar de la lista local
        categories.value = categories.value.filter(
            (c) => Number(c.id_category) !== Number(id_category)
        );
        return response;
    } catch (error) {
        console.error("❌ Error eliminando al categoria:", error);
    }
}

</script>