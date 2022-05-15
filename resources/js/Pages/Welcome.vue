<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

const publicUrl = computed(() => usePage().props.value.publicUrl);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <AppLayout title="Welcome">
        <div class="grid grid-cols-1 h-[26rem] bg-blue bg-[url('/assets/img/bg.svg')] bg-bottom text-center">
            <div class="col-span-1">
                <h1 class="text-white text-4xl font-bold mt-14">Welcome to Free Online Tools</h1>
                <h2 class="text-white text-2xl font-semibold mt-4">Find a wide range of calculators and tools for your everyday needs</h2>
            </div>
        </div>

        <div class="container"></div>
    </AppLayout>
</template>
