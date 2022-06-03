module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'criteria': "url('./src/assets/criteria-bg.svg')"
      }
    },
  },
  plugins: [],
}