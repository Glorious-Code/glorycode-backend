<script setup>
const props = defineProps({
  size: {
    type: String,
    default: 'md'
  },
  center: {
    type: Boolean,
    default: false
  }
});

const cardSize = () => {
  switch (props.size) {
    case 'full':
      return 'w-full';
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

const center = () => {
  if (props.center) {
    return 'justify-center';
  }

  return '';
};

const classes = {
  container: ['flex flex-col items-center  px-6 py-8 mx-auto md:h-screen lg:py-0', center()],
  card: [
    'w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700',
    cardSize()
  ]
};
</script>

<template>
  <div :class="classes['container']">
    <div :class="classes['card']">
      <slot />
    </div>
  </div>
</template>
