<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  type: {
    type: String,
    default: 'submit'
  },
  as: {
    type: String,
    default: 'button'
  },
  href: String
});

const classes =
  'p-2 inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700';
</script>

<template>
  <Link v-if="as === 'a'" :href="href" :class="classes">
    <slot />
  </Link>
  <button v-else :type="type" :class="classes">
    <slot />
  </button>
</template>
