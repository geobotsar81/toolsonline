<script setup>
defineProps({
    extraClass: String,
});
</script>
<template>
    <button
        type="submit"
        :class="extraClass"
        class="inline-block bg-red-500 hover:bg-white hover:text-red-500 border-2 border-red-500 text-white text-sm font-semibold text-center py-2.5 px-8 transition duration-500"
    >
        <slot />
    </button>
</template>
