<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Card from '@/Components/Card/Card.vue';

import { ArrowLeftIcon } from '@heroicons/vue/24/outline';
import { router, useForm } from '@inertiajs/vue3';
import ButtonLinkOutline from '@/Components/Button/ButtonLinkOutline.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputText from '@/Components/Form/InputText.vue';
import InputError from '@/Components/Form/InputError.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import { onMounted } from 'vue';
import MultiModelSelector from '@/Components/Selector/MultiModelSelector.vue';
import SelectorTableHeading from '@/Components/Selector/SelectorTableHeading.vue';
import SelectorTableItem from '@/Components/Selector/SelectorTableItem.vue';

const props = defineProps({
  user: Object,
  roles: Object,
  input: {
    type: Object,
    default: undefined
  }
});

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  roles: []
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      roles: data.roles.map((x) => x['id'])
    }))
    .patch(route('users.update', props.user['id']));
};

const rolesChanged = (role, deleted = false) => {
  if (!deleted) {
    form.roles = [...form.roles, role];
  } else {
    form.roles = form.roles.filter((x) => x !== role);
  }
};

onMounted(() => {
  form.name = props.user.name;
  form.email = props.user.email;
  form.roles = props.user.roles;
});

const search = (value) => {
  router.visit(
    route('users.edit.search', {
      id: props.user['id'],
      key: 'name',
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
    form.email = props.input['email'];
    form.password = props.input['password'];
    form.password_confirmation = props.input['password_confirmation'];
    form.roles = props.input['roles'];
  }
});
</script>

<template>
  <AppLayout title="Dashboard">
    <Card size="full">
      <div
        class="flex justify-start items-center pb-4 mb-4 space-x-2 rounded-t border-b sm:mb-5 dark:border-gray-600 p-4"
      >
        <ButtonLinkOutline as="a" :href="route('users.index')" class="border-0">
          <ArrowLeftIcon class="h-3.5 w-3.5" />
        </ButtonLinkOutline>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update User</h3>
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
          <InputLabel for="email" value="Email" />
          <InputText
            id="email"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            required
            autofocus
            autocomplete="email"
            placeholder="Email"
            :error="form.errors.email"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <div>
          <InputLabel for="password" value="Password" />
          <InputText
            id="password"
            v-model="form.password"
            type="password"
            class="mt-1 block w-full"
            autofocus
            autocomplete="password"
            placeholder="Password"
            :error="form.errors.password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>
        <div>
          <InputLabel for="password_confirmation" value="Confirm Password" />
          <InputText
            id="password_confirmation"
            v-model="form.password_confirmation"
            type="password"
            class="mt-1 block w-full"
            autofocus
            autocomplete="password"
            placeholder="Confirm Password"
            :error="form.errors.password_confirmation"
          />
          <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>
        <div>
          <InputLabel value="Roles" />
          <InputError class="mt-2" :message="form.errors.roles" />
          <MultiModelSelector
            :items="roles"
            :selected="form.roles"
            @update:selected="rolesChanged"
            @search="search"
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
