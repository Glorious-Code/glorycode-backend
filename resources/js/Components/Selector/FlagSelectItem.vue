<script setup>
import Flag from '@/Components/Flag/Flag.vue';
import { loadLanguageAsync } from 'laravel-vue-i18n';
import { defineEmits, onMounted, ref, defineProps, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  code: String,
  country: String,
  active: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['update:language']);

onMounted(() => {
  isActive();
});

const select = async () => {
  await loadLanguageAsync(props.code);

  router.post(route('language.update'), {
    language: props.code
  });

  emit('update:language', props.code);
};

const activeClass = ref('');

const isActive = () => {
  activeClass.value = props.active ? 'bg-gray-100 dark:text-white dark:bg-gray-600' : '';
};

const classes = {
  button:
    'w-full text-left block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:text-white dark:text-gray-300 dark:hover:bg-gray-600'
};

watch(
  () => props.active,
  () => {
    isActive();
  }
);
</script>

<template>
  <button @click="select" :class="[classes['button'], activeClass]" role="menuitem">
    <div class="inline-flex items-center">
      <Flag rounded :country="code" class="mr-2" />
      {{ country }}
    </div>
  </button>
</template>
