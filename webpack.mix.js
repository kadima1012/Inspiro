const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

// Importă Bootstrap și TailwindCSS
mix.js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap.js')
   .js('resources/js/app.js', 'public/js')
   .js('resources/js/script.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       tailwindcss('./tailwind.config.js'),
       //'node_modules/bootstrap/dist/css/bootstrap.css',
   ]);

if (mix.inProduction()) {
    mix.version();
}
