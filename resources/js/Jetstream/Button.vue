<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button :type="type" class="bg-red-500 hover:bg-white hover:text-red-500 border-2 border-red-500 text-white text-sm font-semibold text-center py-2 px-8 transition duration-200">
        <slot />
    </button>
</template>
