import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                inter: ['"Inter"', "sans-serif"],
            },
            fontWeight: {
                300: "300",
                400: "400",
                500: "500",
                600: "600",
                700: "700",
                800: "800",
            },
        },
    },

    plugins: [forms, require("tailwind-scrollbar")],
};
