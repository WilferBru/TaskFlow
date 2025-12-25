<template>
  <div class="p-6 space-y-10">

    <!-- HEADER FULL WIDTH -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-gray-700">
        Mi perfil
      </h1>

      <button class="text-gray-600 hover:text-gray-200 btn btn-outline btn-sm">
        Cambiar contraseña
      </button>
    </div>

    <!-- CARD CENTRADA -->
    <div class="max-w-xl mx-auto">
      <div class="card bg-white shadow-xl">
        <div class="card-body items-center text-center space-y-4">

          <!-- Foto -->
          <div class="w-24 h-24 rounded-full overflow-hidden">
            <img
              :src="profile"
              alt="Foto de perfil"
              class="w-full h-full object-cover"
            />
          </div>

          <!-- Datos -->
          <div class="space-y-1">

             <h2 class="flex justify-center text-gray-800 text-xl font-semibold leading-none">
                <button
                  class="flex items-center gap-2 p-0.5 rounded cursor-pointer"
                  title="Editar perfil"
                >
                  <span>
                    {{ authStore.user?.name }}
                  </span>

                  <EditIcon class="w-4 h-4 text-gray-500" />
                </button>
              </h2>


            <p class="text-gray-500 mt-3">
              {{ authStore.user?.email }}
            </p>

            <span class="badge badge-outline text-gray-600 mt-3">
              Miembro desde {{ createdAt }}
            </span>

          </div>


        </div>
      </div>
    </div>

  </div>
</template>



<script setup lang="ts">
import { useAuthStore } from '@/stores/authStore';
import profile from '@/assets/imgs/profile.png'
import EditIcon from '@/components/common/icons/EditIcon.vue';

const authStore = useAuthStore();

const createdAt = authStore.user?.created_at
  ? new Date(authStore.user.created_at).toLocaleDateString('es-CO', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    })
  : ''



</script>
