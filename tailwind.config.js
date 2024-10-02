module.exports = {
  content: [
    './src/**/*.{html,js,php}', // Incluye todos los archivos en la carpeta src
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('preline/plugin'),
  ],
}