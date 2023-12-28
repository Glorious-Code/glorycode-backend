<script setup>
import {Head, Link, usePage} from '@inertiajs/vue3';
import {computed} from "vue";
import Header from "@/Layouts/Components/Front/Header.vue";

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

        <footer class="footer footer-center p-4 bg-base-300 text-base-content">
            <aside>
                <p>Copyright © {{ (new Date()).getUTCFullYear() }} - All right reserved by {{ $page.props.app.title }}</p>
            </aside>
        </footer>
    </div>
</div>
</template>
