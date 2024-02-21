/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
    },
  },
  plugins: [],
  variants: {
    backgroundCOlor: ['dark','dark-hover','dark-group-hover','dark-even', 'dark-odd'],
  },
  darkMode: 'class',
}