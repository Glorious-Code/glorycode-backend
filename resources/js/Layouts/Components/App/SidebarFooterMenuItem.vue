<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  href: String,
  active: {
    type: Boolean,
    default: false
  }
})

const classes = {
  link: 'inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600',
  icon: 'w-6 h-6',
  'active-link': 'bg-gray-100 dark:bg-gray-700',
  'active-icon': 'text-gray-900 dark:text-white'
}

const isActive = computed(() => {
  return props.active ? [classes['active-link'], classes['active-icon']] : ['', '']
})
</script>

<template>
  <Link :href="href" :class="[classes['link'], isActive[0]]">
    <div :class="[classes['icon'], isActive[1]]">
      <slot name="icon" />
    </div>

    <slot />
  </Link>
</template>
