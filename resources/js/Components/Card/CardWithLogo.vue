<script setup>
const props = defineProps({
  cardClasses: String,
  size: {
    type: String,
    default: 'md'
  }
});

import Logo from '@/Components/Logo/Logo.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const appTitle = computed(() => page.props.app.title);

const cardSize = () => {
  switch (props.size) {
    case '5xl':
      return 'sm:max-w-5xl';
    case '4xl':
      return 'sm:max-w-4xl';
    case '3xl':
      return 'sm:max-w-3xl';
    case '2xl':
      return 'sm:max-w-2xl';
    case 'xl':
      return 'sm:max-w-xl';
    case 'l':
      return 'sm:max-w-l';
    default:
      return 'sm:max-w-md';
  }
};

const classes = {
  container:
    'w-full flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0',
  card: [
    'w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700',
    cardSize()
  ],
  logo: 'text-2xl font-semibold mb-6'
};
</script>

<template>
  <div :class="classes['container']">
    <Logo :title="appTitle" :class="classes['logo']" />

    <slot name="prepend" />

    <div :class="[classes['card'], cardClasses]">
      <slot />
    </div>

    <slot name="append" />
  </div>
</template>
