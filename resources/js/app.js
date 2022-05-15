require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

import { createVuetify } from "vuetify";
//import "vuetify/styles"; // Global CSS has to be imported
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
//import "@mdi/font/css/materialdesignicons.css";

const appName = window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const vuetify = createVuetify({
    components,
    directives,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(vuetify)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
