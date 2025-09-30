import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                // Mengganti font default dari Figtree menjadi Nunito
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            // Menambahkan palet warna 'primary' baru dengan nuansa pink
            colors: {
                primary: {
                    // Pink (sudah ada)
                    50: "#fff1f2",
                    100: "#ffe4e6",
                    200: "#fecdd3",
                    300: "#fda4af",
                    400: "#fb7185",
                    500: "#f43f5e",
                    600: "#e11d48",
                    700: "#be123c",
                    800: "#9f1239",
                    900: "#881337",
                    950: "#4c0519",
                },
                // TAMBAHKAN DUA PALET DI BAWAH INI
                "pastel-yellow": {
                    100: "#fef9c3",
                    600: "#ca8a04",
                    900: "#78350f",
                },
                "pastel-teal": {
                    100: "#ccfbf1",
                    600: "#0d9488",
                    900: "#134e4a",
                },
            },
        },
    },

    plugins: [forms],
};
