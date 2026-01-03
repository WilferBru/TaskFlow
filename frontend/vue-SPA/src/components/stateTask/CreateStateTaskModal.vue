<template>
  <div>   
    <dialog id="createStateTask" class="modal">
      <div class="modal-box">
        <h3 class="text-lg font-bold">
          {{ props.id_state ? 'Editar Estado' : 'Crear Estado' }}
        </h3>

        <fieldset class="fieldset mt-4">
          <input
            v-model="stateName"
            type="text"
            class="input bg-gray-300 text-gray-800"
            placeholder="Nombre del estado"
          />
        </fieldset>

        <fieldset class="fieldset mt-4">
          <label class="block text-sm font-medium text-gray-200 mb-1">Nivel</label>
          <select
            v-model.number="selectedLevel"
            class="select bg-gray-300 text-gray-800 w-full"
          >
            <option value="" disabled>Seleccione un nivel</option>
            <option :value="1">1 - Bajo</option>
            <option :value="2">2 - Medio</option>
            <option :value="3">3 - Alto</option>
          </select>
        </fieldset>

        <p 
          v-if="borderInput"
          class="text-red-500 mt-4"
        >
          Hay campos sin llenar por favor valida...
        </p>

        <div class="modal-action">
          <form>
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
const selectedLevel = ref<number | null>(null);
const borderInput = ref(false);

const props = defineProps<{
  id_state?: number;
  state?: string;
  level?: number;
}>();

// 🔹 Watch independiente para el nombre
watch(
  () => props.state,
  (newValue) => {
    stateName.value = newValue || '';
  },
  { immediate: true }
);

// 🔹 Watch independiente para el nivel
watch(
  () => props.level,
  (newValue) => {
    selectedLevel.value = newValue || null;
  },
  { immediate: true }
);

// emitir al padre
const emit = defineEmits<{
  (e: 'inputState', value: { id_state?: number; state: string; level: number }): void;
}>();

const emitState = () => {
  if (!stateName.value.trim() || !selectedLevel.value) {
    borderInput.value = true;
    return;
  }

  emit('inputState', {
    id_state: props.id_state,
    state: stateName.value,
    level: selectedLevel.value
  });

  closeModal();
};

const closeModal = () => {
  const modal = document.getElementById('createStateTask') as HTMLDialogElement;
  modal?.close();
  if (!props.id_state) {
    stateName.value = '';
    selectedLevel.value = null;
  }
  borderInput.value = false;
};
</script>
