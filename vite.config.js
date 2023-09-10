import basicSsl from '@vitejs/plugin-basic-ssl'
import react from '@vitejs/plugin-react'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import { defineConfig } from 'vite'

export default defineConfig({
  server: {
    https: true,
    // host: `local.kellby.me`,
  },
  plugins: [
    basicSsl(),
    laravel({
      input: [`resources/css/app.css`, `resources/js/app.jsx`],
      refresh: true,
    }),
    react({
      babel: {
        plugins: [
          `@babel/plugin-syntax-dynamic-import`,
          // `babel-plugin-styled-components`,
        ],
      },
    }),
  ],
  resolve: {
    alias: {
      'tailwind.config.js': path.resolve(__dirname, `tailwind.config.js`),
      '@/components': `/resources/js/components`,
      '@/contexts': `/resources/js/contexts`,
      '@/layouts': `/resources/js/layouts`,
      '@/pages': `/resources/js/pages`,
      '@/lib': `/resources/js/lib`,
      '@/styles': `/resources/js/styles`,
      '@/hooks': `/resources/js/composables/hooks`,
      '@/mutations': `/resources/js/composables/mutations`,
      '@/queries': `/resources/js/composables/queries`,
    },
  },
  optimizeDeps: {
    include: `tailwind.config.js`,
  },
  build: {
    commonjsOptions: {
      include: [`tailwind.config.js`, `node_modules/**`],
      // transformMixedEsModules: true,
    },
  },
})
