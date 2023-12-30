<script setup>
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'

onMounted(() => {
  initFlowbite()
})
</script>

<template>
  <div class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-900">
    <slot />
  </div>
</template>
