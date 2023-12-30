<script setup>
import { getActiveLanguage } from 'laravel-vue-i18n';
import Flag from '@/Components/Flag/Flag.vue';
import FlagSelectItem from '@/Components/Selector/FlagSelectItem.vue';
import { onMounted, ref } from 'vue';

const activeLanguage = () => {
  language.value = getActiveLanguage();
};

const language = ref('en');

const languageChanged = () => {
  activeLanguage();
};

onMounted(() => {
  activeLanguage();
});

const isActive = (value) => {
  return language.value === value;
};
</script>

<template>
  <button
    type="button"
    data-dropdown-toggle="language-dropdown"
    class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:hover:text-white dark:text-gray-400 hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600"
  >
    <Flag rounded :country="language" class="mt-0.5 w-5 h-5" size />
  </button>
  <!-- Dropdown -->
  <div
    class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
    id="language-dropdown"
  >
    <ul class="py-1" role="none">
      <li>
        <FlagSelectItem
          country="English"
          code="en"
          v-on:update:language="languageChanged"
          :active="isActive('en')"
        />
      </li>
    </ul>
  </div>
</template>
