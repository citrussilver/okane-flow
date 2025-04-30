import { defineConfig } from 'vite';
import { resolve, join } from 'path';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import ClosePlugin from './vite-plugin-close.ts';

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
        ClosePlugin()
    ],
    build: {
        watch: false,
        rollupOptions: {
          watch: false,
          treeshake: false,
          preserveEntrySignatures: true,
          output: {
            dynamicImportInCjs: false,
          }
        }
    },
    resolve: {
        alias: [
            // { find: "@/", replacement: path.resolve(__dirname, "./resources/js/") }
            { find: "@/", replacement: join(resolve(__dirname, './resources/js/'), "$1") }
        ]
    }
});
