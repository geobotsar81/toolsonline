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

const countType = computed(() => usePage().props.value.countType);

const textToTransform = ref("");
const errorMessage = ref(null);
const processing = ref(false);
const countResult = ref("");
const countDescription = ref("");

const relatedTools = ref([
    {
        url: route("tools.text-counter.lines-counter.show"),
        icon: "fal fa-abacus",
        title: "Lines Counter",
        description: "Count number of lines in a given text",
    },
    {
        url: route("tools.text-counter.sentences-counter.show"),
        icon: "fal fa-abacus",
        title: "Sentences Counter",
        description: "Count number of sentences in a given text",
    },
    {
        url: route("tools.text-counter.words-counter.show"),
        icon: "fal fa-abacus",
        title: "Words Counter",
        description: "Count number of words in a given text",
    },
    {
        url: route("tools.text-counter.characters-counter.show"),
        icon: "fal fa-abacus",
        title: "Characters Counter",
        description: "Count number of characters in a given text",
    },
]);

_.remove(relatedTools.value, function (n) {
    return n.url == pageMeta.value.url;
});

const countText = _.debounce(() => {
    errorMessage.value = "";
    processing.value = true;

    let text = textToTransform.value;

    try {
        if (countType.value == "lines") {
            const lines = text.split(/\r|\r\n|\n/);
            countResult.value = lines.length;
            countDescription.value = "lines counted";
        }
        if (countType.value == "sentences") {
            const sentences = text.match(/[\w|\)][.?!](\s|$)/g);
            countResult.value = sentences.length;
            countDescription.value = "sentences counted";
        }
        if (countType.value == "words") {
            const arr = text.split(" ");

            countResult.value = arr.filter((word) => word !== "").length;
            countDescription.value = "words counted";
        }

        if (countType.value == "characters") {
            countResult.value = text.length;
            countDescription.value = "characters counted";
        }

        processing.value = false;
        mainStore.toastAppear("Text count completed successfully!", "success");
    } catch (error) {
        errorMessage.value = "";
        processing.value = false;
        mainStore.toastAppear("Could not count text", "error");
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
                                <div class="col-span-6">
                                    <AppButtonPrimary class="w-100" v-if="!processing" @click="countText">COUNT</AppButtonPrimary>
                                    <AppLoader v-else class="mx-auto mt-2" />
                                </div>
                                <div class="col-span-6 text-right mt-1">
                                    <span class="text-4xl font-bold">{{ countResult }}</span> {{ countDescription }}
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
