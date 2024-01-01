<script setup>
import InputLabel from '@/Components/Form/InputLabel.vue';
import { useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Form/Checkbox.vue';
import { watch } from 'vue';

const props = defineProps({
  permissions: Object,
  subjects: Object,
  actions: Object,
  selected: {
    type: Object,
    default: () => ({})
  }
});

const form = useForm({
  permissions: []
});

watch(
  () => props.selected,
  () => {
    for (const name of Object.values(props.selected)) {
      form.permissions[name] = true;
    }
  }
);

const emit = defineEmits(['update:checked']);

const valueChanged = (permission, value) => {
  form.permissions[permission] = value;
  emit('update:checked', permission, value);
};

const permissionExists = (name) => {
  const permission = Object.values(props.permissions).find((s) => s === name);

  return permission !== undefined && permission !== null;
};
</script>

<template>
  <ul
    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-t-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
  >
    <li
      class="flex w-full justify-center items-center border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
    >
      <div class="flex w-full ps-3 py-3 ms-2 justify-center">
        <InputLabel value="Subject/Action" />
      </div>
    </li>
    <li
      v-for="action in actions"
      :key="`action-${action}`"
      class="py-3 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
    >
      <div class="flex items-center ps-3 justify-center">
        <InputLabel :value="action" />
      </div>
    </li>
  </ul>
  <ul
    v-for="subject in subjects"
    :key="`subject-${subject}`"
    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
  >
    <li
      class="flex w-full justify-center items-center border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
    >
      <div class="flex w-full ps-3 py-3 ms-2 justify-center">
        <InputLabel :value="subject" />
      </div>
    </li>
    <li
      v-for="action in actions"
      :key="`permission-${subject}.${action}`"
      class="flex w-full justify-center items-center border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
    >
      <div class="flex w-full ps-3 py-3 ms-2 justify-center">
        <Checkbox
          v-if="permissionExists(`${subject}.${action}`)"
          @update:checked="
            (val) => {
              valueChanged(`${subject}.${action}`, val);
            }
          "
          v-model:checked="form.permissions[`${subject}.${action}`]"
          :name="`permission-${subject}.${action}`"
          :id="`permission-${subject}.${action}`"
        />
      </div>
    </li>
  </ul>
</template>
