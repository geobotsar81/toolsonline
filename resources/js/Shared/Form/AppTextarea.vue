<script setup>
defineProps({
    placeHolder: String,
    name: String,
});
</script>
<template>
    <textarea
        :placeholder="placeHolder"
        :name="name"
        type="text"
        class="border-gray-300 w-full focus:border-red hover:border-red transition-colors duration-500 focus:outline-none focus:shadow-none focus:ring-0"
    ></textarea>
</template>
