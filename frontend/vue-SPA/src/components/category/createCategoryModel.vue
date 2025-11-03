<template>
  <div>
    <!-- Botón para abrir el modal -->
    <button class="btn" onclick="my_modal_1.showModal()">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span>Agregar Tarea</span>
    </button>

    <!-- Modal -->
    <dialog id="my_modal_1" class="modal">
      <div class="modal-box">
        <h3 class="text-lg font-bold">Crear Categoria</h3>
        <fieldset class="fieldset mt-4">
            <input
                v-model="categoryName"
                type="text" 
                class="input bg-gray-300 
                text-gray-800" 
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
                Guardar
            </button>
          </form>
        </div>
      </div>
    </dialog>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const categoryName = ref("");

// definimos el evento
const emit = defineEmits<{
    (e: 'inputCategory', value: string): void
}>();

const closeModal = () => {
    const modal = document.getElementById('my_modal_1') as HTMLDialogElement;
    modal?.close();
    categoryName.value = ''; // limpiar campo
  }

// funcion que emite el valor al poadre
const emitCategory = () => {
    if (!categoryName.value.trim()) return;
    emit('inputCategory', categoryName.value);
    categoryName.value = ''; // limpiar campo
    closeModal();
}

</script>
