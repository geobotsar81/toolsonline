<script setup>
import AppLink from "@/Shared/AppLink.vue";

defineProps({
    title: String,
    items: Object,
});
</script>
<template>
    <div class="dropdown relative">
        <button class="dropdown-toggle text-black" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <slot />
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="w-2 ml-2 inline-block" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
            </svg>
        </button>
        <ul
            class="dropdown-menu min-w-max absolute bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg shadow-lg mt-1 hidden m-0 bg-clip-padding border-none"
            aria-labelledby="dropdownMenuButton1"
        >
            <slot name="items"></slot>
        </ul>
    </div>
</template>
