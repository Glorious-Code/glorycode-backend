<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: String,
  active: {
    type: Boolean,
    default: false
  }
});

const classes = {
  link: 'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group',
  icon: 'w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white',
  'active-link': 'bg-gray-100 dark:bg-gray-700',
  'active-icon': 'text-gray-900 dark:text-white'
};

const isActive = computed(() => {
  return props.active ? [classes['active-link'], classes['active-icon']] : ['', ''];
});
</script>

<template>
  <li>
    <Link :href="href" :class="[classes['link'], isActive[0]]">
      <div v-if="$slots['icon']" :class="[classes['icon'], isActive[1]]">
        <slot name="icon" />
      </div>
      <span class="ml-3"><slot /></span>
    </Link>
  </li>
</template>
