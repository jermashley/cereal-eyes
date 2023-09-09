const { fontFamily } = require(`tailwindcss/defaultTheme`)

/** @type {import('tailwindcss').Config} */
export default {
  content: [`./resources/**/*.blade.php`, `./resources/**/*.{js,ts,jsx,tsx}`],
  theme: {
    extend: {
      fontFamily: {
        sans: [`Inter`, ...fontFamily.sans],
        mono: [`JetBrains Mono`, ...fontFamily.mono],
      },
    },
  },
  plugins: [],
}
