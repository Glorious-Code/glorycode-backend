<script setup>
defineProps({
  name: String
});
</script>

<template>
  <th scope="col" class="px-4 py-3">{{ name }}</th>
</template>
