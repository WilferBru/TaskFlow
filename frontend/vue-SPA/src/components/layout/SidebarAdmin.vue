<template>        
     <aside class="w-20 dark:bg-black shadow-md p-3">
      <nav class="space-y-2 flex flex-col h-full">
        <RouterLink
          :to="{ name: 'home' }"
          class="flex flex-col items-center px-3 py-3 rounded text-gray-300 hover:bg-gray-600"
          :class="{ 'text-sky-500 font-semibold bg-gray-700': $route.name === 'home' }"
        >
            <HomeIcon />
            <p class="text-xs mt-2">Home</p>
        </RouterLink>
       
        <RouterLink
          :to="{ name: 'task' }"
          class="flex flex-col items-center px-3 py-3 rounded text-gray-300 hover:bg-gray-600"
          :class="{ 'text-sky-500 font-semibold bg-gray-700': $route.name === 'task' }"
        >
            <TaskIcon />
            <p class="text-xs mt-2">Tareas</p>
        </RouterLink>
        
        <RouterLink
          :to="{ name: '' }"
          class="flex flex-col items-center px-3 py-3 rounded text-gray-300 hover:bg-gray-600"
          :class="{ 'text-sky-500 font-semibold bg-gray-700': $route.name === '' }"
        >
            <UsersIcon />
            <p class="text-xs mt-2">Usuarios</p>
        </RouterLink>
        
        <RouterLink
          :to="{ name: 'profile' }"
          class="mt-auto flex flex-col items-center rounded text-gray-300 hover:bg-gray-600"
          :class="{ 'text-sky-500 font-semibold bg-gray-700': $route.name === 'profile' }"
        >
            <UserIcon class="w-10 h-10"/>
            <p class="text-xs mt-1">Mi cuenta</p>
        </RouterLink>

      </nav>
    </aside>
</template>

<script setup lang="ts">
import HomeIcon from '../icons/HomeIcon.vue';
import TaskIcon from '../icons/TaskIcon.vue';
import UsersIcon from '../icons/UsersIcon.vue';
import UserIcon from '../icons/UserIcon.vue';

</script>