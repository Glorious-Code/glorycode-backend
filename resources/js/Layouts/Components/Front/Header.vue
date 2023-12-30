<script setup>
import { usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import Logo from '@/Components/Logo/Logo.vue'
import ProfileMenu from '@/Layouts/Components/ProfileMenu.vue'
import ButtonPrimary from '@/Components/Button/ButtonPrimary.vue'

import { PaperAirplaneIcon } from '@heroicons/vue/24/outline/index.js'

const page = usePage()
const appTitle = computed(() => page.props.app.title)

const classes = {
  nav: 'bg-white dark:bg-gray-800 border-gray-200 px-4 lg:px-6 py-2.5',
  'nav-grid': 'grid grid-cols-3 items-center mx-auto max-w-screen-xl',
  logo: 'lg:order-2',
  title: 'dark:text-white self-center text-xl font-semibold whitespace-nowrap',
  button:
    'text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800',
  'button-primary':
    'text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800',
  'right-menu': 'flex col-span-2 justify-end items-center lg:order-3 lg:col-span-1',
  'left-menu':
    'hidden col-span-3 justify-between items-center w-full lg:flex lg:w-auto lg:order-1 lg:col-span-1',
  'left-menu-list': 'flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0',
  'menu-item':
    'hover:bg-gray-50 lg:hover:bg-transparent lg:hover:text-primary-700 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 lg:border-0 lg:p-0 dark:border-gray-700',
  'menu-item-active':
    'text-primary-600 dark:text-primary-500 hover:bg-gray-50 lg:hover:bg-transparent dark:hover:bg-gray-700 dark:hover:text-primary-500 lg:dark:hover:bg-transparent block py-2 pr-4 pl-3 border-b border-gray-100 lg:border-0 lg:p-0 dark:border-gray-700'
}
</script>

<template>
  <header>
    <nav :class="classes['nav']">
      <div :class="classes['nav-grid']">
        <Logo :title="appTitle" :class="classes['logo']" />
        <div :class="classes['right-menu']">
          <template v-if="$page.props.auth.user">
            <ButtonPrimary as="a" :href="route('dashboard')" class="max-w-md mr-2 flex">
              <PaperAirplaneIcon class="w-5 h-5 mr-2 rotate-180" />
              Go To App
            </ButtonPrimary>
            <ProfileMenu />
          </template>
          <template v-else>
            <Link :href="route('login')" :class="classes['button']"> Login </Link>
            <Link :href="route('register')" :class="classes['button-primary']">Register</Link>
          </template>

          <button
            data-collapse-toggle="mobile-menu"
            type="button"
            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="mobile-menu"
            aria-expanded="false"
          >
            <span class="sr-only">Open menu</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="w-6 h-6"
            >
              <path
                fill-rule="evenodd"
                d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </div>
        <div :class="classes['left-menu']" id="mobile-menu">
          <ul :class="classes['left-menu-list']">
            <li>
              <Link
                :href="route('frontpage')"
                :class="classes['menu-item-active']"
                aria-current="page"
              >
                Home
              </Link>
            </li>
            <li>
              <Link href="#" :class="classes['menu-item']"> About Us </Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<style scoped></style>
