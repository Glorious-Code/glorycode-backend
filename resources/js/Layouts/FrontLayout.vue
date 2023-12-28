<script setup>
import {Head, Link, usePage} from '@inertiajs/vue3';
import {computed} from "vue";
import Header from "@/Layouts/Components/Front/Header.vue";
import Footer from "@/Layouts/Components/Front/Footer.vue";

defineProps({
    title: String
});

const page = usePage();
const appTitle = computed(() => page.props.app.title);

</script>

<template>
<div>
    <Head :title="title" />

    <div class="flex flex-col min-h-screen">
        <Header title="Hello World" />
        <main>
            <slot />
        </main>

        <Footer />
    </div>
</div>
</template>
