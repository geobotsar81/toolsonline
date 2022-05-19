<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLogo from "@/Shared/AppLogo.vue";
import AppLink from "@/Shared/AppLink.vue";
import AppDropdown from "@/Shared/AppDropdown.vue";

const logout = () => {
    Inertia.post(route("logout"));
};
</script>
<template>
    <header>
        <div class="container">
            <nav class="py-4">
                <div class="grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-3 text-center lg:text-left">
                        <AppLogo></AppLogo>
                    </div>
                    <div class="col-span-12 lg:col-span-9 text-center lg:text-right py-2">
                        <ul>
                            <li class="inline-block px-3">
                                <AppLink :url="route('home')"> Home </AppLink>
                            </li>
                            <li class="inline-block px-3">
                                <AppDropdown
                                    >Calculators
                                    <template v-slot:items>
                                        <li class="px-3">
                                            <AppLink :url="route('tools.lorem-ipsum')"> Lorem Ipsum Generator</AppLink>
                                        </li>
                                    </template>
                                </AppDropdown>
                            </li>
                            <li class="inline-block px-3">
                                <AppLink :url="route('contact.show')"> Contact </AppLink>
                            </li>
                            <template v-if="$page.props.user">
                                <li class="inline-block px-3">
                                    <AppDropdown
                                        >Welcome <strong>{{ $page.props.user.name }}</strong>
                                        <template v-slot:items>
                                            <li class="px-3">
                                                <AppLink :url="route('dashboard')"> Dashboard </AppLink>
                                            </li>
                                            <li class="px-3">
                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <AppLink type="button"> Log Out </AppLink>
                                                </form>
                                            </li>
                                        </template>
                                    </AppDropdown>
                                </li>
                            </template>
                            <template v-else>
                                <li class="inline-block px-3"><AppLink :url="route('login')"> Login </AppLink>/ <AppLink :url="route('register')"> Register </AppLink></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>
