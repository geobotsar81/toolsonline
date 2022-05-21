<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    url: String,
    title: String,
    type: String,
    color: String,
});
</script>
<template>
    <button v-if="type == 'button'" type="submit" class="hover:text-red-500 transition-colors duration-500"><slot /></button>
    <Link v-else :class="color ? 'text-' + color : ''" class="hover:text-red-500 transition-colors duration-500" :href="url"><slot /></Link>
</template>
