<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { PlusIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import InputSearch from '@/Components/Form/InputSearch.vue';
import { onMounted } from 'vue';
import NumericPaginator from '@/Components/Paginator/NumericPaginator.vue';
import ModalDeleteForm from '@/Components/Modal/ModalDeleteForm.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';

const props = defineProps({
  users: Object,
  name: String,
  auth: Object
});

const form = useForm({
  name: '',
  per_page: 15
});

const search = (name) => {
  form.name = name;
  form.get(route('users.index'));
};

const deleteuser = (user) => {
  router.delete(
    route('users.delete', {
      id: user['id']
    })
  );
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
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">users</h3>
      </div>
      <div
        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
      >
        <div class="w-full md:w-1/2">
          <InputSearch
            @submitted="search"
            :model-value="form.name"
            placeholder="Search"
            input-id="searchInput"
          />
        </div>
        <div
          class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
        >
          <ButtonPrimary
            as="a"
            :href="route('users.create')"
            class="flex items-center justify-center"
          >
            <PlusIcon class="h-3.5 w-3.5 mr-2" />
            Add user
          </ButtonPrimary>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
          >
            <tr>
              <th scope="col" class="px-4 py-3">ID</th>
              <th scope="col" class="px-4 py-3">Name</th>
              <th scope="col" class="px-4 py-3">Email</th>
              <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="border-b dark:border-gray-700"
              v-for="(user, idx) in users['data']"
              :key="`user-${idx}`"
            >
              <th
                scope="row"
                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user['id'] }}
              </th>
              <th
                scope="row"
                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user['name'] }}
              </th>
              <th
                scope="row"
                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ user['email'] }}
              </th>
              <td class="px-4 py-3 flex items-center justify-end">
                <ButtonLinkOutline
                  v-if="auth.user.permissions['users.update']"
                  as="a"
                  :href="route('users.edit', user['id'])"
                  class="border-0"
                >
                  <PencilIcon class="h-3.5 w-3.5" />
                </ButtonLinkOutline>
                <ModalDeleteForm
                  :key="`delete-user-${idx}`"
                  :modal-id="`delete-user-${idx}`"
                  :item="user"
                  @confirmed="deleteuser"
                  v-if="auth.user.permissions['users.delete']"
                >
                  <template v-slot:button>
                    <TrashIcon class="h-3.5 w-3.5 text-red-500" />
                  </template>
                  <template v-slot:body> Are you sure you want to delete this user? </template>
                </ModalDeleteForm>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <NumericPaginator
        :links="users['links']"
        :to="users['to']"
        :from="users['from']"
        :total="users['total']"
        :first_page_url="users['first_page_url']"
        :last_page_url="users['last_page_url']"
      />
    </Card>
  </AppLayout>
</template>
