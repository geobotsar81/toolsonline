<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppText from "@/Shared/AppText.vue";
import AppInput from "@/Shared/Form/AppInput.vue";
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
const relatedTools = computed(() => usePage().props.value.generators);
const convertType = pageMeta.value.convertType;

const outputLength = ref(5);
const output = ref("");
const honeypot = ref(null);
const errorMessage = ref(null);
const processing = ref(false);

const options = ["words", "sentences", "paragraphs"];
const mainStore = useMainStore();

onMounted(() => {
    generateOutput();
});

const generateOutput = _.debounce(() => {
    errorMessage.value = "";
    processing.value = true;

    const url = route(`tools.random-generator.${convertType}.generate`);

    axios
        .post(url, {
            outputLength: outputLength.value,
            outputType: convertType,
            honeypot: honeypot.value,
        })
        .then((response) => {
            output.value = response.data.output;
            processing.value = false;
        })
        .catch((error) => {
            if (error.response.data.errors) {
                const errors = error.response.data.errors;
                errorMessage.value = "";
                for (const [key, value] of Object.entries(errors)) {
                    errorMessage.value += `${value}`;
                }
            }
            processing.value = false;
            mainStore.toastAppear("Could not generate output", "error");
        });
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
                        <div class="p-6 bg-gray-100 border-b-2 border-gray-200 -mt-6 -ml-6 -mr-6 mb-4">
                            <div class="grid grid-cols-12 gap-x-2">
                                <div class="col-span-12">
                                    <AppError v-if="errorMessage" class="mb-2">
                                        {{ errorMessage }}
                                    </AppError>
                                </div>
                                <div class="col-span-12">
                                    <input type="hidden" name="honeypot" v-model="honeypot" />
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-x-2">
                                <div class="col-span-6 md:col-span-3 mb-4 md:mb-0">
                                    <AppLabel>Length(characters)</AppLabel>
                                    <AppInput placeholder="" name="outputLength" v-model="outputLength" />
                                </div>
                                <div class="col-span-6 mt-6 md:col-span-3 text-right md:text-left">
                                    <AppButtonPrimary class="w-100" v-if="!processing" @click="generateOutput">GENERATE</AppButtonPrimary>
                                    <AppLoader v-else class="mx-auto mt-2" />
                                </div>
                                <div class="col-span-6 mt-6 md:col-span-3 text-left md:text-right">
                                    <AppButtonPrimary v-if="!processing" @click.prevent="useCopyText(output)"><i class="fas fa-copy mr-2"></i> COPY</AppButtonPrimary>
                                </div>
                            </div>
                        </div>
                        <div class="text-4xl text-gray-300">"</div>
                        <div class="text-xl text-gray-500">
                            <template v-if="Array.isArray(output)">
                                <p class="mb-4" v-for="(option, index) in output" :key="index">{{ option }}</p>
                            </template>
                            <span v-else>{{ output }}</span>
                        </div>
                        <div class="text-4xl text-gray-300 text-right">"</div>
                    </AppWhiteContainer>
                </div>
            </div>

            <template v-if="relatedTools">
                <div class="text-center mt-8">
                    <AppH2>Related Tools</AppH2>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-8">
                    <template v-for="(tool, index) in relatedTools" :key="index">
                        <div v-if="index != convertType" class="col-span-12 md:col-span-6 lg:col-span-4">
                            <AppCard :url="tool.url" :icon="tool.icon" :title="tool.title" :content="tool.description"> </AppCard>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </AppLayout>
</template>
