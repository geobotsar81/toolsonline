<script setup>
import AppLink from "@/Shared/AppLink.vue";
import AppH5 from "@/Shared/AppH5.vue";
</script>
<template>
    <footer class="border-t-solid border-t border-t-gray-300">
        <div class="container py-12">
            <div class="grid grid-cols-12 pb-6 text-center sm:text-left">
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">FreeOnlineTools</AppH5></div>
                    <div>
                        <ul class="text-gray-700">
                            <li>
                                <AppLink :url="route('home')"><i class="far fa-angle-right text-sm"></i> Home</AppLink>
                            </li>
                            <!--<li>
                                <AppLink :url="route('faq')"><i class="far fa-angle-right text-sm"></i> FAQ</AppLink>
                            </li>-->
                            <li>
                                <AppLink :url="route('contact.show')"><i class="far fa-angle-right text-sm"></i> Contact</AppLink>
                            </li>
                            <li>
                                <AppLink :url="route('terms')"><i class="far fa-angle-right text-sm"></i> Terms & Conditions</AppLink>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Popular Tools</AppH5></div>
                    <div>
                        <ul class="text-gray-700">
                            <li>
                                <AppLink :url="route('tools.loan-calculator.show')"><i class="far fa-angle-right text-sm"></i> Loan Calculator</AppLink>
                            </li>
                            <li>
                                <AppLink :url="route('tools.lorem-ipsum.show')"><i class="far fa-angle-right text-sm"></i> Lorem Ipsum Generator</AppLink>
                            </li>
                            <li>
                                <AppLink :url="route('tools.case-converter.to-uppercase.show')"><i class="far fa-angle-right text-sm"></i> Case Converters</AppLink>
                            </li>
                            <li>
                                <AppLink :url="route('tools.text-counter.lines-counter.show')"><i class="far fa-angle-right text-sm"></i> Text Counters</AppLink>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Contacts</AppH5></div>
                    <div>
                        <ul class="text-gray-700">
                            <li><i class="far fa-envelope text-red-500 mr-2"></i> info@free-online-tools.com</li>
                            <li><i class="far fa-link text-red-500 mr-2"></i> www.free-online-tools</li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Partner websites</AppH5></div>
                    <div>
                        <ul class="text-gray-700">
                            <li><a target="_blank" href="https://www.laramotely.com">laramotely.com</a></li>
                            <li><a target="_blank" href="https://www.commandpost.dev">commandpost.dev</a></li>
                            <li><a target="_blank" href="https://www.captainbrew.com">captainbrew.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 border-t-solid border-t border-t-gray-300 py-6">
                <div class="col-span-12 md:col-span-6 text-center md:text-left">
                    Made with <i class="fas fa-heart text-red-700"></i> using <i class="fab fa-laravel text-orange-600"></i> and <i class="fab fa-vuejs text-green-500"></i>
                </div>
                <div class="col-span-12 md:col-span-6 text-center md:text-right">© 2022 FreeOnlineTools</div>
            </div>
        </div>
    </footer>
</template>
