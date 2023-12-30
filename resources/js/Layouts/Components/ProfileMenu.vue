<script setup>
import {Link, router} from '@inertiajs/vue3'
import { KeyIcon } from '@heroicons/vue/24/outline'

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <button
        type="button"
        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0"
        id="user-menu-button"
        aria-expanded="false"
        data-dropdown-toggle="profile-menu-dropdown"
    >
        <span class="sr-only">Open user menu</span>
        <img v-if="$page.props.jetstream.managesProfilePhotos"
            class="w-8 h-8 rounded-full"
            :src="$page.props.auth.user.profile_photo_url"
             :alt="$page.props.auth.user.name"
        />
        <div class="text-right" v-else>
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                {{ $page.props.auth.user.name }}
            </span>
            <span class="block text-sm text-gray-900 truncate dark:text-white">
                {{ $page.props.auth.user.email }}
            </span>
        </div>
    </button>
    <div
        class="hidden z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
        id="profile-menu-dropdown"
    >
        <div class="py-3 px-4">
              <span
                  class="block text-sm font-semibold text-gray-900 dark:text-white">
                  {{ $page.props.auth.user.name }}
              </span
              >
            <span
                class="block text-sm text-gray-900 truncate dark:text-white">
                {{ $page.props.auth.user.email }}
            </span>
        </div>
        <ul
            class="py-1 text-gray-700 dark:text-gray-300"
            aria-labelledby="profile-menu-dropdown"
        >
            <li>
                <Link
                    :href="route('profile.show')"
                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white"
                >My profile
                </Link>
            </li>
        </ul>
        <ul
            class="py-1 text-gray-700 dark:text-gray-300"
            aria-labelledby="profile-menu-dropdown"
            v-if="$page.props.jetstream.hasApiFeatures"
        >
            <li>
                <Link v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <KeyIcon class="mr-2 w-5 h-5 text-gray-400" />
                    API Tokens
                </Link>
            </li>
        </ul>
        <ul
            class="py-1 text-gray-700 dark:text-gray-300"
            aria-labelledby="profile-menu-dropdown"
        >
            <li>
                <form method="POST" @submit.prevent="logout">
                    <button
                        class="w-full text-start block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        Log Out
                    </button>
                </form>
            </li>
        </ul>
    </div>
</template>
