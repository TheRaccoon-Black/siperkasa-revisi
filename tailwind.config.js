import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    safelist: [
        "animation-fade-in",
        "animation-fade-out",
        "animation-slide-right-to-left",
        "animation-slide-left-to-right",
        "animation-slide-top-to-bottom",
        "animation-slide-bottom-to-top",
        {
            pattern: /(blue|gray|red|green|pink|indigo|yellow|purple)-(.*)/,
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                text: ["Geist", "sans-serif"],
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                background: "hsl(0, 0%, 100%)",
                foreground: "hsl(240, 10%, 3.9%)",
                card: "hsl(0, 0%, 100%)",
                "card-foreground": "hsl(240, 10%, 3.9%)",
                popover: "hsl(0, 0%, 100%)",
                "popover-foreground": "hsl(240, 10%, 3.9%)",
                primary: "hsl(240, 5.9%, 10%)",
                "primary-foreground": "hsl(0, 0%, 98%)",
                secondary: "hsl(240, 4.8%, 95.9%)",
                "secondary-foreground": "hsl(240, 5.9%, 10%)",
                muted: "hsl(240, 4.8%, 95.9%)",
                "muted-foreground": "hsl(240, 3.8%, 46.1%)",
                accent: "hsl(240, 4.8%, 95.9%)",
                "accent-foreground": "hsl(240, 5.9%, 10%)",
                destructive: "hsl(0, 72.22%, 50.59%)",
                "destructive-foreground": "hsl(0, 0%, 98%)",
                border: "hsl(240, 5.9%, 90%)",
                input: "hsl(240, 5.9%, 90%)",
                ring: "hsl(240, 5%, 64.9%)",
                "chart-1": "hsl(12, 76%, 61%)",
                "chart-2": "hsl(173, 58%, 39%)",
                "chart-3": "hsl(197, 37%, 24%)",
                "chart-4": "hsl(43, 74%, 66%)",
                "chart-5": "hsl(27, 87%, 67%)",
                "sidebar-background": "hsl(0, 0%, 98%)",
                "sidebar-foreground": "hsl(240, 5.3%, 26.1%)",
                "sidebar-primary": "hsl(240, 5.9%, 10%)",
                "sidebar-primary-foreground": "hsl(0, 0%, 98%)",
                "sidebar-accent": "hsl(240, 4.8%, 95.9%);",
                "sidebar-accent": "hsl(240, 4.8%, 95.9%)",
                "sidebar-accent-foreground": "hsl(240, 5.9%, 10%)",
                "sidebar-border": "hsl(220, 13%, 91%)",
                "sidebar-ring": "hsl(240, 5%, 64.9%)",
                "red-primary": "hsl(0, 72.2%, 50.6%)",
                "red-primary-foreground": "hsl(0, 85.7%, 97.3%)",
                "red-secondary": "hsl(0, 0%, 96.1%)",
                "red-secondary-foreground": "hsl(0, 0%, 9%)",
            },
            borderRadius: {
                DEFAULT: "0.5rem",
            },
            animation: {
                "fade-in": "fadeIn 0.3 ease-in-out",
                "fade-out": "fadeOut 0.3s ease-in-out",
                "slide-right-to-left":
                    "slideRightToLeft 0.3s cubic-bezier(0.65, 0, 0.35, 1)",
                "slide-left-to-right":
                    "slideLeftToRight 0.3s cubic-bezier(0.65, 0, 0.35, 1)",
                "slide-top-to-bottom":
                    "slideTopToBottom 0.3s cubic-bezier(0.65, 0, 0.35, 1)",
                "slide-bottom-to-top":
                    "slideBottomToTop 0.3s cubic-bezier(0.65, 0, 0.35, 1)",
            },
            keyframes: {
                fadeIn: {
                    "0%": { opacity: "0" },
                    "100%": { opacity: "1" },
                },
                fadeOut: {
                    "0%": { opacity: "1" },
                    "100%": { opacity: "0" },
                },
                slideRightToLeft: {
                    "0%": { transform: "translateX(100%)", opacity: "0" },
                    "100%": { transform: "translateX(0)", opacity: "1" },
                },
                slideLeftToRight: {
                    "0%": { transform: "translateX(-100%)", opacity: "0" },
                    "100%": { transform: "translateX(0)", opacity: "1" },
                },
                slideTopToBottom: {
                    "0%": { transform: "translateY(-100%)", opacity: "0" },
                    "100%": { transform: "translateY(0)", opacity: "1" },
                },
                slideBottomToTop: {
                    "0%": { transform: "translateY(100%)", opacity: "0" },
                    "100%": { transform: "translateY(0)", opacity: "1" },
                },
            },
        },
    },

    plugins: [
        forms,
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
