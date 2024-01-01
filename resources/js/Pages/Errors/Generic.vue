<script setup>

import BlankPage from "@/Layouts/BlankPage.vue";
import {Head} from "@inertiajs/vue3";
import ButtonPrimary from "@/Components/Button/ButtonPrimary.vue";
import {computed} from "vue";
import ButtonLinkOutline from "@/Components/Button/ButtonLinkOutline.vue";

const props = defineProps({ status: Number, previousUrl: String })

const title = computed(() => {
    return {
        503: 'Service Unavailable',
        500: 'Server Error',
        404: 'Page Not Found',
        403: 'Forbidden',
    }[props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[props.status]
})
</script>

<template>
    <Head :title="title" />
    <BlankPage>
        <div class="w-full flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center">
                    <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                        {{  status }}
                    </h1>
                    <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                        {{ title }}
                    </p>
                    <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400 pb-4">
                        {{ description }}
                    </p>
                    <ButtonPrimary as="a" :href="route('dashboard')" class="!mr-4">Go to Dashboard</ButtonPrimary>
                    <ButtonLinkOutline as="a" :href="previousUrl">Go Back</ButtonLinkOutline>
                </div>
            </div>
        </section>
        </div>
    </BlankPage>
</template>
