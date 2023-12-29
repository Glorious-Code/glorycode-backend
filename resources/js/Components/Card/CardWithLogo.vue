<script setup>

import Logo from "@/Components/Logo/Logo.vue";
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const page = usePage();
const appTitle = computed(() => page.props.app.title);

const classes = {
    "container": "flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0",
    "card": "w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700",
    "logo": "text-2xl font-semibold mb-6",
}
</script>

<template>
    <div :class="classes['container']">
        <Logo :title="appTitle" :class="classes['logo']" />

        <slot name="prepend" />

        <div :class="classes['card']">
            <slot />
        </div>

        <slot name="append" />
    </div>
</template>
