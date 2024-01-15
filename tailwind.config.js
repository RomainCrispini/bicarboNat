/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        transparent: "transparent",
        current: "currentColor",
        black: "#000",
        white: "#fff",
        gray: colors.gray,
        red: colors.red,
        orange: colors.orange,
        amber: colors.amber,
        yellow: colors.yellow,
        lime: colors.lime,
        green: colors.green,
        emerald: colors.emerald,
        teal: colors.teal,
        cyan: colors.cyan,
        sky: colors.sky,
        blue: colors.blue,
        indigo: colors.indigo,
        violet: colors.violet,
        purple: colors.purple,
        fuchsia: colors.fuchsia,
        pink: colors.pink,
        rose: colors.rose,

      }
    },
  },
  plugins: [],
}