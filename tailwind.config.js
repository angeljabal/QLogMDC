const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php'
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.amber,
      cyan: colors.cyan,
      teal: colors.teal,
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
