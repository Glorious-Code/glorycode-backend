<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import BlankPage from '@/Layouts/BlankPage.vue';
import CardWithLogo from '@/Components/Card/CardWithLogo.vue';
import InputText from '@/Components/Form/InputText.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputError from '@/Components/Form/InputError.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import ModalSuccess from '@/Components/Modal/ModalSuccess.vue';

defineProps({
  canResetPassword: Boolean,
  status: String
});

const form = useForm({
  email: '',
  password: '',
  remember: false
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? 'on' : ''
    }))
    .post(route('login'), {
      onFinish: () => form.reset('password')
    });
};
</script>

<template>
  <Head title="Log in" />

  <BlankPage>
    <section>
      <ModalSuccess v-if="status" :message="status" trigger="successModal" />
      <CardWithLogo>
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Sign in to your account
          </h1>
          <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <div>
              <InputLabel for="email" value="Your Email" />
              <InputText
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="username"
                placeholder="john@glorycode.nl"
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
                required
                autocomplete="current-password"
                placeholder="Password"
                :error="form.errors.password"
              />
              <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <Checkbox v-model:checked="form.remember" name="remember" id="remember" />
                </div>
                <div class="ml-3 text-sm">
                  <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                </div>
              </div>
              <Link
                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                v-if="canResetPassword"
                :href="route('password.request')"
              >
                Forgot password?
              </Link>
            </div>
            <ButtonPrimary
              class="w-full"
              type="submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Login
            </ButtonPrimary>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Don’t have an account yet?
              <Link
                :href="route('register')"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Sign up</Link
              >
            </p>
          </form>
        </div>
      </CardWithLogo>
    </section>
  </BlankPage>
</template>
