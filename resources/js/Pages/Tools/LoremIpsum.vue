<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppInput from "@/Shared/Form/AppInput.vue";
import AppError from "@/Shared/Form/AppError.vue";
import AppSelect from "@/Shared/Form/AppSelect.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppLoader from "@/Shared/Form/AppLoader";
import { useMainStore } from "@/Stores/mainStore";

import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);

const loremNumber = ref(5);
const loremType = ref("paragraphs");
const loremText = ref("");
const honeypot = ref(null);
const errorMessage = ref(null);
const processing = ref(false);

const options = ["words", "sentences", "paragraphs"];
const mainStore = useMainStore();

onMounted(() => {
    generateLoremIpsum();
});

function generateLoremIpsum() {
    errorMessage.value = "";
    processing.value = true;

    axios
        .post(route("tools.lorem-ipsum_generate"), {
            loremNumber: loremNumber.value,
            loremType: loremType.value,
            honeypot: honeypot.value,
        })
        .then((response) => {
            loremText.value = response.data.loremText;
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
            mainStore.toastAppear("Could not generate lorem ipsum", "error");
        });
}

function copyText() {
    let text = "";
    try {
        if (Array.isArray(loremText.value)) {
            loremText.value.forEach((element) => {
                text = text + element + "\n\n";
            });
        } else {
            text = loremText.value;
        }
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
                                <div class="col-span-2">
                                    <AppInput placeholder="" name="loremNumber" v-model="loremNumber" />
                                </div>
                                <div class="col-span-3">
                                    <AppSelect :options="options" v-model="loremType" />
                                </div>
                                <div class="col-span-3">
                                    <AppButtonPrimary v-if="!processing" @click="generateLoremIpsum" :disabled="processing">GENERATE</AppButtonPrimary>
                                    <AppLoader v-else class="mx-auto mt-2" />
                                </div>
                                <div class="col-span-4 text-right">
                                    <AppButtonPrimary v-if="!processing" @click.prevent="copyText"><i class="fas fa-copy mr-2" :disabled="copying"></i> COPY</AppButtonPrimary>
                                </div>
                            </div>
                        </div>
                        <div class="text-4xl text-gray-300">"</div>
                        <div class="text-xl text-gray-500">
                            <template v-if="Array.isArray(loremText)">
                                <p class="mb-4" v-for="(option, index) in loremText" :key="index">{{ option }}</p>
                            </template>
                            <span v-else>{{ loremText }}</span>
                        </div>
                        <div class="text-4xl text-gray-300 text-right">"</div>
                    </AppWhiteContainer>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
