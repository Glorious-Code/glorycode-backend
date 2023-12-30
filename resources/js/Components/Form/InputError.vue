<script setup>
defineProps({
  message: String
})
</script>

<template>
  <p class="mt-2 text-sm text-red-600 dark:text-red-500">
    {{ message }}
  </p>
</template>
