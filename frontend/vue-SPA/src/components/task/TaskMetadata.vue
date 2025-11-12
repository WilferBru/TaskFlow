<template>
  <div>
    <div
      v-for="(attr, index) in attributes"
      :key="index"
      class="flex items-center gap-3 mb-3"
    >
      <!-- Nombre del atributo -->
      <input
        v-model="attr.key"
        type="text"
        placeholder="Nombre del atributo"
        class="flex-1 px-3 py-2 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
      />

      <!-- Valor del atributo -->
      <input
        v-model="attr.value"
        type="text"
        placeholder="Valor del atributo"
        class="flex-1 px-3 py-2 bg-slate-300 border-0 rounded-lg text-black placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition"
      />

      <!-- Botón eliminar -->
      <button
        type="button"
        @click="removeAttribute(index)"
        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition"
      >
        ✕
      </button>
    </div>

    <!-- Botón agregar atributo -->
    <button
      type="button"
      @click="addAttribute"
      :disabled="attributes.length >= 10"
      class="mt-3 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-600 disabled:bg-gray-400 disabled:cursor-not-allowed transition"
    >
      + Agregar atributo
    </button>

    <!-- Mensaje máximo -->
    <p v-if="attributes.length >= 10" class="text-red-600 mt-2 text-sm">
      Solo puedes agregar hasta 10 atributos.
    </p>
  </div>
</template>

<script setup lang="ts">
import { ref, watch, defineEmits, defineProps } from 'vue'

const emit = defineEmits(['update:modelValue'])

const props = defineProps({
  modelValue: {
    type: Array as () => string[], // ahora es array de strings
    default: () => [],
  },
})

const attributes = ref<{ key: string; value: string }[]>(
  props.modelValue.map((attr) => {
    // dividir si viene en formato "key: value"
    const [key, value] = attr.split(':').map((s) => s.trim())
    return { key: key || '', value: value || '' }
  })
)

// cada vez que cambia algo, actualizamos el array de strings "key: value"
watch(
  attributes,
  (newVal) => {
    const formatted = newVal
      .filter((a) => a.key && a.value)
      .map((a) => `${a.key}: ${a.value}`);
    emit('update:modelValue', formatted);
  },
  { deep: true }
)

// agregar atributo vacío
const addAttribute = () => {
  if (attributes.value.length < 10) {
    attributes.value.push({ key: '', value: '' })
  }
}

// eliminar atributo
const removeAttribute = (index: number) => {
  attributes.value.splice(index, 1)
}
</script>
