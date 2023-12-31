<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { PlusIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import InputSearch from '@/Components/Form/InputSearch.vue';
import { onMounted } from 'vue';
import NumericPaginator from '@/Components/Paginator/NumericPaginator.vue';

const props = defineProps({
  roles: Object,
  name: String
});

const form = useForm({
  name: ''
});

const submit = (name) => {
  form.name = name;
  form.get(route('roles.index'));
};

onMounted(() => {
  form.name = props.name;
});
</script>

<template>
  <AppLayout title="Dashboard">
    <Card size="full">
      <div
        class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600 p-4"
      >
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Roles</h3>
      </div>
      <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
      >
        <div class="w-full md:w-1/2">
          <InputSearch
            @submitted="submit"
            :model-value="form.name"
            placeholder="Search"
            input-id="searchInput"
          />
        </div>
        <div
          class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
        >
          <button
            type="button"
            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
          >
            <PlusIcon class="h-3.5 w-3.5 mr-2" />
            Add Role
          </button>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-4 py-3">Name</th>
              <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-b dark:border-gray-700"
              v-for="(role, idx) in roles['data']"
              :key="`role-${idx}`"
            >
              <th
                scope="row"
                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ role['name'] }}
              </th>
              <td class="px-4 py-3 flex items-center justify-end">
                <ButtonLinkOutline :href="route('roles.index')" class="border-0">
                  <PencilIcon class="h-3.5 w-3.5" />
                </ButtonLinkOutline>
                <ButtonLinkOutline :href="route('roles.index')" class="border-0">
                  <TrashIcon class="h-3.5 w-3.5 text-red-500" />
                </ButtonLinkOutline>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <NumericPaginator
        :links="roles['links']"
        :to="roles['to']"
        :from="roles['from']"
        :total="roles['total']"
        :first_page_url="roles['first_page_url']"
        :last_page_url="roles['last_page_url']"
      />
    </Card>
  </AppLayout>
</template>
