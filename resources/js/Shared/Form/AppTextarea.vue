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
    <textarea
        :placeholder="placeHolder"
        :name="name"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="border-gray-300 border-2 w-full h-[15rem] focus:border-red-500 hover:border-red-500 transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
    ></textarea>
</template>
