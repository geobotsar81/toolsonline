<template>
    <div>
        <div class="container py-8">
            <div class="text-center">
                <AppH1>{{ title }}</AppH1>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle>{{ description }}</AppSubtitle>
                </div>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppButtonPrimary extra-class="rounded-full text-lg" url="/" class="mt-6">Back to home page</AppButtonPrimary>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";

export default {
    components: {
        AppLayout,
        AppH1,
        AppSubtitle,
        AppButtonPrimary,
    },
    props: {
        status: Number,
    },
    computed: {
        title() {
            return {
                503: "503: Service Unavailable",
                500: "500: Server Error",
                404: "404: Page Not Found",
                403: "403: Forbidden",
            }[this.status];
        },
        description() {
            return {
                503: "Sorry, we are doing some maintenance. Please check back soon.",
                500: "Whoops, something went wrong on our servers.",
                404: "Sorry, the page you are looking for could not be found.",
                403: "Sorry, you are forbidden from accessing this page.",
            }[this.status];
        },
    },
};
</script>
