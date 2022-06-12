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

import { useMainStore } from "@/Stores/mainStore";

import { ref, computed, watch, onMounted } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const pageMeta = computed(() => usePage().props.value.pageMeta);
const publicUrl = computed(() => usePage().props.value.publicUrl);

const errorMessage = ref(null);
const processing = ref(false);

const mainStore = useMainStore();
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
                        <iframe class="mt-12" :src="publicUrl + '/assets/librespeed/index.html'" width="100%" height="500"></iframe>
                    </AppWhiteContainer>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style>
#startStopBtn {
    display: inline-block;
    margin: 0 auto;
    color: #6060aa;
    background-color: rgba(0, 0, 0, 0);
    border: 0.15em solid #6060ff;
    border-radius: 0.3em;
    transition: all 0.3s;
    box-sizing: border-box;
    width: 8em;
    height: 3em;
    line-height: 2.7em;
    cursor: pointer;
    box-shadow: 0 0 0 rgba(0, 0, 0, 0.1), inset 0 0 0 rgba(0, 0, 0, 0.1);
}
#startStopBtn:hover {
    box-shadow: 0 0 2em rgba(0, 0, 0, 0.1), inset 0 0 1em rgba(0, 0, 0, 0.1);
}
#startStopBtn.running {
    background-color: #ff3030;
    border-color: #ff6060;
    color: #ffffff;
}
#startStopBtn:before {
    content: "Start";
}
#startStopBtn.running:before {
    content: "Abort";
}
#test {
    margin-top: 2em;
    margin-bottom: 12em;
}
div.testArea {
    display: inline-block;
    width: 16em;
    height: 12.5em;
    position: relative;
    box-sizing: border-box;
}
div.testArea2 {
    display: inline-block;
    width: 14em;
    height: 7em;
    position: relative;
    box-sizing: border-box;
    text-align: center;
}
div.testArea div.testName {
    position: absolute;
    top: 0.1em;
    left: 0;
    width: 100%;
    font-size: 1.4em;
    z-index: 9;
}
div.testArea2 div.testName {
    display: block;
    text-align: center;
    font-size: 1.4em;
}
div.testArea div.meterText {
    position: absolute;
    bottom: 1.55em;
    left: 0;
    width: 100%;
    font-size: 2.5em;
    z-index: 9;
}
div.testArea2 div.meterText {
    display: inline-block;
    font-size: 2.5em;
}
div.meterText:empty:before {
    content: "0.00";
}
div.testArea div.unit {
    position: absolute;
    bottom: 2em;
    left: 0;
    width: 100%;
    z-index: 9;
}
div.testArea2 div.unit {
    display: inline-block;
}
div.testArea canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}
div.testGroup {
    display: block;
    margin: 0 auto;
}
@media all and (max-width: 40em) {
    body {
        font-size: 0.8em;
    }
}
</style>
