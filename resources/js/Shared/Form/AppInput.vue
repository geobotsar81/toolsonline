<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
    placeHolder: String,
    name: String,
    icon: String,
});

defineEmits(["update:modelValue"]);
</script>
<template>
    <div class="relative">
        <i v-if="icon" :class="icon" class="absolute top-4 right-4"></i>
        <input
            :placeholder="placeHolder"
            :name="name"
            :id="name"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            type="text"
            class="border-gray-300 border-2 w-full py-2 focus:border-red-500 hover:border-red-500 transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
        />
    </div>
</template>
