<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-6 w-80">
      <h1 class="text-2xl font-bold text-center mb-4 text-blue-600">Iniciar sesión</h1>
      <input
        v-model="email"
        placeholder="Email"
        class="border border-gray-300 rounded-md px-3 py-2 w-full mb-3 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <input
        v-model="password"
        type="password"
        placeholder="Contraseña"
        class="border border-gray-300 rounded-md px-3 py-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
      <button
        @click="handleLogin"
        class="bg-blue-600 text-white font-semibold rounded-md py-2 w-full hover:bg-blue-700 transition"
      >
        Iniciar sesión
      </button>
      <p v-if="error" class="text-red-500 text-sm text-center mt-3">{{ error }}</p>
    </div>
  </div>
</template>
