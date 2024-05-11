// import basicSsl from '@vitejs/plugin-basic-ssl'
import vue from '@vitejs/plugin-vue'
import fs from 'fs'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import { defineConfig } from 'vite'

const user = `jermashley`
const host = `cereal-eyes.test`

export default defineConfig({
  server: {
    host,
    hmr: {
      host,
    },
    https: {
      key: fs.readFileSync(
        `/Users/${user}/Library/Application Support/Herd/config/valet/Certificates/${host}.key`,
      ),
      cert: fs.readFileSync(
        `/Users/${user}/Library/Application Support/Herd/config/valet/Certificates/${host}.crt`,
      ),
    },
  },
  plugins: [
    laravel({
      input: [`resources/css/app.css`, `resources/js/app.js`],
      detectTls: host,
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
