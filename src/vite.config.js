import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/admin.css', // https://demo.adminkit.io
                'resources/css/custom.css',
                'resources/js/admin.js',
            ],
            refresh: true,
        }),
    ],
});
