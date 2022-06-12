<script setup>
import AppCard from "@/Shared/AppCard.vue";

defineProps({
    onlyPopular: String,
});
</script>
<template>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.loan-calculator.show')" icon="fal fa-piggy-bank" title="Loan Calculator" content="Determine the monthly payments on a loan"> </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.bmi-calculator.show')" icon="fal fa-balance-scale-right" title="BMI Calculator" content="Calculate Body Mass Index"> </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.lorem-ipsum.show')" icon="fal fa-align-left" title="Lorem Ipsum Generator" content="Generate dummy Lorem Ipsum text"> </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.internet-speed-test.show')" icon="fal fa-router" title="Internet Speed Test" content="Calculate your internet speed with our free bandwidth test"> </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.case-converter.to-uppercase.show')" icon="fal fa-text-size" title="Case Converters" content="Convert your text to lowercase, uppercase, sentence case or word case">
        </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.text-counter.lines-counter.show')" icon="fal fa-abacus" title="Text Counters" content="Count lines, sentences, words or characters"> </AppCard>
    </div>
    <div class="col-span-12 md:col-span-6 lg:col-span-4">
        <AppCard :url="route('tools.random-generator.random-number.show')" icon="fal fa-random" title="Random Generators" content="Generate random numbers, passwords, words or sentences"> </AppCard>
    </div>
</template>
