/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "selector",
    content: [
      "./resources/**/*.blade.php",
      "./public/**/*.js",
       "./src/**/*.{html,js}",
        "./node_modules/tw-elements/js/**/*.js"
    ],
    safelist: [
      'bg-red-700',
      'bg-red-500',
      'bg-yellow-500',
      'bg-yellow-300',
      'bg-green-600',

    ],
    theme: {
      extend: {},
      screens: {
        'xs':'375px',
        'xs-md':'425px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
      }
    },
    plugins: ["tailwindcss ,autoprefixer ,aspectRatio, forms ,typography", require("tw-elements/plugin.cjs")],
  }

