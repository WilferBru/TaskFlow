<template>
    <aside class="w-70 bg-white  shadow-md p-2">
      <div class="flex flex-col h-full bg-gray-200 rounded-2xl">
        <h2 class="text-2xl text-gray-300 font-bold mb-6 py-4 px-3">TaskFlow</h2>
        <nav class="space-y-2">
          <RouterLink
            :to="{ name: 'home' }"
            class="block px-4 py-2 rounded text-gray-300 hover:bg-gray-600"
            :class="{ 'bg-gray-700 font-semibold': $route.name === 'home' }"
          >
            Inicio
          </RouterLink>
        </nav>
      </div>
      
    </aside>
</template>