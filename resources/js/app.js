import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { Quasar } from "quasar";
import { createPinia } from "pinia";

// Import icon libraries
import "@quasar/extras/roboto-font/roboto-font.css";
import "@quasar/extras/mdi-v7/mdi-v7.css";

// Import Quasar css
import "quasar/src/css/index.sass";

// Import Internationalization
import { createI18n } from "vue-i18n";
import Locale from "./vue-i18n-locales.generated.js";

const language = document.documentElement.lang.substring(0, 2);
const i18n = createI18n({
    locale: language,
    allowComposition: true,
    message: Locale,
});

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("../vue/Pages/**/*.vue", {
            eager: true,
        });
        return pages[`../vue/Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .use(createPinia())
            .use(Quasar, {
                plugins: {},
            })
            .mount(el);
    },
});
