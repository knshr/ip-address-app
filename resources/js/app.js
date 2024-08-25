import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { Quasar } from "quasar";
import { createPinia } from "pinia";
import quasarIconSet from "quasar/icon-set/mdi-v7";

// Import icon libraries
import "@quasar/extras/roboto-font/roboto-font.css";
import "@quasar/extras/mdi-v7/mdi-v7.css";

// Import Quasar css
import "quasar/src/css/index.sass";

// Import Internationalization
import { i18nVue } from "laravel-vue-i18n";

// Layouts
import AppLayout from "../vue/layouts/App.vue";
import AuthLayout from "../vue/layouts/Auth.vue";

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
            .use(createPinia())
            .use(Quasar, {
                plugins: {},
                iconSet: quasarIconSet,
            })
            .use(i18nVue, {
                resolve: async (lang) => {
                    const langs = import.meta.glob("../lang/*.json");
                    return await langs[`../lang/${lang}.json`]();
                },
            })
            .component("AppLayout", AppLayout)
            .component("AuthLayout", AuthLayout)
            .mount(el);
    },
});
