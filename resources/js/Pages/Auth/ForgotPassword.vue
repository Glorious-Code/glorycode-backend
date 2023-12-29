<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/Form/InputLabel.vue";
import InputText from "@/Components/Form/InputText.vue";
import InputError from "@/Components/Form/InputError.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import ToastSuccess from "@/Components/Toast/ToastSuccess.vue";
import CardWithLogo from "@/Components/Card/CardWithLogo.vue";
import ButtonPrimary from "@/Components/Button/ButtonPrimary.vue";
import BlankPage from "@/Layouts/BlankPage.vue";
import ModalSuccess from "@/Components/Modal/ModalSuccess.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <BlankPage>
        <section>
            <ModalSuccess v-if="status" :message="status" trigger="successModal" />
            <CardWithLogo>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Forgot your password?
                    </h1>
                    <p class="font-light text-gray-500 dark:text-gray-400">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
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
                        <ButtonPrimary type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Email Password Reset Link
                        </ButtonPrimary>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            I remember my password! <Link :href="route('login')" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login</Link>
                        </p>
                    </form>
                </div>
            </CardWithLogo>
        </section>
    </BlankPage>
</template>
