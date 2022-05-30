<script setup>
defineProps({
    label: String,
    labelFor: String,
});
</script>
<template>
    <label :for="labelFor" class="font-semibold">{{ label }}</label>
</template>
