module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                gray: {
                    50: '#f4f4f5',  // Zinc 50
                    100: '#e4e4e7', // Zinc 100
                    200: '#d4d4d8', // Zinc 200
                    300: '#a1a1aa', // Zinc 300
                    400: '#71717a', // Zinc 400
                    500: '#52525b', // Zinc 500
                    600: '#3f3f46', // Zinc 600
                    700: '#27272a', // Zinc 700
                    800: '#18181b', // Zinc 800
                    900: '#0a0a0a', // Zinc 900
                },
            },
        },
    },
    plugins: [
        require('flowbite/plugin')({
            datatables: true,
        }),
    ],
}