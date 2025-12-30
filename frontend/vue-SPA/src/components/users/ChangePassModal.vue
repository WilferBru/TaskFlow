<template>
    <dialog ref="modalRef" class="modal">
        <div class="bg-gray-200 modal-box">
            <h3 class="text-gray-700 text-lg font-bold">Cambair contraseña</h3>
             <input v-model="currentPassword" type="password" placeholder="Contraseña antigua" class="bg-gray-200 text-gray-800 input input-neutral mt-5" />
            <input v-model="passwordInput" type="password" placeholder="Nueva contraseña" class="bg-gray-200 text-gray-800 input input-neutral mt-5" />
            <input v-model="passwordConfirmation" type="password" placeholder="Confirmar contraseña" class="bg-gray-200 text-gray-800 input input-neutral mt-5" />
            <div class="modal-action">
            <div class="flex justify-between w-full">
                <button class="btn" @click.prevent="emit('close')">Close</button>
                <button 
                    @click.prevent="submit"
                    class="bg-gray-200 hover:text-blue-400 border-2 border-blue-400 btn btn-soft btn-primary"
                >
                    Cambiar
                </button>
            </div>
            </div>
        </div>
    </dialog>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue';


const modalRef = ref<HTMLDialogElement | null>(null);

const currentPassword = ref<string>("");

const passwordInput = ref<string>("");

const passwordConfirmation = ref<string>("");

const props = defineProps<{
    open: boolean
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'pass', passwords: {
        current_password: string,
        password: string,
        password_confirmation: string,
    }): void;
}>();

// emitir password al padre
const submit = () => {
    if(!currentPassword.value || !passwordInput.value || !passwordConfirmation.value) return;

    emit('pass', {
        current_password: currentPassword.value,
        password: passwordInput.value,
        password_confirmation: passwordConfirmation.value,
    });
}

// abirir y cerrar
watch(
    () => props.open,
    (value) => {
        if (value) {
            modalRef.value?.showModal();
        } else {
            modalRef.value?.close();
        }
    }
);

</script>