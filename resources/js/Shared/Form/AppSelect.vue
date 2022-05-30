<script setup>
defineProps({
    modelValue: String,
    options: Array,
    name: String,
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <select
        @input="$emit('update:modelValue', $event.target.value)"
        :name="name"
        :id="name"
        class="border-gray-300 border-2 w-full py-2 focus:border-red-500 hover:border-red-500 transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
    >
        <option v-for="(option, index) in options" :key="index" :value="option" :selected="modelValue == option">{{ option }}</option>
    </select>
</template>
