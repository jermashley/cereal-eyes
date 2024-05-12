import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import posthog from 'posthog-js'
import { createApp, h } from 'vue'

import { ZiggyVue } from '../../vendor/tightenco/ziggy'

const appName = import.meta.env.VITE_APP_NAME || `Cereal Eyes`

if (import.meta.env.APP_ENV === `production`) {
  posthog.init(`phc_5xZgAN1Xse3EySw6p5hci2IyKvV3jWb0nfeSqNnrybz`, {
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
      .mount(el)
  },
  progress: {
    color: `#4B5563`,
  },
})
