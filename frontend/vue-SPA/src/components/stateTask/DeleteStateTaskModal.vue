<template>
    <div>        
        <dialog :id="modalId" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-mono text-gray-200">¿Quieres eliminar la categoria: <b class="text-red-300">{{ state }}</b>?</h3>
            <div class="modal-action">
            <form class="flex justify-between w-full">
                <button 
                    type="button"
                    class="btn bg-gray-300 text-gray-700 hover:bg-gray-400"
                    @click.prevent="closeModal"
                >
                    Cancelar
                </button>
                <button 
                    class="btn bg-red-400 hover:bg-red-700"
                    @click.prevent="deleteStateTask"
                >
                    Eliminar
                </button>
            </form>
            </div>
        </div>
        </dialog>
    </div>
</template>

<script setup lang="ts">

const props = defineProps<{
  modalId: string;
  state: string;
}>();

const emit = defineEmits<{
    (e: 'stateDelete', value: string): void
}>();

const closeModal = () => {
    const modal = document.getElementById(props.modalId) as HTMLDialogElement;
    modal?.close();
}

const deleteStateTask = () => {
    emit('stateDelete', props.modalId);
    closeModal();
};

</script>