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

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);

const loanAmount = ref(5000);
const loanDurationType = ref("months");
const loanDuration = ref(60);
const loanCurrency = ref("$");
const loanInterestRate = ref(4.5);

const honeypot = ref(null);
const loanMonthly = ref(null);
const loanTotal = ref(null);
const loanInterestPaid = ref(null);

const errorMessage = ref(null);
const processing = ref(false);

const options = ["months", "years"];
const currencyOptions = ["$", "€", "£"];

const mainStore = useMainStore();

onMounted(() => {
    calculateLoan();
});

const calculateLoan = _.debounce(() => {
    errorMessage.value = "";
    processing.value = true;

    axios
        .post(route("tools.loan-calculator.calculate"), {
            loanAmount: loanAmount.value,
            loanDuration: loanDuration.value,
            loanDurationType: loanDurationType.value,
            loanInterestRate: loanInterestRate.value,
            honeypot: honeypot.value,
        })
        .then((response) => {
            loanMonthly.value = response.data.loanMonthly;
            loanInterestPaid.value = response.data.loanInterestPaid;
            loanTotal.value = response.data.loanTotal;
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
            mainStore.toastAppear("Could not calculate loan", "error");
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
                                    <div class="col-span-3 mb-4">
                                        <AppLabel label="Currency" for="loanCurrency" />
                                        <AppSelect :options="currencyOptions" name="loanCurrency" v-model="loanCurrency" />
                                    </div>
                                    <div class="col-span-9 mb-4">
                                        <AppLabel label="Loan amount" for="loanAmount" />
                                        <AppInput name="loanAmount" v-model="loanAmount" />
                                    </div>
                                    <div class="col-span-6 mb-4">
                                        <AppLabel label="Loan term" for="loanDuration" />
                                        <AppInput name="loanDuration" v-model="loanDuration" />
                                    </div>
                                    <div class="col-span-6 3 mb-4">
                                        <AppLabel label="in" for="loanDurationType" />
                                        <AppSelect :options="options" name="loanDurationType" v-model="loanDurationType" />
                                    </div>
                                    <div class="col-span-6 mb-4">
                                        <AppLabel label="Interest rate per year" for="loanInterestRate" />
                                        <AppInput icon="fal fa-percentage" name="loanInterestRate" v-model="loanInterestRate" />
                                    </div>
                                    <div class="col-span-6">
                                        <AppButtonPrimary extraClass="w-full" class="mt-6" v-if="!processing" @click="calculateLoan">CALCULATE</AppButtonPrimary>
                                        <AppLoader v-else class="mx-auto mt-8" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 font-semibold mt-8 md:mt-0">Monthly payments</div>
                                    <div class="col-span-12 mt-4 text-4xl mb-8 font-bold">{{ loanCurrency }} {{ loanMonthly }}</div>
                                    <div class="col-span-6 text-left">Total repayable</div>
                                    <div class="col-span-6 text-right">{{ loanCurrency }} {{ loanTotal }}</div>
                                    <div class="col-span-12 mt-2 mb-2">
                                        <hr class="border-gray-300" />
                                    </div>
                                    <div class="col-span-6 text-left">Total interest payable</div>
                                    <div class="col-span-6 text-right">{{ loanCurrency }} {{ loanInterestPaid }}</div>
                                </div>
                            </div>
                        </div>
                    </AppWhiteContainer>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
