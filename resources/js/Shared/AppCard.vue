<script setup>
import AppH3 from "@/Shared/AppH3.vue";
import AppLink from "@/Shared/AppLink.vue";

defineProps({
    icon: String,
    title: String,
    content: String,
    url: String,
});
</script>
<template>
    <AppLink :url="url" class="h-full">
        <div class="h-full mb-2 shadow p-6 text-center bg-white border-b-2 border-gray-100 hover:border-red-500 transition-colors duration-500">
            <i :class="icon" class="text-red-500 text-4xl"></i>
            <AppH3 class="pt-4">{{ title }}</AppH3>
            <p class="text-gray-900 pt-4">{{ content }}</p>
        </div>
    </AppLink>
</template>
