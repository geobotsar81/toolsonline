<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

import { useMainStore } from "@/Stores/mainStore";
import { storeToRefs } from "pinia";

import TheHeader from "@/Shared/TheHeader.vue";
import TheFooter from "@/Shared/TheFooter.vue";
import TheMain from "@/Shared/TheMain.vue";
import TheHead from "@/Shared/TheHead";
import AppToast from "@/Shared/AppToast";

import { Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

Inertia.on("navigate", (event) => {
    dataLayer.push({
        url: event.detail.page.url,
        event: "pageview",
    });
});

defineProps({
    title: String,
    description: String,
    url: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(
        route("current-team.update"),
        {
            team_id: team.id,
        },
        {
            preserveState: false,
        }
    );
};

const logout = () => {
    Inertia.post(route("logout"));
};

const mainStore = useMainStore();
const { toastShow, toastMessage, toastType } = storeToRefs(mainStore);
</script>

<template>
    <div class="relative">
        <TheHead :title="title" :description="description" :url="url"></TheHead>

        <TheHeader></TheHeader>

        <!-- Page Content -->
        <TheMain>
            <slot />
        </TheMain>

        <AppToast :type="toastType" :message="toastMessage" :show="toastShow"></AppToast>

        <TheFooter></TheFooter>
    </div>
</template>
