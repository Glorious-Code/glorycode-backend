<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  href: {
    type: String,
    default: ''
  },
  active: {
    type: Boolean,
    default: false
  },
  menuId: String
});

const classes = {
  link: 'w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group',
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
    <button
      v-if="$slots['submenu'] && menuId"
      :class="[classes['link'], isActive[0]]"
      :aria-controls="menuId"
      :data-collapse-toggle="menuId"
    >
      <div v-if="$slots['icon']" :class="[classes['icon'], isActive[1]]">
        <slot name="icon" />
      </div>
      <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"
        ><slot name="name"
      /></span>
      <svg
        v-if="$slots['submenu']"
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 10 6"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 4 4 4-4"
        />
      </svg>
    </button>
    <Link v-else :href="href" :class="[classes['link'], isActive[0]]">
      <div :class="[classes['icon'], isActive[1]]">
        <slot name="icon" />
      </div>
      <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"
        ><slot name="name"
      /></span>
      <svg
        v-if="$slots['submenu']"
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 10 6"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 4 4 4-4"
        />
      </svg>
    </Link>
    <ul v-if="$slots['submenu'] && menuId" class="hidden py-2 space-y-2" :id="menuId">
      <slot name="submenu" />
    </ul>
  </li>
</template>
