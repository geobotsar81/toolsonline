<script setup>
import AppLogo from "@/Shared/AppLogo.vue";
import { Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <header>
        <div class="container">
            <nav class="py-4">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 md:col-span-3 text-center md:text-left">
                        <AppLogo></AppLogo>
                    </div>
                    <div class="col-span-12 md:col-span-9 text-center md:text-right py-2">
                        <ul>
                            <li class="inline-block px-3">
                                <Link class="hover:text-red" :href="route('dashboard')"> Home </Link>
                            </li>
                            <li class="inline-block px-3">
                                <Link class="hover:text-red" :href="route('dashboard')"> Calculators </Link>
                            </li>
                            <li class="inline-block px-3">
                                <Link class="hover:text-red" :href="route('dashboard')"> Contact </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>
