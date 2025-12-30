<template>
    <dialog ref="modalRef" class="modal">
        <div class="bg-gray-100 modal-box">
            <h3 class="text-gray-700 text-lg font-bold">Actualizar nombre</h3>
            <input type="text" class="bg-gray-50 text-gray-700 input mt-5 input-info " v-model="nameInput" placeholder="Type here" />
            <div class="modal-action">
            <div class="flex justify-between w-full">
                <button class="btn" @click.prevent="emit('close')">Close</button>
                <button 
                    class="bg-blue-500 border-0 hover:bg-blue-600 btn" 
                    @click.prevent="submit"
                >
                    Actualizar
                </button>
            </div>
            </div>
        </div>
    </dialog>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';

const modalRef = ref<HTMLDialogElement | null>(null);

const nameInput = ref<string>("");

const props = defineProps<{
    open: boolean;
    name: string;
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'updateData', data: { name: string; }): void;
}>();

// emitir nombre al padre
const submit = () => {
    emit('updateData', {
        name: nameInput.value
    });
};

watch(
    () => props.open,
    (value) => {
        if (value) {
            modalRef.value?.showModal();
            nameInput.value = props.name;
        } else {
            modalRef.value?.close();
        }
    }

);

</script>