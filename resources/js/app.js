require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { createPinia } from "pinia";

import __debounce from "lodash";
import __remove from "lodash";

import "tw-elements";

createInertiaApp({
    title: (title) => `${title} - FreeOnlineTools`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(createPinia())
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#ff7b79" });
