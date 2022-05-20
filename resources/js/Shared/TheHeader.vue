<script setup>
import { Inertia } from "@inertiajs/inertia";
import AppLogo from "@/Shared/AppLogo.vue";
import AppLink from "@/Shared/AppLink.vue";
import AppDropdown from "@/Shared/AppDropdown.vue";
import AppMegaMenu from "@/Shared/AppMegaMenu.vue";

const logout = () => {
    Inertia.post(route("logout"));
};
</script>
<template>
    <header>
        <div class="container relative">
            <nav class="py-4 navbar-expand-lg relative">
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
                                <AppMegaMenu
                                    >Tools
                                    <template v-slot:items>
                                        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                                            <div class="bg-white text-gray-600">
                                                <div class="font-bold text-lg">Popular Tools</div>
                                                <div class="w-32 mx-auto lg:ml-auto lg:mr-0"><hr class="mt-1 mb-2 border-t-1 border-t-gray-300" /></div>
                                                <ol class="list-disc inline-block">
                                                    <li><AppLink :url="route('tools.lorem-ipsum.show')">Lorem Ipsum Generator</AppLink></li>
                                                </ol>
                                            </div>
                                            <div class="bg-white text-gray-600">
                                                <div class="font-bold text-lg">Case Converters</div>
                                                <div class="w-32 mx-auto lg:ml-auto lg:mr-0"><hr class="mt-1 mb-2 border-t-1 border-t-gray-300" /></div>
                                                <ol class="list-disc inline-block">
                                                    <li><AppLink :url="route('tools.case-converter.to-uppercase.show')">Lowercase to Uppercase</AppLink></li>
                                                    <li><AppLink :url="route('tools.case-converter.to-lowercase.show')">Uppercase to Lowercase</AppLink></li>
                                                    <li><AppLink :url="route('tools.case-converter.to-sentencecase.show')">Sentence Case</AppLink></li>
                                                </ol>
                                            </div>
                                            <div class="bg-white text-gray-600"></div>
                                            <div class="bg-white text-gray-600"></div>
                                        </div>
                                    </template>
                                </AppMegaMenu>
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
