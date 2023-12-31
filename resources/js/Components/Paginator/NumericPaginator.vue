<script setup>
import {
  ChevronDoubleLeftIcon,
  ChevronDoubleRightIcon,
  ChevronLeftIcon,
  ChevronRightIcon
} from '@heroicons/vue/24/outline/index.js';

defineProps({
  from: Number,
  to: Number,
  total: Number,
  first_page_url: String,
  last_page_url: String,
  links: Object
});
</script>

<template>
  <nav
    class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
    aria-label="Table navigation"
  >
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
      Showing
      <span class="font-semibold text-gray-900 dark:text-white">{{ from }}-{{ to }}</span>
      of
      <span class="font-semibold text-gray-900 dark:text-white">{{ total }}</span>
    </span>
    <ul class="inline-flex items-stretch -space-x-px">
      <li>
        <a
          :href="first_page_url"
          class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          <span class="sr-only">First</span>
          <ChevronDoubleLeftIcon class="w-5 h-5" />
        </a>
      </li>
      <li v-for="(link, idx) in links" :key="`page-${idx}`">
        <a
          v-if="idx === 0"
          :href="link['url']"
          class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          <span class="sr-only">Previous</span>
          <ChevronLeftIcon class="w-5 h-5" />
        </a>
        <a
          v-else-if="idx === links.length - 1"
          :href="link['url']"
          class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          <span class="sr-only">Next</span>
          <ChevronRightIcon class="w-5 h-5" />
        </a>
        <a
          v-else
          :href="link['url']"
          :class="[
            'flex items-center justify-center text-sm py-2 px-3 leading-tight',
            link['active']
              ? 'text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
              : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
          ]"
        >
          {{ link['label'] }}
        </a>
      </li>
      <a
        :href="last_page_url"
        class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
      >
        <span class="sr-only">Last</span>
        <ChevronDoubleRightIcon class="w-5 h-5" />
      </a>
    </ul>
  </nav>
</template>
