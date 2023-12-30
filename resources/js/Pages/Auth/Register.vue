<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import InputText from '@/Components/Form/InputText.vue';
import CardWithLogo from '@/Components/Card/CardWithLogo.vue';
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue';
import BlankPage from '@/Layouts/BlankPage.vue';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  });
};
</script>

<template>
  <Head title="Register" />

  <BlankPage>
    <section>
      <CardWithLogo>
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Create an Account
          </h1>
          <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <div>
              <InputLabel for="name" value="Your Name" />
              <InputText
                id="name"
                v-model="form.name"
                type="text"
                class="mt-1 block w-full"
                autofocus
                autocomplete="name"
                placeholder="John Doe"
                :error="form.errors.name"
              />
              <InputError class="mt-2" :message="form.errors.name" />
            </div>
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
                autocomplete="new-password"
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
                required
                autocomplete="new-password"
                placeholder="Repeat Password"
                :error="form.errors.password_confirmation"
              />
              <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div class="flex items-center justify-between">
              <div
                class="flex items-start"
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
              >
                <div class="flex items-center h-5">
                  <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />
                </div>
                <div class="ml-3 text-sm">
                  <label for="terms" class="text-gray-500 dark:text-gray-300">
                    I agree to the
                    <a
                      target="_blank"
                      :href="route('terms.show')"
                      class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                      >Terms of Service</a
                    >
                    and
                    <a
                      target="_blank"
                      :href="route('policy.show')"
                      class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500"
                      >Privacy Policy</a
                    >
                  </label>
                  <InputError class="mt-2" :message="form.errors.terms" />
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
              Create Account
            </ButtonPrimary>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400">
              Already have an account?
              <Link
                :href="route('login')"
                class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                >Login</Link
              >
            </p>
          </form>
        </div>
      </CardWithLogo>
    </section>
  </BlankPage>
</template>
