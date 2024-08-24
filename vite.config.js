import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import { quasar, transformAssetUrls } from "@quasar/vite-plugin";
import i18n from "laravel-vue-i18n/vite";

export default defineConfig({
    plugins: [
        // Backend Framework
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        //Frontend Framework
        vue({
            template: { transformAssetUrls },
        }),
        // Frontend Design Framework
        quasar({
            sassVariables: "resources/sass/quasar-variables.sass",
        }),
        // Internationalization (i18n)
        i18n(),
    ],
});
