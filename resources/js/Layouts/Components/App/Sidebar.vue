<script setup>
import {
  Cog6ToothIcon,
  AdjustmentsVerticalIcon,
  HomeIcon,
  ClipboardDocumentListIcon
} from '@heroicons/vue/24/outline';
import LanguageSelector from '@/Components/Selector/LanguageSelector.vue';
import SidebarMenuItem from '@/Layouts/Components/App/SidebarMenuItem.vue';
import SidebarFooterMenuItem from '@/Layouts/Components/App/SidebarFooterMenuItem.vue';

const classes = {
  container:
    'fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700',
  'menu-container': 'overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800',
  'footer-container':
    'hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20',
  divider: 'pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700'
};
</script>

<template>
  <aside :class="classes['container']" aria-label="Sidenav" id="drawer-navigation">
    <div :class="classes['menu-container']">
      <ul class="space-y-2">
        <SidebarMenuItem :href="route('dashboard')" :active="route().current('dashboard')">
          <template v-slot:icon>
            <HomeIcon />
          </template>
          Dashboard
        </SidebarMenuItem>
      </ul>
      <ul :class="classes['divider']">
        <SidebarMenuItem href="#">
          <template v-slot:icon>
            <ClipboardDocumentListIcon />
          </template>
          Documentation
        </SidebarMenuItem>
      </ul>
    </div>
    <div :class="classes['footer-container']">
      <SidebarFooterMenuItem href="#">
        <template v-slot:icon>
          <AdjustmentsVerticalIcon />
        </template>
      </SidebarFooterMenuItem>
      <SidebarFooterMenuItem href="#">
        <template v-slot:icon>
          <Cog6ToothIcon />
        </template>
      </SidebarFooterMenuItem>
      <LanguageSelector />
    </div>
  </aside>
</template>
