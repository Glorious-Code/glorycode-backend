<script setup>
const classes = {
  container: 'flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0',
  card: 'w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700'
};
</script>

<template>
  <div :class="classes['container']">
    <div :class="classes['card']">
      <slot />
    </div>
  </div>
</template>
