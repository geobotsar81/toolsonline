require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { createPinia } from "pinia";

import * as Sentry from "@sentry/vue";
import { BrowserTracing } from "@sentry/tracing";

import __debounce from "lodash";
import __remove from "lodash";

import "tw-elements";
createInertiaApp({
    title: (title) => `${title} - FreeOnlineTools`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const myApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(createPinia())
            .mixin({ methods: { route } });

        Sentry.init({
            myApp,
            dsn: "https://86d34c7bb40a4f59b595e15c33e15cb4@o1128328.ingest.sentry.io/6462354",
            integrations: [new BrowserTracing()],
            // Set tracesSampleRate to 1.0 to capture 100%
            // of transactions for performance monitoring.
            // We recommend adjusting this value in production
            tracesSampleRate: 1.0,
        });

        myApp.mount(el);
        return myApp;
    },
});

InertiaProgress.init({ color: "#ff7b79" });
