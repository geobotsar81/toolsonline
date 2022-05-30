import { defineStore } from "pinia";

// main is the name of the store. It is unique across your application
// and will appear in devtools
export const useMainStore = defineStore("main", {
    // a function that returns a fresh state
    state: () => ({
        toastShow: false,
        toastMessage: "",
        toastType: "",
    }),
    // optional getters
    getters: {},
    // optional actions
    actions: {
        toastAppear(message, type) {
            this.toastShow = true;
            this.toastMessage = message;
            this.toastType = type;

            setTimeout(() => this.toastHide(), 2000);
        },
        toastHide() {
            this.toastShow = false;
        },
    },
});
