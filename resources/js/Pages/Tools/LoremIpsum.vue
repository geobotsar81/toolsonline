<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppInput from "@/Shared/Form/AppInput.vue";
import AppError from "@/Shared/Form/AppError.vue";
import AppSelect from "@/Shared/Form/AppSelect.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";

import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);

let loremNumber = ref(5);
let loremType = ref("paragraphs");
let loremText = ref("");
let honeypot = ref(null);
let errorMessage = ref(null);
let processing = ref(false);

const options = ["words", "sentences", "paragraphs"];

onMounted(() => {
    generateLoremIpsum();
});

function generateLoremIpsum() {
    errorMessage.value = "";
    processing.value = true;

    axios({
        method: "post",
        url: route("tools.lorem-ipsum_generate"),
        data: {
            loremNumber: loremNumber.value,
            loremType: loremType.value,
            honeypot: honeypot.value,
        },
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
                    errorMessage.value += `${key}: ${value}`;
                }
            }
            processing.value = true;
        });
}
</script>

<template>
    <AppLayout :title="pageMeta.title" :description="pageMeta.description" :url="pageMeta.url">
        <div class="container py-8">
            <div class="text-center">
                <AppH1>{{ pageMeta.title }}</AppH1>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-10 md:col-start-1">
                    <AppSubtitle>{{ pageMeta.description }}</AppSubtitle>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-4 mt-8">
                <div class="col-span-12">
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
                                <div class="col-span-1">
                                    <AppInput placeholder="" name="loremNumber" v-model="loremNumber" />
                                </div>
                                <div class="col-span-2">
                                    <AppSelect :options="options" v-model="loremType" />
                                </div>
                                <div class="col-span-3">
                                    <AppButtonPrimary v-if="!processing" @click.prevent="generateLoremIpsum">GENERATE</AppButtonPrimary>
                                </div>
                                <div class="col-span-6 text-right">
                                    <AppButtonPrimary><i class="fas fa-copy mr-2"></i> COPY</AppButtonPrimary>
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
