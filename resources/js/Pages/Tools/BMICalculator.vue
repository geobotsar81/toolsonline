<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppWhiteContainer from "@/Shared/AppWhiteContainer.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppH2 from "@/Shared/AppH2.vue";
import AppH3 from "@/Shared/AppH3.vue";
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

import { ref, computed, watch, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const pageMeta = computed(() => usePage().props.value.pageMeta);

const bmiHeight = ref(180);
const bmiWeight = ref(65);
const bmiHeight2 = ref(11);
const bmiUnit = ref("Metric Units");
const bmiAge = ref(25);
const honeypot = ref(null);

const bmiResult = ref(null);
const bmiResultDescription = ref(null);
const bmiResultClass = ref(null);

const errorMessage = ref(null);
const processing = ref(false);

const unitsOptions = ["Metric Units", "US Units"];

watch(bmiUnit, (currentValue, oldValue) => {
    if (currentValue == "Metric Units") {
        bmiHeight.value = 180;
        bmiWeight.value = 65;
    } else {
        bmiHeight.value = 5;
        bmiHeight2.value = 11;
        bmiWeight.value = 143;
    }
});

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
            bmiHeight2: bmiHeight2.value,
            bmiWeight: bmiWeight.value,
            bmiUnit: bmiUnit.value,
            bmiAge: bmiAge.value,
            honeypot: honeypot.value,
        })
        .then((response) => {
            bmiResult.value = response.data.bmiResult;

            bmiResultClass.value = "alert alert-primary";
            if (bmiResult.value < 18.5) {
                bmiResultDescription.value = "underweight";
                bmiResultClass.value = "text-purple-700";
            } else if (bmiResult.value < 25) {
                bmiResultDescription.value = "normal";
                bmiResultClass.value = "text-green-700";
            } else if (bmiResult.value < 30) {
                bmiResultDescription.value = "overweight";
                bmiResultClass.value = "text-yellow-700";
            } else {
                bmiResultDescription.value = "obese";
                bmiResultClass.value = "text-red-700";
            }

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
                                    <div class="col-span-6 mb-4 relative">
                                        <AppLabel label="Height" for="bmiHeight" />
                                        <AppInput name="bmiHeight" v-model="bmiHeight" />
                                        <span class="absolute font-bold top-8 right-4 text-gray-400"> {{ bmiUnit == "Metric Units" ? "cm" : "feet" }}</span>
                                    </div>
                                    <div v-if="bmiUnit == 'US Units'" class="col-span-6 mb-4 relative">
                                        <AppLabel class="opacity-0" label="Height" for="bmiHeight2" />
                                        <AppInput name="bmiHeight2" v-model="bmiHeight2" />
                                        <span class="absolute font-bold top-8 right-4 text-gray-400"> {{ bmiUnit == "Metric Units" ? "cm" : "inches" }}</span>
                                    </div>
                                    <div :class="bmiUnit == 'Metric Units' ? 'col-span-6' : 'col-span-12'" class="mb-4 relative">
                                        <AppLabel label="Weight" for="bmiWeight" />
                                        <AppInput name="bmiWeight" v-model="bmiWeight" />
                                        <span class="absolute font-bold top-8 right-4 text-gray-400"> {{ bmiUnit == "Metric Units" ? "kg" : "pounds" }}</span>
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

                                    <div class="col-span-12 font-semibold text-6xl mt-8 mb-2">{{ bmiResult }}</div>

                                    <div :class="bmiResultClass" class="col-span-12 text-2xl mb-8">{{ bmiResultDescription }}</div>

                                    <div class="col-span-12 mt-2 mb-2">
                                        <hr class="border-gray-300" />
                                    </div>
                                    <div class="col-span-12 text-sm">
                                        <ul>
                                            <li>Underweight BMI range: &lt; 18.5</li>
                                            <li>Healthy BMI range: 18.5 - 25</li>
                                            <li>Overweight BMI range: 25 - 30</li>
                                            <li>Obese BMI range: > 30</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </AppWhiteContainer>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-12">
                <div class="col-span-12">
                    <div>
                        <AppH2>BMI explanation</AppH2>
                    </div>

                    <div>
                        <AppText>
                            The Body Mass Index (BMI) Calculator above can be used to calculate your BMI and corresponding weight status while also considering the age. Use the "Metric Units" option
                            for the International System of Units or the "US Units" option to convert units into US units.
                        </AppText>
                    </div>

                    <div class="mt-6">
                        <AppH2>Results Explanation</AppH2>
                    </div>

                    <div>
                        <AppH3>Underweight</AppH3>
                    </div>

                    <div>
                        <AppText> This could be a sign you're not eating enough or you may be ill. If you're underweight, sicking advise from a GP can help. </AppText>
                    </div>

                    <div>
                        <AppH3>Healthy weight</AppH3>
                    </div>

                    <div>
                        <AppText> Nicely done, keep up the great work! </AppText>
                    </div>

                    <div>
                        <AppH3>Overweight</AppH3>
                    </div>

                    <div>
                        <AppText>A combination of diet and exercise could help you to lose weight if you're overweight. </AppText>
                    </div>

                    <div>
                        <AppH3>Obese</AppH3>
                    </div>

                    <div>
                        <AppText>If you're obese, a combination of diet and exercise, and, in some cases, medicines could help you to lose weight. Seek medical advise and help from a GP. </AppText>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
