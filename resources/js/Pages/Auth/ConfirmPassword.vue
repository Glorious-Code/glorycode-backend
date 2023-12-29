<script setup>
import { ref } from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ModalSuccess from "@/Components/Modal/ModalSuccess.vue";
import InputText from "@/Components/Form/InputText.vue";
import CardWithLogo from "@/Components/Card/CardWithLogo.vue";
import ButtonPrimary from "@/Components/Button/ButtonPrimary.vue";
import BlankPage from "@/Layouts/BlankPage.vue";

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area" />

    <BlankPage>
        <section>
            <ModalSuccess v-if="status" :message="status" trigger="successModal" />
            <CardWithLogo>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Confirm Password
                    </h1>
                    <p class="font-light text-gray-500 dark:text-gray-400">
                        This is a secure area of the application. Please confirm your password before continuing.
                    </p>
                    <form class="space-y-4 md:space-y-6" @submit.prevent="submit">
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
                        <ButtonPrimary class="w-full" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Confirm
                        </ButtonPrimary>
                    </form>
                </div>
            </CardWithLogo>
        </section>
    </BlankPage>
</template>
