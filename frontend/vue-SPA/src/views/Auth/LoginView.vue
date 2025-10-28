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
                <form  class="mt-10">
                                    
                    <div>
                        <input
                            
                            type="email" 
                            placeholder="Correo electronico" 
                            class="mt-1 pl-6 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                        >
                    </div>
        
                    <div class="mt-7">                
                        <input
                            
                            type="password" 
                            placeholder="Contraseña" 
                            class="mt-1 pl-5 block w-full border-none bg-gray-300 placeholder-gray-700 text-gray-800 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0"
                        >                           
                    </div>
        
                    <div class="mt-7">
                        <button class="bg-cyan-600 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Acceder
                        </button>
                    </div>
        
                    <div class="flex mt-7 items-center text-center">
                        <hr class="border-gray-300 border-1 w-60 rounded-md">
                        <label class="block font-medium text-sm text-gray-600 w-full">
                            ¿Eres nuevo?
                        </label>
                        <hr class="border-gray-300 border-1 w-60 rounded-md">
                    </div>
        
                        <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <router-link 
                                :to="{name: 'register'}"
                                class=" text-blue-500 transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105"
                            >
                                Crea una cuenta
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
//

</script>
