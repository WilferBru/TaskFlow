<template>
<div class="w-full flex justify-center mt-10">
  <div class="bg-gray-900 text-green-400 p-6 rounded-xl shadow-xl font-mono relative max-w-3xl w-full">

    <!-- Botones estilo editor -->
    <div class="flex gap-2 mb-4">
      <span class="w-3 h-3 rounded-full bg-red-500"></span>
      <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
      <span class="w-3 h-3 rounded-full bg-green-500"></span>
    </div>

    <!-- Contenido estilo código -->
    <div class="space-y-1">
      <p><span class="text-gray-500">/*</span></p>

      <p> * Hola, mi nombre es <span class="text-blue-400">Wilfer Bru</span> 👋</p>
      <p> * Bienvenido a <span class="text-cyan-400">TaskFlow</span>.</p>

      <p> * Tecnología utilizada:</p>
      <p> * - <span class="text-yellow-300">Laravel 12</span> (Backend)</p>
      <p> * - <span class="text-green-300">Vue 3 + TypeScript</span> (Frontend)</p>
      <p> * - <span class="text-purple-300">Docker & PostgreSQL</span></p>
      <p> * - <span class="text-orange-600">Git & Github</span></p>

      <p> * Objetivo: desarrollar, documentar y desplegar en la nube.</p>

      <p> * Rol: Backend Developer | Laravel | Vue | Docker | Git | Git Actions</p>

      <p><span class="text-gray-500">*/</span></p>
    </div> <!-- 👈 CIERRE CORRECTO AQUÍ -->

    <!-- FOOTER -->
    <div class="mt-6 flex flex-col items-center gap-4 text-sm text-gray-300">

        <p class="text-gray-400">Encuentra más sobre mí en:</p>

        <div class="flex items-center justify-center gap-10">

            <!-- GitHub -->
            <a 
            href="https://github.com/WilferBru"
            target="_blank"
            class="flex flex-col items-center gap-1 hover:text-green-200 transition"
            >
            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 .5C5.65.5.5 5.65.5 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2.1c-3.3.7-4-1.6-4-1.6-.5-1.3-1.3-1.6-1.3-1.6-1-.7.1-.7.1-.7 1.1.1 1.7 1.1 1.7 1.1 1 .1 2.3-.5 2.9-.8.1-.7.4-1.3.7-1.6-2.7-.3-5.6-1.3-5.6-6 0-1.3.5-2.3 1.2-3.2-.1-.3-.5-1.5.1-3.1 0 0 1-.3 3.3 1.2a11.3 11.3 0 0 1 6 0c2.3-1.5 3.3-1.2 3.3-1.2.6 1.6.2 2.8.1 3.1.8.9 1.2 2 1.2 3.2 0 4.8-3 5.7-5.7 6 .4.4.8 1.1.8 2.2v3.3c0 .3.2.7.8.6A10.98 10.98 0 0 0 23.5 12c0-6.35-5.15-11.5-11.5-11.5Z"/>
            </svg>
            <span class="text-xs">GitHub</span>
            </a>

            <!-- LinkedIn -->
            <a 
            href="https://www.linkedin.com/in/wilfer-jose-bru-torres-455b7220b/"
            target="_blank"
            class="flex flex-col items-center gap-1 hover:text-green-200 transition"
            >
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5.001 2.5 2.5 0 0 1 0-5Zm.02 4.75h-.02c-.66 0-1.2-.54-1.2-1.2v-.02c0-.66.54-1.2 1.2-1.2h.02c.66 0 1.2.54 1.2 1.2v.02c0 .66-.54 1.2-1.2 1.2ZM3 9h4v12H3V9Zm7 0h3.8v1.6h.05c.53-1 1.84-2.05 3.8-2.05 4.06 0 4.8 2.67 4.8 6.13V21H17v-5.3c0-1.26-.02-2.88-1.76-2.88-1.76 0-2.03 1.38-2.03 2.8V21h-4V9Z"/>
            </svg>
            <span class="text-xs">LinkedIn</span>
            </a>

        </div>

        <p class="text-xs text-gray-500">Este proyecto está disponible en mi GitHub.</p>

    </div>


  </div>
</div>
</template>
