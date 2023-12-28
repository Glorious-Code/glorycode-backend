<script setup>
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

defineProps({
    title: String
});

const page = usePage();
const appTitle = computed(() => page.props.app.title);

const classes = {
    "logo-link": "flex items-center lg:justify-center lg:order-2",
    "logo": "mr-3 h-8 text-primary-500",
}
</script>

<template>
    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <a href="#" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" :class="classes['logo']">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                </svg>
                <span :class="classes['title']">{{ appTitle }}</span>
            </a>
            <p class="my-6 text-gray-500 dark:text-gray-400">
                Discover Glorious Code, empowering students with real-world tech experience. Join our community, hunt for exceptional tech talent, and shape the future together!
            </p>
<!--            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">-->
<!--                <li>-->
<!--                    <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>-->
<!--                </li>-->
<!--            </ul>-->
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023-{{ (new Date()).getUTCFullYear() }} <a :href="route('frontpage')" class="hover:underline text-primary-500">{{ appTitle }}</a>. All Rights Reserved.</span>
        </div>
    </footer>
</template>
