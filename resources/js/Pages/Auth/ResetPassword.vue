<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputText from '@/Components/Form/InputText.vue'
import CardWithLogo from '@/Components/Card/CardWithLogo.vue'
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue'
import BlankPage from '@/Layouts/BlankPage.vue'

const props = defineProps({
  email: String,
  token: String
})

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: ''
})

const submit = () => {
  form.post(route('password.update'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  })
}
</script>

<template>
  <Head title="Reset Password" />

  <BlankPage>
    <section>
      <CardWithLogo>
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Reset Password
          </h1>
          <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
            <div>
              <InputLabel for="email" value="Your Email" />
              <InputText
                id="email"
                v-model="form.email"
                type="email"
                class="mt-1 block w-full"
                disabled
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
            <ButtonPrimary
              class="w-full"
              type="submit"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Reset Password
            </ButtonPrimary>
          </form>
        </div>
      </CardWithLogo>
    </section>
  </BlankPage>
</template>
