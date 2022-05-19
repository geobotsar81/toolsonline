<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const publicUrl = computed(() => usePage().props.value.publicUrl);
</script>
<template>
    <img :src="publicUrl + '/assets/img/LoaderIcon.gif'" />
</template>
