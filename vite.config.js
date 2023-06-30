import basicSsl from '@vitejs/plugin-basic-ssl'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import { defineConfig } from 'vite'
import eslintPlugin from 'vite-plugin-eslint'

export default defineConfig({
  server: {
    https: true,
  },
  plugins: [
    eslintPlugin(),
    basicSsl(),
    laravel({
      input: [`resources/css/app.css`, `resources/js/app.js`],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
  resolve: {
    alias: {
      'tailwind.config.js': path.resolve(__dirname, `tailwind.config.js`),
      '@': `/resources/js`,
    },
  },
})
