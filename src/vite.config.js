import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                /* lib */
                {
                    src: [
                        'resources/css/lib/[!.]*',
                    ],
                    dest: 'css/lib'
                },
                {
                    src: [
                        'resources/js/lib/[!.]*',
                    ],
                    dest: 'js/lib'
                },
                /* css */
                {
                    src: [
                        'resources/css/admin.css',
                        'resources/css/custom.css',
                    ],
                    dest: 'css'
                },
                /* js */
                {
                    src: [
                        'resources/js/admin.js',
                    ],
                    dest: 'js'
                },

            ]
        })
    ],
});
