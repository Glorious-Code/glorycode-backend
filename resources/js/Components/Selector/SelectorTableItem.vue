<script setup>
defineProps({
  value: {
    type: [String, Number],
    default: ''
  }
});
</script>

<template>
  <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
    {{ value }}
  </th>
</template>
