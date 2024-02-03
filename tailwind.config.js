import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import animate from "tailwindcss-animate";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.{jsx,tsx}",
    ],

    theme: {
        extend: {
            colors: {
                primary: "#0081c6",
                "primary-dark": "#005989",
                backdrop: "rgba(0, 0, 0, 0.3)",
            },

            spacing: {
                22: "5.5rem",
                32: "8rem",
                70: "17.5rem",
                175: "43.75rem",
            },

            maxWidth: {
                main: "68.5rem",
            },

            fontFamily: {
                sans: ["Fixel", ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                xxs: ["0.625rem", { lineHeight: "1rem" }],
            },

            boxShadow: {
                post: "4px 4px 15px 0 rgba(36, 37, 38, 0.08)",
                dialog: "3px 4px 15px 0 rgba(36, 37, 38, 0.08)",
            },
        },
    },

    safelist: ["ProseMirror"],
    plugins: [animate, typography, forms],
    darkMode: "class",
};
