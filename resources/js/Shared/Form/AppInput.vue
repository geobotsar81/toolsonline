<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
    placeHolder: String,
    name: String,
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <input
        :placeholder="placeHolder"
        :name="name"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        type="text"
        class="border-gray-300 w-full focus:border-red-500 hover:border-red-500 transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
    />
</template>
