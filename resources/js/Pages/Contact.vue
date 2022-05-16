<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import AppH2 from "@/Shared/AppH2.vue";
import AppSubtitle from "@/Shared/AppSubtitle.vue";

import AppButtonPrimary from "@/Shared/AppButtonPrimary";

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
            <div class="text-center"><AppH2>Contact us</AppH2></div>
            <div class="grid grid-cols-12 text-center">
                <div class="col-span-12 md:col-span-8 md:col-start-3">
                    <AppSubtitle>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. Eiusmod tempor incididunt ut labore.</AppSubtitle>
                </div>
            </div>

            <form name="contacForm" @submit.prevent="submitForm">
                <div class="grid grid-cols-12 mt-8">
                    <div class="col-span-12 text-center">
                        <input type="hidden" name="honeypot" v-model="form.honeypot" />
                        <div v-if="form.errors.honeypot" class="formError">
                            {{ form.errors.honeypot }}
                        </div>
                    </div>

                    <div class="col-span-12 text-center mt-2">
                        <input placeholder="Name" name="contactName" type="text" class="form-control" v-model="form.contactName" />
                        <div v-if="form.errors.contactName" class="formError">
                            {{ form.errors.contactName }}
                        </div>
                    </div>

                    <div class="col-span-12 text-center mt-2">
                        <input placeholder="Email" name="contactEmail" type="text" class="form-control" v-model="form.contactEmail" />
                        <div v-if="form.errors.contactEmail" class="formError">
                            {{ form.errors.contactEmail }}
                        </div>
                    </div>

                    <div class="col-span-12 text-center mt-2">
                        <textarea placeholder="Message" class="form-control" name="contactMessage" v-model="form.contactMessage"></textarea>
                        <div v-if="form.errors.contactMessage" class="formError">
                            {{ form.errors.contactMessage }}
                        </div>
                    </div>

                    <div class="col-span-12 text-center">
                        <AppButtonPrimary type="submit" class="buttonRed" v-if="!form.processing"> SEND </AppButtonPrimary>
                        <img :src="publicUrl + '/assets/img/LoaderIcon.gif'" v-if="form.processing" />
                    </div>

                    <div class="col-span-12 text-center" v-if="formSuccess">
                        <div class="alert alert-success">Your message has been successfully sent!</div>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
