<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Logo from '@/Components/Logo/Logo.vue';

const page = usePage();
const appTitle = computed(() => page.props.app.title);

const classes = {
  logo: 'lg:order-2'
};
</script>

<template>
  <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl text-center">
      <Logo :title="appTitle" :class="classes['logo']" />
      <p class="my-6 text-gray-500 dark:text-gray-400">
        Discover Glorious Code, empowering students with real-world tech experience. Join our
        community, hunt for exceptional tech talent, and shape the future together!
      </p>
      <!--            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">-->
      <!--                <li>-->
      <!--                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>-->
      <!--                </li>-->
      <!--            </ul>-->
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400"
        >© 2023-{{ new Date().getUTCFullYear() }}
        <a :href="route('frontpage')" class="hover:underline text-primary-500">{{ appTitle }}</a
        >. All Rights Reserved.</span
      >
    </div>
  </footer>
</template>
