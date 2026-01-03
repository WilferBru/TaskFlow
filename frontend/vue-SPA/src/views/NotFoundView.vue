<template>
  <div class="min-h-screen flex flex-col items-center justify-center text-center">
    <h1 class="text-6xl font-bold text-red-500">404</h1>
    <p class="mt-4 text-lg text-gray-600">
      La página que buscas no existe
    </p>

    <RouterLink
      to="/"
      class="mt-6 px-4 py-2 bg-emerald-500 text-white rounded-lg"
    >
      Volver al inicio
    </RouterLink>
  </div>
</template>
