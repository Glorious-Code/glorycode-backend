<script setup>
import { useForm } from '@inertiajs/vue3';
import { PlusIcon, TrashIcon } from '@heroicons/vue/24/outline/index.js';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
  selected: {
    type: Object,
    default: () => ({})
  },
  items: Object,
  readOnly: {
    type: Boolean,
    default: false
  }
});

const form = useForm({
  items: [],
  search: ''
});

const emit = defineEmits(['update:selected', 'search']);

const itemsToShow = ref({});

watch(
  () => props.selected,
  () => {
    form.items = props.selected;

    itemsToShow.value = Object.values(props.items).filter((x) => {
      let included = false;
      for (const selected of Object.values(props.selected)) {
        if (selected['id'] === x['id']) {
          included = true;
          break;
        }
      }

      return !included;
    });
  }
);

onMounted(() => {
  itemsToShow.value = props.items;
});

const addItem = (item) => {
  form.items[item] = item;

  emit('update:selected', item, false);
};

const removeItem = (item) => {
  form.items = form.items.filter((s) => s !== item);
  emit('update:selected', item, true);
};

const search = () => {
  emit('search', form.search);
};
</script>

<template>
  <div class="w-full">
    <form @submit.prevent="search" v-if="!readOnly">
      <label
        for="default-search"
        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
        >Search</label
      >
      <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg
            class="w-4 h-4 text-gray-500 dark:text-gray-400"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 20 20"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
            />
          </svg>
        </div>
        <input
          v-model="form.search"
          type="search"
          id="default-search"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="Search"
          required
        />
        <button
          type="submit"
          class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
          Search
        </button>
      </div>
    </form>

    <table
      class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4 border dark:border-gray-700"
    >
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <slot name="table-header" />
          <th scope="col" class="px-4 py-3">
            <span class="sr-only">Actions</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="border-b dark:border-gray-700"
          v-for="(item, idx) in form.items"
          :key="`selected-item-${idx}`"
        >
          <slot :item="item" name="table-row" />
          <td class="px-4 py-3 flex items-center justify-end">
            <ButtonPrimary
              v-if="!readOnly"
              type="button"
              @click="() => removeItem(item)"
              class="bg-red-500 dark:bg-red-500"
            >
              <TrashIcon class="h-3.5 w-3.5" />
            </ButtonPrimary>
          </td>
        </tr>
        <template v-if="!readOnly">
          <tr
            class="border-b dark:border-gray-700"
            v-for="(item, idx) in itemsToShow"
            :key="`item-${idx}`"
          >
            <slot :item="item" name="table-row" />
            <td class="px-4 py-3 flex items-center justify-end">
              <ButtonPrimary type="button" @click="() => addItem(item)">
                <PlusIcon class="h-3.5 w-3.5" />
              </ButtonPrimary>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>
