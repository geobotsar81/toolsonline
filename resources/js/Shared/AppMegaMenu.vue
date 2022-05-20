<script setup>
defineProps({
    title: String,
    items: Object,
});
</script>
<template>
    <div class="navbar-collapse grow" id="navbarSupportedContentX">
        <ul class="navbar-nav mr-auto flex flex-row">
            <li class="nav-item dropdown static">
                <a
                    class="hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out dropdown-toggle flex items-center whitespace-nowrap"
                    href="#"
                    data-mdb-ripple="true"
                    data-mdb-ripple-color="light"
                    type="button"
                    id="dropdownMenuButtonX"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><slot />
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
                    </svg>
                </a>
                <div class="dropdown-menu w-full mt-0 hidden shadow-lg bg-white absolute left-0 top-full" aria-labelledby="dropdownMenuButtonX">
                    <div class="px-6 lg:px-8 py-5">
                        <slot name="items"></slot>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
