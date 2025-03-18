/** @type {import('tailwindcss').Config} */
module.exports = {
    // npx tailwindcss -i ./assets/css/tailwind/input.css -o ./assets/css/tailwind/output.css --watch

    content: [
        "./templates/layouts/**/*.{html,js,php}",
        "./templates/**/*.{html,js,php}",
        "./ajax/*.{html,js,php}",
        "./views/**/*.{html,js,php}",
        "./sources/*.{html,js,php}",
    ],

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