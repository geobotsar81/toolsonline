<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>
<template>
    <footer class="border-t-solid border-t border-t-gray-300">
        <div class="container py-12">
            <div class="grid grid-cols-12 pb-6 text-center sm:text-left">
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><h3 class="text-xl font-bold">Menu Items</h3></div>
                    <div>
                        <ul>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Home</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">FAQ</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Contact</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Terms & Conditions</Link></li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><h3 class="text-xl font-bold">Calculators</h3></div>
                    <div>
                        <ul>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Home</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">FAQ</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Contact</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Terms & Conditions</Link></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><h3 class="text-xl font-bold">Contacts</h3></div>
                    <div>
                        <ul>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Home</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">FAQ</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Contact</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Terms & Conditions</Link></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><h3 class="text-xl font-bold">Follow us</h3></div>
                    <div>
                        <ul>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Home</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">FAQ</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Contact</Link></li>
                            <li><Link class="hover:text-red" :href="route('dashboard')">Terms & Conditions</Link></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 border-t-solid border-t border-t-gray-300 py-6">
                <div class="col-span-12 md:col-span-6 text-center md:text-left">Made with love with Laravel & InertiaJs | Terms & Conditions</div>
                <div class="col-span-12 md:col-span-6 text-center md:text-right">© 2022 FreeOnlineTools</div>
            </div>
        </div>
    </footer>
</template>
