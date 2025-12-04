<template>
 <div class="font-sans">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-white ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card dark:bg-black shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-sky-500 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-200 shadow-md">
                <h3 class="block mt-4 text-2xl text-gray-900 text-center font-bold">
                    TaskFlow
                </h3>
                <label for="register" class="block mt-3 text-sm text-gray-900 text-center font-semibold">
                    Registrate
                </label>
                <form @submit.prevent="handleRegister" class="mt-10">
                                    
                    <div>
                        <input
                            v-model="name"
                            type="text" 
                            id="register"
                            placeholder="Nombre y Apellido" 
                            class="mt-1 pl-6 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                        >
                    </div>
                    
                    <div class="mt-7">
                        <input
                            v-model="email"
                            type="email" 
                            placeholder="Correo Electronico" 
                            class="mt-1 pl-6 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                        >
                    </div>
        
                    <div class="mt-7">                
                        <input
                            v-model="password"
                            type="password" 
                            placeholder="Contraseña" 
                            class="mt-1 pl-5 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                        >                           
                    </div>
                    
                    <div class="mt-7">                
                        <input
                            v-model="password_confirmation"
                            type="password" 
                            placeholder="Confirma Tu Contraseña" 
                            class="mt-1 pl-5 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
                        >                           
                    </div>
        
                    <div class="mt-7">
                        <button
                            type="submit" 
                            class="bg-cyan-600 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Acceder
                        </button>
                    </div>
        
                    <div class="flex mt-7 items-center text-center">
                        <hr class="border-gray-300 w-40 rounded-md">
                        <label class="block font-medium text-sm text-gray-600 w-full">
                            ¿Ya tienes una cuenta?
                        </label>
                        <hr class="border-gray-300 w-40 rounded-md">
                    </div>
        
                        <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <router-link 
                                :to="{name: 'login'}"
                                class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105"
                            >
                                Inicia Sesion
                            </router-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/authStore';
import { useToast } from "vue-toastification";

const router = useRouter();
const authStore = useAuthStore();
const toast = useToast();

// var reactivas
const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");

const handleRegister = async () => {
    if (!name.value || !email.value || !password.value || !password_confirmation.value) {
        toast.error("Por favor completa todos los campos");
        return;
    }
    try {
        await authStore.register(name.value, email.value, password.value, password_confirmation.value);

        if (authStore.token) {
            toast.success("Bienvenido");
            router.push({ name: "home" });
        }
    } catch (error) {
        toast.error(`Error al iniciar sesión: ${authStore.error}`);
    }
};

</script>
