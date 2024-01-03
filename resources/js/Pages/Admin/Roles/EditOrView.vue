<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import { computed, onMounted } from 'vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputText from '@/Components/Form/InputText.vue';
import InputError from '@/Components/Form/InputError.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import PermissionsSelector from '@/Components/Selector/PermissionsSelector.vue';
import MultiModelSelector from '@/Components/Selector/MultiModelSelector.vue';
import SelectorTableHeading from '@/Components/Selector/SelectorTableHeading.vue';
import SelectorTableItem from '@/Components/Selector/SelectorTableItem.vue';

const props = defineProps({
  role: Object,
  permissions: Object,
  users: Object,
  subjects: Object,
  actions: Object,
  input: {
    type: Object,
    default: undefined
  },
  editable: {
    type: Boolean,
    default: true
  }
});

const titlePrefix = computed(() => (props.editable ? 'Update' : 'View'));

const form = useForm({
  id: null,
  name: '',
  permissions: [],
  users: []
});

onMounted(() => {
  form.name = props.role.name;

  form.permissions = props.role.permissions.map((p) => p['name']);
  form.users = props.role.users;
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      users: data.users.map((x) => x['id'])
    }))
    .patch(route('roles.update', props.role.id));
};

const permissionChanged = (permission, value) => {
  if (value) {
    form.permissions = [...form.permissions, permission];
  } else {
    form.permissions = form.permissions.filter((x) => x !== permission);
  }
};

const usersChanged = (user, deleted = false) => {
  if (!deleted) {
    form.users = [...form.users, user];
  } else {
    form.users = form.users.filter((x) => x !== user);
  }
};

const search = (value) => {
  router.visit(
    route('roles.edit.search', {
      id: props.role['id'],
      key: 'email',
      operator: 'LIKE',
      value: value
    }),
    {
      method: 'post',
      data: form
    }
  );
};

onMounted(() => {
  if (props.input !== undefined) {
    form.name = props.input['name'];
    form.permissions = props.input['permissions'];
    form.users = props.input['users'];
  }
});
</script>

<template>
  <AppLayout title="Dashboard">
    <Card size="full">
      <div
        class="flex justify-start items-center pb-4 mb-4 space-x-2 rounded-t border-b sm:mb-5 dark:border-gray-600 p-4"
      >
        <ButtonLinkOutline as="a" :href="route('roles.index')" class="border-0">
          <ArrowLeftIcon class="h-3.5 w-3.5" />
        </ButtonLinkOutline>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ titlePrefix }} Role</h3>
      </div>
      <form class="space-y-4 md:space-y-6 p-4" @submit.prevent="submit">
        <div>
          <InputLabel for="name" value="Name" />
          <InputText
            id="name"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="role"
            placeholder="User"
            :error="form.errors.name"
            :disabled="!editable"
          />
          <InputError class="mt-2" :message="form.errors.name" />
        </div>
        <div>
          <InputLabel value="Permissions" />
          <InputError class="mt-2" :message="form.errors.permissions" />
          <PermissionsSelector
            @update:checked="permissionChanged"
            :permissions="permissions"
            :actions="actions"
            :subjects="subjects"
            :selected="form.permissions"
            :read-only="!editable"
          />
        </div>
        <div>
          <InputLabel value="Users" />
          <InputError class="mt-2" :message="form.errors.users" />
          <MultiModelSelector
            :items="users"
            :selected="form.users"
            @update:selected="usersChanged"
            @search="search"
            :read-only="!editable"
          >
            <template v-slot:table-header>
              <SelectorTableHeading name="ID" />
              <SelectorTableHeading name="Name" />
              <SelectorTableHeading name="Email" />
            </template>
            <template #table-row="{ item }">
              <SelectorTableItem :value="item['id']" />
              <SelectorTableItem :value="item['name']" />
              <SelectorTableItem :value="item['email']" />
            </template>
          </MultiModelSelector>
        </div>
        <ButtonPrimary
          v-if="editable"
          class="w-full"
          type="submit"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Update
        </ButtonPrimary>
      </form>
    </Card>
  </AppLayout>
</template>
