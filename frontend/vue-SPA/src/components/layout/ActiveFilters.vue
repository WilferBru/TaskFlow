<template>
    <div v-if="bubbles.length" class="mt-2">
        <div class="flex flex-wrap justify-center gap-2">
            <div
            v-for="bubble in bubbles"
            :key="bubble.key"
            class="flex items-center gap-2 px-3 py-1 rounded-full
                    bg-sky-100 text-sky-800 text-sm font-medium"
            >
            {{ bubble.label }}
            <button
                class="text-sky-600 hover:text-sky-900 cursor-pointer"
                @click="$emit('remove', bubble.key)"
            >
                ✕
            </button>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">

defineProps<{
    bubbles: {
        key: string,
        label: string,
    }[];
}>();

defineEmits<{
    (e: 'remove', key: string): void;
    (e: 'clear'): void;
}>();

</script>
