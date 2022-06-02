<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppTools from "@/Shared/AppTools.vue";
import AppLink from "@/Shared/AppLink.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/inertia-vue3";

const pageMeta = computed(() => usePage().props.value.pageMeta);
</script>

<template>
    <AppLayout :title="pageMeta.title" :description="pageMeta.description" :url="pageMeta.url">
        <div class="container py-8">
            <div class="text-center">
                <AppH1>{{ pageMeta.title }}</AppH1>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle>{{ pageMeta.description }}</AppSubtitle>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-8">
                <AppTools></AppTools>
            </div>
        </div>
    </AppLayout>
</template>
