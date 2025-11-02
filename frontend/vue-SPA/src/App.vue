<template>
  <div>
    <SpinerGlobal v-if="authStore.loading" />
    <RouterView v-else />
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useAuthStore } from '@/stores/authStore';
import SpinerGlobal from '@/components/common/SpinerGlobal.vue';

const authStore = useAuthStore();

onMounted(async () => {
  if (authStore.token) {
    await authStore.fetchUser(); // traer el usuario real de laravel
  }
});
</script>
