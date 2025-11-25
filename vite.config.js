import tailwindcss from "@tailwindcss/vite";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/header.css",
                "resources/css/bannerBusqueda.css",
                "resources/css/comunidades.css",
                "resources/css/repositoriosPagination.css",
                "resources/css/herramientaCard.css",
                "resources/css/footer.css",
                "resources/css/carpetaCard.css",
                "resources/js/app.js",
                "resources/js/templatesComponents/carpetaCardTemplate.js",
                "resources/css/pdfs.css",
                "resources/css/tool__info.css"
            ],
            refresh: true,
        }),

        tailwindcss(),
    ],
});
