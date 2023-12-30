<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '@/Layouts/Components/Front/Header.vue';
import Footer from '@/Layouts/Components/Front/Footer.vue';
import BlankPage from '@/Layouts/BlankPage.vue';

defineProps({
  title: String
});
</script>

<template>
  <Head :title="title" />

  <BlankPage>
    <Header />
    <main>
      <slot />
    </main>

    <Footer />
  </BlankPage>
</template>
