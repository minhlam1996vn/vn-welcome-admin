import { defineConfig } from 'vite';
import { viteStaticCopy } from 'vite-plugin-static-copy'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/js/admin.js',
                    dest: 'js'
                },
                {
                    src: [
                        'resources/css/admin.css',
                        'resources/css/custom.css',
                        'resources/css/content-styles.css'
                    ],
                    dest: 'css'
                },
            ]
        })
    ],
});
