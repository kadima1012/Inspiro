const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', 'sans-serif'],
      },
      colors: {
        primary: colors.amber,
        secondary: colors.slate,
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
};
