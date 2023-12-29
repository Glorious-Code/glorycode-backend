<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    title: String
});

const classes = {
    "logo-link": "flex text-gray-900 dark:text-gray-50 items-center lg:justify-center",
    "logo": "mr-3 h-6 text-primary-500",
}
</script>

<template>
    <Link :href="route('frontpage')" :class="classes['logo-link']">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" :class="classes['logo']">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
        </svg>
        <span :class="classes['title']">{{ title }}</span>
    </Link>
</template>
