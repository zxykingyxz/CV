/** @type {import('tailwindcss').Config} */
module.exports = {
    // ---------- web ---------
    // corePlugins: {
    //     preflight: false,
    // },
    // npx tailwindcss -i ./assets/css/tailwind/input.css -o ./assets/css/tailwind/output.css --watch
    content: [
        "./views/**/*.{html,js,php}",
        "./templates/**/*.{html,js,php}",
        "./ajax/**/*.{html,js,php}",
        "./sources/auth.php",
        "./sources/warehouse/**/*.{html,js,php}",
        "./libraries/functions.php",
        "./libraries/cartFrontEnd.php",
    ],
    // --------- Admin ---------
    // npx tailwindcss -i ./i-web/assets/css/tailwind/input.css -o ./i-web/assets/css/tailwind/output.css --watch

    // content: [
    //     "./i-web/templates/layouts/**/*.{html,js,php}",
    //     "./i-web/templates/**/*.{html,js,php}",
    //     "./i-web/ajax/*.{html,js,php}",
    //     "./i-web/views/**/*.{html,js,php}",
    //     "./i-web/sources/*.{html,js,php}",
    // ],

    theme: {
        extend: {
            animation: {
                'load-captcha': 'radius 1s linear infinite',
                'load-captcha-reverse': 'radius-reverse 1s linear infinite',
            }
        },
    },
    plugins: [

    ],
}