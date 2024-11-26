/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',  
    './resources/js/**/*.vue',          
    './resources/css/**/*.css',        
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Roboto"', 'sans-serif'], 
      },
    },
  },
  plugins: [],
};