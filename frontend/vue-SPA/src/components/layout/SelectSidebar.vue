<template>
    <div class="relative w-full max-w-xs mx-auto" ref="dropdownRef">
    
    <button
      @click="toggleDropdown"
      class="flex items-center justify-between w-full p-3 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
      :aria-expanded="isOpen"
      aria-haspopup="listbox"
    >
      <div class="flex items-center">
        <img v-if="selectedUser.avatar" :src="selectedUser.avatar" :alt="selectedUser.name" class="w-6 h-6 rounded-full mr-3">
        <span>{{ selectedUser.name }}</span>
      </div>
      
      <svg class="w-4 h-4 ml-2 text-gray-400 transform transition-transform duration-200"
           :class="{ 'rotate-180': isOpen }"
           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div v-show="isOpen" 
           class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 overflow-auto"
           role="listbox">
           
        <ul class="py-1">
          <li v-for="user in users" :key="user.id"
              @click="selectUser(user)"
              class="flex items-center justify-between px-4 py-2 cursor-pointer hover:bg-indigo-50 transition duration-150 ease-in-out"
              :class="{ 'bg-indigo-50 text-indigo-600 font-medium': user.id === selectedUser.id }"
              role="option"
              :aria-selected="user.id === selectedUser.id"
          >
            <div class="flex items-center">
              <img :src="user.avatar" :alt="user.name" class="w-8 h-8 rounded-full mr-3 object-cover">
              <span>{{ user.name }}</span>
            </div>

            <svg v-if="user.id === selectedUser.id" class="w-5 h-5 text-indigo-600"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </li>
        </ul>
      </div>
    </transition>
</div>
</template>


<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

// --- Estado Reactivo ---
// El estado del dropdown (abierto/cerrado)
const isOpen = ref(false);

// Datos de ejemplo para el menú (Puedes mover esto a un prop si quieres reutilizarlo)
const users = ref([
  { id: 1, name: 'James Collins', avatar: 'https://i.pravatar.cc/150?img=60' },
  { id: 2, name: 'Amanda Harvey', avatar: 'https://i.pravatar.cc/150?img=49' },
  { id: 3, name: 'Costa Quinn', avatar: 'https://i.pravatar.cc/150?img=52' },
  { id: 4, name: 'Sophia Loren', avatar: 'https://i.pravatar.cc/150?img=45' },
]);

// Inicialmente seleccionado el primer usuario
const selectedUser = ref(users.value[0]);

// Opcional: para emitir eventos al componente padre
const emit = defineEmits(['user-selected']);

// --- Funciones del Dropdown ---
function toggleDropdown() {
  isOpen.value = !isOpen.value;
}

function closeDropdown() {
  isOpen.value = false;
}

function selectUser(user: typeof users.value[0]) {
  selectedUser.value = user;
  closeDropdown();
  emit('user-selected', user);
}

// --- Lógica de la Directiva v-click-outside (Implementada manualmente) ---
// La directiva 'v-click-outside' no está disponible por defecto en Vue.
// Aquí te muestro cómo implementar la funcionalidad de forma manual y limpia en Composition API.

const dropdownRef = ref<HTMLElement | null>(null);

function handleClickOutside(event: MouseEvent) {
  // Verificamos si se hizo clic fuera del contenedor del dropdown
  if (dropdownRef.value && !dropdownRef.value.contains(event.target as Node)) {
    closeDropdown();
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>