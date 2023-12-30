<script setup>
import { computed } from 'vue';

const props = defineProps({
  rounded: {
    type: Boolean,
    default: true
  },
  country: String,
  size: {
    type: Boolean,
    default: false
  }
});

const size = computed(() => {
  if (props.size) {
    return '';
  }

  return `h-3.5 w-3.5`;
});

const country = computed(() => {
  let country = props.country;

  if (country === 'en') {
    country = 'gb';
  }

  return `fi fi-${country} fis`;
});

const rounded = computed(() => {
  if (props.rounded) {
    return 'rounded-full';
  }

  return '';
});
</script>

<template>
  <span :class="[country, rounded, size]"></span>
</template>

<style scoped>
.fi {
  background-size: cover;
}
</style>
