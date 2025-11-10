<template>
    <div>        
        <dialog :id="modalId" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-mono text-gray-200">¿Quieres eliminar el usuario con id: <b class="text-red-300">{{ modalId }}</b>?</h3>
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
                    @click.prevent="deleteUser"
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
}>();

const emit = defineEmits<{
    (e: 'userDelete', value: string): void
}>();

const closeModal = () => {
    const modal = document.getElementById(props.modalId) as HTMLDialogElement;
    modal?.close();
}

const deleteUser = () => {
    emit('userDelete', props.modalId);
    closeModal();
};

</script>