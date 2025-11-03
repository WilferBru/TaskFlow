<template>
    <div>        
        <dialog :id="modalId" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-mono text-gray-200">¿Quieres eliminar la categoria: <b class="text-red-300">{{ category }}</b>?</h3>
            <div class="modal-action">
            <form>
                <button 
                    type="button"
                    class="btn bg-gray-300 text-gray-700 hover:bg-gray-400"
                    @click.prevent="closeModal"
                >
                    Cancelar
                </button>
                <button 
                    class="btn bg-red-400 hover:bg-red-700"
                    @click.prevent="deleteCategory"
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
  category: string;
}>();

const emit = defineEmits<{
    (e: 'categoryDelete', value: string): void
}>();

const closeModal = () => {
    const modal = document.getElementById(props.modalId) as HTMLDialogElement;
    modal?.close();
}

const deleteCategory = () => {
    emit('categoryDelete', props.modalId);
    closeModal();
};

</script>