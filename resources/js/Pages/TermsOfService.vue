<script setup>
import { Head } from '@inertiajs/vue3';
import CardWithLogo from '@/Components/Card/CardWithLogo.vue';
import BlankPage from '@/Layouts/BlankPage.vue';

defineProps({
  terms: String
});
</script>

<template>
  <Head title="Terms of Service" />

  <BlankPage>
    <section class="w-full">
      <CardWithLogo size="5xl">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <div class="text-gray-900 dark:text-gray-50 prose dark:prose-invert" v-html="terms" />
        </div>
      </CardWithLogo>
    </section>
  </BlankPage>
</template>
