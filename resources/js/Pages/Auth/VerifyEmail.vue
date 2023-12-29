<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ModalSuccess from "@/Components/Modal/ModalSuccess.vue";
import CardWithLogo from "@/Components/Card/CardWithLogo.vue";
import ButtonPrimary from "@/Components/Button/ButtonPrimary.vue";
import BlankPage from "@/Layouts/BlankPage.vue";
import ButtonLinkOutline from "@/Components/Button/ButtonLinkOutline.vue";

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <BlankPage>
        <section>
            <ModalSuccess v-if="verificationLinkSent" message="A new verification link has been sent to the email address you provided in your profile settings." trigger="successModal" />
            <CardWithLogo>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 item flex flex-col items-center">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Verify Your Email!
                    </h1>
                    <p class="font-light text-gray-500 dark:text-gray-400 text-center">
                        Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>
                    <div class="text-center">
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">{{ $page.props.auth.user.email }}</h5>
                        <span class="mt-0 pt-0 text-sm text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.name }}</span>
                    </div>
                    <form @submit.prevent="submit" class="w-full">
                        <ButtonPrimary type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Resend Verification Email
                        </ButtonPrimary>
                    </form>
                    <div class="flex w-full">
                        <ButtonLinkOutline class="block w-full justify-center" :href="route('profile.show')">Edit Profile</ButtonLinkOutline>
                        <ButtonLinkOutline class="block w-full justify-center ms-3" :href="route('logout')" method="post" as="button">Log Out</ButtonLinkOutline>
                    </div>
                </div>
            </CardWithLogo>
        </section>
    </BlankPage>
</template>
