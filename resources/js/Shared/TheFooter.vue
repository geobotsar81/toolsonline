<script setup>
import AppLink from "@/Shared/AppLink.vue";
import AppH5 from "@/Shared/AppH5.vue";
</script>
<template>
    <footer class="border-t-solid border-t border-t-gray-300">
        <div class="container py-12">
            <div class="grid grid-cols-12 pb-6 text-center sm:text-left">
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Menu Items</AppH5></div>
                    <div>
                        <ul>
                            <li><AppLink url="dashboard" title="Home"></AppLink></li>
                            <li><AppLink url="dashboard" title="FAQ"></AppLink></li>
                            <li><AppLink url="dashboard" title="Contact"></AppLink></li>
                            <li><AppLink url="dashboard" title="Terms & Conditions"></AppLink></li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Calculators</AppH5></div>
                    <div>
                        <ul>
                            <li><AppLink url="dashboard" title="Home"></AppLink></li>
                            <li><AppLink url="dashboard" title="FAQ"></AppLink></li>
                            <li><AppLink url="dashboard" title="Contact"></AppLink></li>
                            <li><AppLink url="dashboard" title="Terms & Conditions"></AppLink></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Contacts</AppH5></div>
                    <div>
                        <ul>
                            <li><AppLink url="dashboard" title="Home"></AppLink></li>
                            <li><AppLink url="dashboard" title="FAQ"></AppLink></li>
                            <li><AppLink url="dashboard" title="Contact"></AppLink></li>
                            <li><AppLink url="dashboard" title="Terms & Conditions"></AppLink></li>
                        </ul>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 md:col-span-3 mb-4">
                    <div><AppH5 class="mb-2">Follow us</AppH5></div>
                    <div>
                        <ul>
                            <li><AppLink url="dashboard" title="Home"></AppLink></li>
                            <li><AppLink url="dashboard" title="FAQ"></AppLink></li>
                            <li><AppLink url="dashboard" title="Contact"></AppLink></li>
                            <li><AppLink url="dashboard" title="Terms & Conditions"></AppLink></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 border-t-solid border-t border-t-gray-300 py-6">
                <div class="col-span-12 md:col-span-6 text-center md:text-left">Made with <i class="fas fa-heart"></i> using <i class="fab fa-laravel"></i> and <i class="fab fa-vuejs"></i></div>
                <div class="col-span-12 md:col-span-6 text-center md:text-right">© 2022 FreeOnlineTools</div>
            </div>
        </div>
    </footer>
</template>
