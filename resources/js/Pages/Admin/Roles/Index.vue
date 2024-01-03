<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { PlusIcon, PencilIcon, TrashIcon, EyeIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import InputSearch from '@/Components/Form/InputSearch.vue';
import { onMounted } from 'vue';
import NumericPaginator from '@/Components/Paginator/NumericPaginator.vue';
import ModalDeleteForm from '@/Components/Modal/ModalDeleteForm.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';

const props = defineProps({
  roles: Object,
  name: String,
  auth: Object
});

const form = useForm({
  name: '',
  per_page: 15
});

const search = (name) => {
  form.name = name;
  form.get(route('roles.index'));
};

const deleteRole = (role) => {
  router.delete(
    route('roles.delete', {
      id: role['id']
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
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Roles</h3>
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
            :href="route('roles.create')"
            class="flex items-center justify-center"
          >
            <PlusIcon class="h-3.5 w-3.5 mr-2" />
            Add Role
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
                {{ role['id'] }}
              </th>
              <th
                scope="row"
                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
              >
                {{ role['name'] }}
              </th>
              <td class="px-4 py-3 flex items-center justify-end">
                <ButtonLinkOutline
                  v-if="auth.user.permissions['roles.read']"
                  as="a"
                  :href="route('roles.show', role['id'])"
                  class="border-0"
                >
                  <EyeIcon class="h-3.5 w-3.5 text-teal-400" />
                </ButtonLinkOutline>
                <ButtonLinkOutline
                  v-if="auth.user.permissions['roles.update']"
                  as="a"
                  :href="route('roles.edit', role['id'])"
                  class="border-0"
                >
                  <PencilIcon class="h-3.5 w-3.5" />
                </ButtonLinkOutline>
                <ModalDeleteForm
                  :key="`delete-role-${idx}`"
                  :modal-id="`delete-role-${idx}`"
                  :item="role"
                  @confirmed="deleteRole"
                  v-if="auth.user.permissions['roles.delete']"
                >
                  <template v-slot:button>
                    <TrashIcon class="h-3.5 w-3.5 text-red-500" />
                  </template>
                  <template v-slot:body> Are you sure you want to delete this role? </template>
                </ModalDeleteForm>
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
