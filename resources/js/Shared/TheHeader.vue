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
                                            <div class="bg-white text-gray-600 text-left">
                                                <div class="font-bold text-lg">Popular Tools</div>
                                                <div class="w-32 ml-0"><hr class="mt-1 mb-2 border-t-2 border-t-red-500 border-dashed" /></div>
                                                <ul class="inline-block">
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.lorem-ipsum.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Lorem Ipsum Generator</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.loan-calculator.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Loan Calculator</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.bmi-calculator.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> BMI Calculator</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.internet-speed-test.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Internet Speed Test</AppLink
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="bg-white text-gray-600 text-left">
                                                <div class="font-bold text-lg">Case Converters</div>
                                                <div class="w-32 ml-0"><hr class="mt-1 mb-2 border-t-2 border-t-red-500 border-dashed" /></div>
                                                <ul class="inline-block">
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.case-converter.to-uppercase.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Lowercase to Uppercase</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.case-converter.to-lowercase.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Uppercase to Lowercase</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.case-converter.to-sentencecase.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Sentence Case</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.case-converter.to-wordcase.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Word Case</AppLink
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="bg-white text-gray-600 text-left">
                                                <div class="font-bold text-lg">Text Counters</div>
                                                <div class="w-32 ml-0"><hr class="mt-1 mb-2 border-t-2 border-t-red-500 border-dashed" /></div>
                                                <ul class="inline-block">
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.text-counter.lines-counter.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Lines Counter</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.text-counter.sentences-counter.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Sentences Counter</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.text-counter.words-counter.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Words Counter</AppLink
                                                        >
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.text-counter.characters-counter.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Characters Counter</AppLink
                                                        >
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="bg-white text-gray-600 text-left">
                                                <div class="font-bold text-lg">Random Generators</div>
                                                <div class="w-32 ml-0"><hr class="mt-1 mb-2 border-t-2 border-t-red-500 border-dashed" /></div>
                                                <ul class="inline-block">
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.random-generator.random-number.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Random Number
                                                        </AppLink>
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.random-generator.random-password.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Random Password
                                                        </AppLink>
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.random-generator.random-word.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Random Word
                                                        </AppLink>
                                                    </li>
                                                    <li class="mt-1">
                                                        <AppLink extra-class="font-semibold" :url="route('tools.random-generator.random-sentence.show')"
                                                            ><i class="far fa-angle-right text-sm"></i> Random Sentence
                                                        </AppLink>
                                                    </li>
                                                </ul>
                                            </div>
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
