<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    type: String,
});
</script>
<template>
    <div class="inline-block">
        <button v-if="type == 'small'" class="border-blue-100 border hover:bg-blue-100 hover:text-white text-blue-100 rounded-md text-sm text-center py-2 px-2 transition duration-200">
            <slot />
        </button>
        <button v-else class="border-blue-100 border hover:bg-blue-100 hover:text-white text-blue-100 rounded-md text-lg text-center py-2 px-8 transition duration-200">
            <slot />
        </button>
    </div>
</template>
