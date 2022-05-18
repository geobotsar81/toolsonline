<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppH1 from "@/Shared/AppH1.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary";
import AppInput from "@/Shared/Form/AppInput";
import AppTextarea from "@/Shared/Form/AppTextarea";
import AppError from "@/Shared/Form/AppError";
import AppSuccess from "@/Shared/Form/AppSuccess";

import { usePage, useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

const publicUrl = computed(() => usePage().props.value.publicUrl);
const pageMeta = computed(() => usePage().props.value.pageMeta);

const form = useForm({
    contactName: null,
    contactEmail: null,
    contactMessage: null,
    honeypot: null,
});

const formSuccess = ref(false);

function submitForm() {
    formSuccess.value = false;
    form.submit("post", route("contact.send"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset("contactName");
            form.reset("contactEmail");
            form.reset("contactMessage");
            formSuccess.value = true;
        },
    });
}
</script>

<template>
    <AppLayout :title="pageMeta.title" :description="pageMeta.description" :url="pageMeta.url">
        <div class="container py-8">
            <div class="text-center">
                <AppH1>Contact us</AppH1>
            </div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Eiusmod tempor incididunt ut labore.</AppSubtitle>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-8">
                <div class="col-span-12 md:col-span-8 md:col-start-3 text-center">
                    <form name="contacForm" @submit.prevent="submitForm">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12 text-center">
                                <input type="hidden" name="honeypot" v-model="form.honeypot" />
                                <AppError v-if="form.errors.honeypot" class="text-left">
                                    {{ form.errors.honeypot }}
                                </AppError>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppInput placeholder="Name" name="form.contactName" v-model="form.contactName" />
                                <AppError v-if="form.errors.contactName" class="text-left">
                                    {{ form.errors.contactName }}
                                </AppError>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppInput placeholder="Email" name="contactEmail" v-model="form.contactEmail" />
                                <AppError v-if="form.errors.contactEmail" class="text-left">
                                    {{ form.errors.contactEmail }}
                                </AppError>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppTextarea placeholder="Message" name="contactMessage" v-model="form.contactMessage" />
                                <AppError v-if="form.errors.contactMessage" class="text-left">
                                    {{ form.errors.contactMessage }}
                                </AppError>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppButtonPrimary type="submit" class="buttonRed" v-if="!form.processing"> SEND </AppButtonPrimary>
                                <img class="mx-auto" :src="publicUrl + '/assets/img/LoaderIcon.gif'" v-if="form.processing" />
                            </div>

                            <div class="col-span-12 text-center mt-2" v-if="formSuccess">
                                <AppSuccess> Your message has been successfully sent! </AppSuccess>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
