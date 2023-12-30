<script setup>
import FrontLayout from '@/Layouts/FrontLayout.vue';
import Jumbotron from '@/Components/Front/Jumbotron.vue';
import Services from '@/Components/Front/Services.vue';

defineProps({
  services: Array
});
</script>

<template>
  <FrontLayout title="Welcome">
    <Jumbotron />
    <Services :services="services" />
  </FrontLayout>
</template>
