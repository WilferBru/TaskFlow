<template>
  <div>   

    <!-- Modal -->
    <dialog id="createCategory" class="modal">
      <div class="modal-box">
        <h3 class="text-lg font-bold">
          {{ props.id_category ? 'Editar Categoria' : 'Crear Categoria' }}
        </h3>
        <fieldset class="fieldset mt-4">
            <input
                v-model="categoryName"
                type="text" 
                class="input bg-gray-300 
                text-gray-800" 
                :class="borderInput"
                placeholder="Nombre de la categoria" 
            />
        </fieldset>
        <div class="modal-action">
          <form>
            <!-- si hay un botón dentro del form, cerrará el modal -->
            <button 
                type="button"
                @click.prevent="closeModal"
                class="btn bg-red-400 hover:bg-red-600"
            >
                Cancelar
            </button>
            <button
                type="button"
                class="btn bg-blue-400 hover:bg-blue-500 hover:text-gray-50"
                @click.prevent="emitCategory"
            >
                {{ props.id_category ? 'Actualizar' : 'Guardar' }}
            </button>
          </form>
        </div>
      </div>
    </dialog>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

const categoryName = ref("");
const borderInput = ref("");

const props = defineProps<{
  id_category?: number;
  category?: string;
}>();

// cada vez que cambian las props (al abrir el modal para editar)
watch(
  () => props.category,
  (newValue) => {
    categoryName.value = newValue || '';
  },
  { immediate:true }
);

// definimos el evento
const emit = defineEmits<{
    (e: 'inputCategory', value: { id_category?: number; category: string }): void
}>();

// funcion que emite el valor al al padre para crear o actualizar una categoria
const emitCategory = () => {
    if (!categoryName.value.trim()) {
      borderInput.value = "border-3 border-red-500 p-2 rounded-md";
      return
    };

    if (props.id_category) {
      // si existe id_category -> actualizar
      emit('inputCategory', { id_category: props.id_category, category: categoryName.value });
      borderInput.value = "";
    } else {
      // si no existe -> crear
      emit('inputCategory', { category: categoryName.value });
      borderInput.value = "";
    }    
    closeModal();
}

const closeModal = () => {
  const modal = document.getElementById('createCategory') as HTMLDialogElement;
  modal?.close();
  // Si no etsamois editando borrarl el contendio del input
  if (!props.id_category) {
    categoryName.value = '';
  }
  borderInput.value = "";
}
</script>
