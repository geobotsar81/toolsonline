<script setup>
import AppH3 from "@/Shared/AppH3.vue";

defineProps({
    icon: String,
    title: String,
    content: String,
});
</script>
<template>
    <div class="mb-2 shadow p-6 text-center bg-white border-b-2 border-gray-100 hover:border-red transition-colors duration-500">
        <i :class="icon" class="text-red text-6xl"></i>
        <AppH3 class="pt-4">{{ title }}</AppH3>
        <p class="text-gray-900 pt-4">{{ content }}</p>
    </div>
</template>
