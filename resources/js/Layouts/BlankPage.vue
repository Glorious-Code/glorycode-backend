<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import FlashMessage from '@/Components/Modal/FlashMessage.vue';

onMounted(() => {
  initFlowbite();
});
</script>

<template>
  <FlashMessage />
  <div class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-900">
    <slot />
  </div>
</template>
