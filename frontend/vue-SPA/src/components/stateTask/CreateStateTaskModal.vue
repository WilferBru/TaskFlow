<template>
  <div>   

    <!-- Modal -->
    <dialog id="createStateTask" class="modal">
      <div class="modal-box">
        <h3 class="text-lg font-bold">
          {{ props.id_state ? 'Editar Estado' : 'Crear Estado' }}
        </h3>
        <fieldset class="fieldset mt-4">
            <input
                v-model="stateName"
                type="text" 
                class="input bg-gray-300 
                text-gray-800"
                :class="borderInput"
                placeholder="Nombre del estado" 
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
                @click.prevent="emitState"
            >
                {{ props.id_state ? 'Actualizar' : 'Guardar' }}
            </button>
          </form>
        </div>
      </div>
    </dialog>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

const stateName = ref("");
const borderInput = ref(); // sombrear input

const props = defineProps<{
  id_state?: number;
  state?: string;
}>();

// cada vez que cambian las props (al abrir el modal para editar)
watch(
  () => props.state,
  (newValue) => {
    stateName.value = newValue || '';
  },
  { immediate:true }
);

// definimos el evento
const emit = defineEmits<{
    (e: 'inputState', value: { id_state?: number; state: string }): void
}>();

// funcion que emite el valor al padre para crear o actualizar un estado de tarea
const emitState = () => {
    if (!stateName.value.trim()) {
      borderInput.value = "border-3 border-red-500 p-2 rounded-md";
      return;
    }

    if (props.id_state) {
      // si existe id_category -> actualizar
      emit('inputState', { id_state: props.id_state, state: stateName.value });
      borderInput.value = ''
    } else {
      // si no existe -> crear
      emit('inputState', { state: stateName.value });
      borderInput.value = ''
    }    
    closeModal();
}

const closeModal = () => {
  const modal = document.getElementById('createStateTask') as HTMLDialogElement;
  modal?.close();
  // Si estamos creando entonces eliminamos el contenido del input
  if (!props.id_state) {
    stateName.value = '';
  }
  borderInput.value = '';
}
</script>
