import { createInertiaApp } from '@inertiajs/vue3'
import { VueQueryPlugin } from '@tanstack/vue-query'
import { devtools } from '@vue/devtools'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import posthog from 'posthog-js'
import { createApp, h } from 'vue'

import { ZiggyVue } from '../../vendor/tightenco/ziggy'

const appName = import.meta.env.VITE_APP_NAME || `Cereal Eyes`

if (import.meta.env.VITE_ENVIRONMENT === `local`) {
  devtools.connect(import.meta.env.VITE_APP_URL)
}

if (import.meta.env.VITE_APP_ENV === `production`) {
  posthog.init(import.meta.env.VITE_POSTHOG_TOKEN, {
    api_host: `https://us.i.posthog.com`,
  })
}

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob(`./Pages/**/*.vue`),
    ),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(VueQueryPlugin)
      .mount(el)
  },
  progress: {
    color: `#4B5563`,
  },
})
