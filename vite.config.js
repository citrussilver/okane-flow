import { defineConfig } from 'vite';
import { resolve, join } from 'path';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: [
            // { find: "@/", replacement: path.resolve(__dirname, "./resources/js/") }
            { find: "@/", replacement: join(resolve(__dirname, './resources/js/'), "$1") }
        ]
    }
});
