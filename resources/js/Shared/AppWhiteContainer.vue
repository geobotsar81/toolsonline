<script setup>
import AppH3 from "@/Shared/AppH3.vue";

defineProps({
    icon: String,
    title: String,
    content: String,
});
</script>
<template>
    <div class="mb-2 p-6 text-left bg-white border border-gray-200">
        <slot />
    </div>
</template>
