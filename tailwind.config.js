const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                black: "#333",
                gray: {
                    100: "#f8f8f8",
                    300: "#ddd",
                    900: "#555",
                },
                red: "#ff7b79",
                blue: "#3f4079",
                white: "#fff",
            },
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    corePlugins: {
        // ...
        container: false,
    },

    plugins: [
        ({ addComponents, theme }) => {
            addComponents({
                ".container": {
                    marginInline: "auto",
                    paddingInline: theme("spacing.4"),
                    maxWidth: "100%",

                    // Breakpoints
                    "@screen lg": {
                        maxWidth: 960,
                    },
                    "@screen xl": {
                        maxWidth: 1140,
                    },
                },
            });
        },
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
