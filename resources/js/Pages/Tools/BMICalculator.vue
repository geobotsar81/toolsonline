<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppText from "@/Shared/AppText.vue";
import AppInput from "@/Shared/Form/AppInput.vue";
import AppLabel from "@/Shared/Form/AppLabel.vue";
import AppError from "@/Shared/Form/AppError.vue";
import AppSelect from "@/Shared/Form/AppSelect.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary.vue";
import AppLoader from "@/Shared/Form/AppLoader";

import { useCopyText } from "@/Composables/useCopyText.js";
import { useMainStore } from "@/Stores/mainStore";

import { ref, computed, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const pageMeta = computed(() => usePage().props.value.pageMeta);

const bmiHeight = ref(180);
const bmiWeight = ref(65);
const bmiUnit = ref("Metric Units");
const bmiAge = ref(25);

const honeypot = ref(null);
const bmiResult = ref(null);

const errorMessage = ref(null);
const processing = ref(false);

const unitsOptions = ["Metric Units", "US Units"];

const mainStore = useMainStore();

onMounted(() => {
    calculateBMI();
});

const calculateBMI = _.debounce(() => {
    errorMessage.value = "";
    processing.value = true;

    axios
        .post(route("tools.bmi-calculator.calculate"), {
            bmiHeight: bmiHeight.value,
            bmiWeight: bmiWeight.value,
            bmiUnit: bmiUnit.value,
            bmiAge: bmiAge.value,
            honeypot: honeypot.value,
        })
        .then((response) => {
            bmiResult.value = response.data.bmiResult;
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
            mainStore.toastAppear("Could not calculate BMI", "error");
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
                <div class="col-span-12">
                    <AppWhiteContainer extra-class="p-0">
                        <div class="grid md:grid-cols-2">
                            <div class="p-6 bg-gray-100 border-b-2 border-r-0 md:border-r-2 md:border-m-0 border-gray-200">
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
                                    <div class="col-span-12 mb-4">
                                        <AppLabel label="Units" for="bmiUnit" />
                                        <AppSelect :options="unitsOptions" name="bmiUnit" v-model="bmiUnit" />
                                    </div>
                                    <div class="col-span-12 mb-4">
                                        <AppLabel label="Height" for="bmiHeight" />
                                        <AppInput name="bmiHeight" v-model="bmiHeight" />
                                    </div>
                                    <div class="col-span-12 mb-4">
                                        <AppLabel label="Weight" for="bmiWeight" />
                                        <AppInput name="bmiWeight" v-model="bmiWeight" />
                                    </div>
                                    <div class="col-span-12 mb-4">
                                        <AppLabel label="Age" for="bmiAge" />
                                        <AppInput name="bmiAge" v-model="bmiAge" />
                                    </div>
                                    <div class="col-span-6">
                                        <AppButtonPrimary extraClass="w-full" class="mt-6" v-if="!processing" @click="calculateBMI">CALCULATE</AppButtonPrimary>
                                        <AppLoader v-else class="mx-auto mt-8" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 font-semibold text-4xl mt-8 md:mt-0">BMI</div>
                                    <div class="col-span-12 mt-8 md:mt-0">Your Body Mass Index is:</div>

                                    <div class="col-span-12 mt-2 mb-2">
                                        <hr class="border-gray-300" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </AppWhiteContainer>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
