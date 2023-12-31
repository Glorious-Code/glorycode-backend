<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ModalSuccess from '@/Components/Modal/ModalSuccess.vue';
import ModalError from '@/Components/Modal/ModalError.vue';

const page = usePage();
const message = computed(() => page.props.flash.message);
const type = computed(() => page.props.flash.message_type);
</script>

<template>
  <div class="text-white">
    <ModalSuccess v-if="message && type === 'success'" :message="message" trigger="flashSuccess" />
    <ModalError v-else-if="message && type === 'error'" :message="message" trigger="flashError" />
  </div>
</template>
