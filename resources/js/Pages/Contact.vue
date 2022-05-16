<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import AppH1 from "@/Shared/AppH1.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";
import AppButtonPrimary from "@/Shared/AppButtonPrimary";
import AppInput from "@/Shared/Form/AppInput";
import AppTextarea from "@/Shared/Form/AppTextarea";

import { usePage, useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

const publicUrl = computed(() => usePage().props.value.publicUrl);

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
    <AppLayout title="Contact us">
        <div class="container py-8">
            <div class="text-center"><AppH1>Contact us</AppH1></div>
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
                                <div v-if="form.errors.honeypot" class="formError">
                                    {{ form.errors.honeypot }}
                                </div>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppInput placeholder="Name" name="contactName" v-model="form.contactName" />
                                <div v-if="form.errors.contactName" class="formError">
                                    {{ form.errors.contactName }}
                                </div>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppInput placeholder="Email" name="contactEmail" v-model="form.contactEmail" />
                                <div v-if="form.errors.contactEmail" class="formError">
                                    {{ form.errors.contactEmail }}
                                </div>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppTextarea placeholder="Message" name="contactMessage" v-model="form.contactMessage" />
                                <div v-if="form.errors.contactMessage" class="formError">
                                    {{ form.errors.contactMessage }}
                                </div>
                            </div>

                            <div class="col-span-12 text-center mt-2">
                                <AppButtonPrimary type="submit" class="buttonRed" v-if="!form.processing"> SEND </AppButtonPrimary>
                                <img :src="publicUrl + '/assets/img/LoaderIcon.gif'" v-if="form.processing" />
                            </div>

                            <div class="col-span-12 text-center" v-if="formSuccess">
                                <div class="alert alert-success">Your message has been successfully sent!</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
