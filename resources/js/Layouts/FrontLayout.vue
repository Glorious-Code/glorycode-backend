<script setup>
import {Head, Link, usePage} from '@inertiajs/vue3';
import { ArrowLeftEndOnRectangleIcon, UserPlusIcon } from '@heroicons/vue/24/solid'
import {computed} from "vue";

defineProps({
    title: String
});

const page = usePage();
const appTitle = computed(() => page.props.app.title);

</script>

<template>
<div>
    <Head :title="title" />

    <div class="min-h-screen">
        <nav class="navbar bg-neutral">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">{{ appTitle }}</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    <li>
                        <Link :href="route('login')">
                            <ArrowLeftEndOnRectangleIcon class="h-5 w-5" />
                            Login
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('register')">
                            <UserPlusIcon class="h-5 w-5" />
                            Register
                        </Link>
                    </li>
                </ul>
            </div>
        </nav>
        <main>
            <slot />
        </main>
    </div>
</div>
</template>
