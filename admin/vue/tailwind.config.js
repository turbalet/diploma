module.exports = {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      keyframes: {
        'fade-in-down': {
          "from": {
            transform: "translateY(-0.75rem)",
            opacity: '0'
          },
          "to": {
            transform: "translateY(0rem)",
            opacity: '1'
          },
        },
      },
      animation: {
        'fade-in-down': "fade-in-down 0.2s ease-in-out both",
        'spin-slow': 'spin 5s linear infinite',
        'spin-mid': 'spin 3s linear infinite',
      },
      colors: {
        secondary: '#2A2D3E',
        primary: '#212332',
        light: '#C2C5D7',
        input: '#393B49',
      },
    },
  },
  plugins: [require("@tailwindcss/forms")],
};
