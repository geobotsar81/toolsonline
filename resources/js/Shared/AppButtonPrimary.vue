<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    url: String,
    extraClass: String,
});
</script>
<template>
    <Link
        v-if="url"
        :class="extraClass ? extraClass : ''"
        class="inline-block bg-red-500 hover:bg-white hover:text-red-500 border-2 border-red-500 text-white text-sm font-semibold text-center py-2.5 px-8 transition duration-500"
        :href="url"
        ><slot
    /></Link>
    <button
        v-else
        type="submit"
        :class="extraClass"
        :href="url"
        class="inline-block bg-red-500 hover:bg-white hover:text-red-500 border-2 border-red-500 text-white text-sm font-semibold text-center py-2.5 px-8 transition duration-500"
    >
        <slot />
    </button>
</template>
