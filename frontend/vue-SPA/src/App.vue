<template>
  <div>
    <SpinerGlobal v-if="authStore.loading" />
    <RouterView v-else />
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/authStore';
import SpinerGlobal from '@/components/common/SpinerGlobal.vue';

const authStore = useAuthStore();
</script>
