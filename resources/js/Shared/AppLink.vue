<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    url: String,
    title: String,
    type: String,
});
</script>
<template>
    <button v-if="type == 'button'" type="submit" class="hover:text-red-500 transition-colors duration-500"><slot /></button>
    <Link v-else class="hover:text-red-500 transition-colors duration-500" :href="url"><slot /></Link>
</template>
