<script setup>
import AppH3 from "@/Shared/AppH3.vue";

defineProps({
    icon: String,
    title: String,
    content: String,
    extraClass: String,
});
</script>
<template>
    <div :class="extraClass" class="mb-2 p-6 text-left bg-white border border-gray-200">
        <slot />
    </div>
</template>
