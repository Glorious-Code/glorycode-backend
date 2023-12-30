<script setup>
import { Link } from '@inertiajs/vue3'

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
})

const classes =
  'text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800'
</script>

<template>
  <Link v-if="as === 'a'" :href="href" :class="classes">
    <slot />
  </Link>
  <button v-else :type="type" :class="classes">
    <slot />
  </button>
</template>
