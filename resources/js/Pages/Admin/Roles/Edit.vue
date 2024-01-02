<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import { onMounted } from 'vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputText from '@/Components/Form/InputText.vue';
import InputError from '@/Components/Form/InputError.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import PermissionsSelector from '@/Components/Selector/PermissionsSelector.vue';
import MultiUserSelector from '@/Components/Selector/MultiUserSelector.vue';

const props = defineProps({
  role: Object,
  permissions: Object,
  users: Object,
  subjects: Object,
  actions: Object
});

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
    route('roles.edit', {
      id: props.role['id'],
      key: 'email',
      operator: 'LIKE',
      value: value
    })
  );
};
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
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Create Role</h3>
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
          />
        </div>
        <div>
          <MultiUserSelector
            :users="users"
            :selected="form.users"
            @update:selected="usersChanged"
            @search="search"
          />
        </div>
        <ButtonPrimary
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
