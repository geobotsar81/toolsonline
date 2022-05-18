<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

import TheHeader from "@/Shared/TheHeader.vue";
import TheFooter from "@/Shared/TheFooter.vue";
import TheMain from "@/Shared/TheMain.vue";
import TheHead from "@/Shared/TheHead";

import { Link } from "@inertiajs/inertia-vue3";
import JetApplicationMark from "@/Jetstream/ApplicationMark.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink.vue";

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
</script>

<template>
    <TheHead :title="title" :description="description" :url="url"></TheHead>

    <TheHeader></TheHeader>

    <!-- Page Content -->
    <TheMain>
        <slot />
    </TheMain>

    <TheFooter></TheFooter>
</template>
