<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    url: String,
    title: String,
});
</script>
<template>
    <Link class="hover:text-red transition-colors duration-500" :href="route(url)">{{ title }}</Link>
</template>
