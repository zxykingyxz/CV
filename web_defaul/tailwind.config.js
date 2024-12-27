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
    // npx tailwindcss -i ./i-web/css/admin_input.css -o ./i-web/css/admin_output.css --watch

    // content: [
    //     "./i-web/index.{html,js,php}",
    // ],
    theme: {
        extend: {
            animation: {
                'load-captcha': 'radius 1s linear infinite',
            }
        },
    },
    plugins: [

    ],
}