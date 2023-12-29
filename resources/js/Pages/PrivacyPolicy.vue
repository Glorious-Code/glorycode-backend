<script setup>
import {Head, Link} from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputLabel from "@/Components/Form/InputLabel.vue";
import ModalSuccess from "@/Components/Modal/ModalSuccess.vue";
import InputText from "@/Components/Form/InputText.vue";
import InputError from "@/Components/Form/InputError.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import CardWithLogo from "@/Components/Card/CardWithLogo.vue";
import ButtonPrimary from "@/Components/Button/ButtonPrimary.vue";
import BlankPage from "@/Layouts/BlankPage.vue";

defineProps({
    policy: String,
});
</script>

<template>
    <Head title="Privacy Policy" />

    <BlankPage>
        <section class="w-full">
            <CardWithLogo size="5xl">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="text-gray-900 dark:text-gray-50 prose dark:prose-invert" v-html="policy" />
                </div>
            </CardWithLogo>
        </section>
    </BlankPage>
</template>
