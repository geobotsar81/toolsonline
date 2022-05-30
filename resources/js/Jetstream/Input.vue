<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-gray-300 w-full focus:border-red-500 hover:border-red-500 transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
