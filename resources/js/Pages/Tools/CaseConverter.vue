<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppCard from "@/Shared/AppCard.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppText from "@/Shared/AppText.vue";
import AppTextarea from "@/Shared/Form/AppTextarea.vue";
import AppError from "@/Shared/Form/AppError.vue";
import AppSelect from "@/Shared/Form/AppSelect.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppLoader from "@/Shared/Form/AppLoader";

import { useCopyText } from "@/Composables/useCopyText.js";
import { useMainStore } from "@/Stores/mainStore";

import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);
const mainStore = useMainStore();

const convertType = computed(() => usePage().props.value.convertType);

const textToTransform = ref("");
const errorMessage = ref(null);
const processing = ref(false);

const relatedTools = ref([
    {
        url: route("tools.case-converter.to-uppercase.show"),
        icon: "fal fa-text",
        title: "lowercase to UPPERCASE",
        description: "Convert your text from lowercase to uppercase",
    },
    {
        url: route("tools.case-converter.to-lowercase.show"),
        icon: "fal fa-text",
        title: "UPPERCASE to lowercase",
        description: "Convert your text from uppercase to lowercase",
    },
    {
        url: route("tools.case-converter.to-sentencecase.show"),
        icon: "fal fa-text",
        title: "Sentence case",
        description: "Convert your text to sentence case",
    },
    {
        url: route("tools.case-converter.to-wordcase.show"),
        icon: "fal fa-text",
        title: "Word Case",
        description: "Capitalise each word",
    },
]);

_.remove(relatedTools.value, function (n) {
    return n.url == pageMeta.value.url;
});

const convertText = _.debounce(() => {
    errorMessage.value = "";
    processing.value = true;

    let text = textToTransform.value;

    try {
        if (convertType.value == "to-uppercase") {
            text = text.toUpperCase();
        }
        if (convertType.value == "to-lowercase") {
            text = text.toLowerCase();
        }
        if (convertType.value == "to-sentencecase") {
            const sentences = text.split(".");
            let newtext = "";
            sentences.forEach((sentence) => {
                let lower = sentence.toLowerCase();
                sentence = sentence.charAt(0).toUpperCase() + lower.slice(1);
                newtext = newtext + sentence + ". ";
            });
            text = newtext;
        }

        if (convertType.value == "to-wordcase") {
            const words = text.split(" ");

            for (let i = 0; i < words.length; i++) {
                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
            }

            words.join(" ");
            text = words;
        }

        textToTransform.value = text;
        processing.value = false;
        mainStore.toastAppear("Converted successfully!", "success");
    } catch (error) {
        errorMessage.value = "";
        processing.value = false;
        mainStore.toastAppear("Could not convert text", "error");
    }
}, 200);
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

                        <div class="p-6 bg-gray-100 border-t-2 border-solid border-gray-200 -mb-6 -ml-6 -mr-6 mt-4">
                            <div class="grid grid-cols-12 gap-x-2">
                                <div class="col-span-12">
                                    <AppButtonPrimary class="w-100" v-if="!processing" @click="convertText">CONVERT</AppButtonPrimary>
                                    <AppButtonPrimary v-if="!processing" @click="useCopyText(textToTransform)" class="ml-2"><i class="fas fa-copy mr-2"></i> COPY</AppButtonPrimary>
                                    <AppLoader v-else class="mx-auto mt-2" />
                                </div>
                            </div>
                        </div>
                    </AppWhiteContainer>
                </div>
            </div>

            <template v-if="relatedTools">
                <div class="text-center mt-8">
                    <AppH2>Related Tools</AppH2>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-8">
                    <div v-for="(tool, index) in relatedTools" :key="index" class="col-span-12 md:col-span-6 lg:col-span-4">
                        <AppCard :url="tool.url" :icon="tool.icon" :title="tool.title" :content="tool.description"> </AppCard>
                    </div>
                </div>
            </template>
        </div>
    </AppLayout>
</template>
