/*import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';
//import mkcert from 'vite-plugin-mkcert'
export default defineConfig({
    //server: { https: true },
    server: {  host: 'landi.by', },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        ckeditor5( { theme: require.resolve( '@ckeditor/ckeditor5-theme-lark' ) } ),
        //mkcert()
    ],
});*/

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss', // легаси-монолит старого сайта (Bootstrap и пр.)
            'resources/css/app.css',   // глобальные стили редизайна 2026 (source of truth)
            'resources/js/app.js',
        ]),
    ],
});
