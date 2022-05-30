<script setup>
import AppLink from "@/Shared/AppLink.vue";
</script>
<template>
    <AppLink :url="route('home')">
        <i class="far fa-calculator text-red-500 d-inline-block text-3xl"></i>
        <span class="text-2xl text-gray-900 font-bold"> FreeOnlineTools </span>
    </AppLink>
</template>
