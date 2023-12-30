<script setup>
import {Head, router} from "@inertiajs/vue3";
import BlankPage from "@/Layouts/BlankPage.vue";
import Header from "@/Layouts/Components/App/Header.vue";
import Sidebar from "@/Layouts/Components/App/Sidebar.vue";

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};

const classes = {
    "container": "p-4 md:ml-64 h-auto pt-20",
}
</script>

<template>
    <Head :title="title" />

    <BlankPage>
        <Header />
        <Sidebar />

        <main :class="classes['container']">
            <slot />
        </main>
    </BlankPage>
</template>
