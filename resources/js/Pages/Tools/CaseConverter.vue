<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppText from "@/Shared/AppText.vue";
import AppTextarea from "@/Shared/Form/AppTextarea.vue";
import AppError from "@/Shared/Form/AppError.vue";
import AppSelect from "@/Shared/Form/AppSelect.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppLoader from "@/Shared/Form/AppLoader";
import { useMainStore } from "@/Stores/mainStore";

import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);
const convertType = computed(() => usePage().props.value.convertType);

const textToTransform = ref("");
const errorMessage = ref(null);
const processing = ref(false);

const mainStore = useMainStore();

function convertText() {
    errorMessage.value = "";
    processing.value = true;

    try {
        if (convertType.value == "to-uppercase") {
            textToTransform.value = textToTransform.value.toUpperCase();
        }
        if (convertType.value == "to-lowercase") {
            textToTransform.value = textToTransform.value.toLowerCase();
        }

        processing.value = false;
        mainStore.toastAppear("Converted successfully!", "success");
    } catch (error) {
        errorMessage.value = "";
        processing.value = false;
        mainStore.toastAppear("Could not convert text", "error");
    }
}

function copyText() {
    let text = "";
    try {
        text = textToTransform.value;

        navigator.clipboard.writeText(text);

        mainStore.toastAppear("Copied to clipboard!", "success");
    } catch (error) {
        mainStore.toastAppear("Could not copy content to clipboard", "error");
    }
}
</script>

<template>
    <AppLayout :title="pageMeta.title" :description="pageMeta.description" :url="pageMeta.url">
        <div class="container py-8">
            <div class="text-center">
                <AppH1>{{ pageMeta.title }}</AppH1>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                    <AppSubtitle>{{ pageMeta.description }}</AppSubtitle>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-8">
                <div class="col-span-12 lg:col-span-10 lg:col-start-2">
                    <AppWhiteContainer>
                        <div class="text-xl text-gray-500">
                            <AppTextarea placeholder="Type your text here" name="textToTransform" v-model="textToTransform" />
                        </div>

                        <div class="p-6 bg-gray-100 border-5-2 border-gray-200 -mb-6 -ml-6 -mr-6 mt-4">
                            <div class="grid grid-cols-12 gap-x-2">
                                <div class="col-span-12">
                                    <AppButtonPrimary class="w-100" v-if="!processing" @click="convertText">CONVERT</AppButtonPrimary>
                                    <AppButtonPrimary v-if="!processing" @click.prevent="copyText" class="ml-2"><i class="fas fa-copy mr-2"></i> COPY</AppButtonPrimary>
                                    <AppLoader v-else class="mx-auto mt-2" />
                                </div>
                            </div>
                        </div>
                    </AppWhiteContainer>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
