<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppCard from "@/Shared/AppCard.vue";
import AppLink from "@/Shared/AppLink.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/inertia-vue3";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <AppLayout :title="pageMeta.title" :description="pageMeta.description" :url="pageMeta.url">
        <div class="grid grid-cols-1 h-[26rem] bg-blue bg-[url('/assets/img/bg.svg')] bg-bottom text-center">
            <div class="col-span-1">
                <h1 class="text-white text-4xl font-bold mt-14">Welcome to Free Online Tools</h1>
                <h2 class="text-white text-2xl font-semibold mt-4">Find a wide range of calculators and tools for your everyday needs</h2>
                <AppButtonPrimary extra-class="rounded-full text-lg" :url="route('tools.all')" class="mt-6">All Tools</AppButtonPrimary>
            </div>
        </div>

        <div class="container py-8">
            <div class="text-center"><AppH2>Popular Tools</AppH2></div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle
                        >Check out below some of our most popular tools/calculators, or <AppLink extra-class="text-red-500" :url="route('tools.all')">click here</AppLink> to see all</AppSubtitle
                    >
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-8">
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                    <AppCard :url="route('tools.loan-calculator.show')" icon="fal fa-piggy-bank" title="Loan Calculator" content="Determine the monthly payments on a loan"> </AppCard>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                    <AppCard :url="route('tools.lorem-ipsum.show')" icon="fal fa-align-left" title="Lorem Ipsum Generator" content="Generate dummy Lorem Ipsum text"> </AppCard>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-4">
                    <AppCard :url="route('tools.case-converter.to-uppercase.show')" icon="fal fa-text-size" title="Lower to Uppercase" content="Convert your text from lowercase to uppercase">
                    </AppCard>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
