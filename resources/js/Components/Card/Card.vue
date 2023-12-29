<script setup>

import Logo from "@/Components/Logo/Logo.vue";
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const page = usePage();
const appTitle = computed(() => page.props.app.title);

const classes = {
    "container": "flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0",
    "card": "w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700",
}
</script>

<template>
    <div :class="classes['container']">
        <div :class="classes['card']">
            <slot />
        </div>
    </div>
</template>
