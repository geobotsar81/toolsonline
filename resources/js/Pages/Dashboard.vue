<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="container py-8">
            <div class="text-center"><AppH1>Dashboard</AppH1></div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Eiusmod tempor incididunt ut labore.</AppSubtitle>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
