export default {
  darkMode: 'class', // required for Flowbite + Tailwind dark mode
  content: [
    './index.html',
    './src/**/*.{vue,js,ts}',
    './node_modules/flowbite/**/*.js'
  ],
  theme: {
    extend: {
      screens: {
        // iPhone12 portrait test
        'iphone-12': '390px',
        '3xl': '1600px', // custom breakpoint
      }
    }
  },
  plugins: [
    require('flowbite/plugin')
  ]
}