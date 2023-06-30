import { createInertiaApp } from '@inertiajs/vue3'
import { VueQueryPlugin } from '@tanstack/vue-query'
import { createApp, h } from 'vue'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PublicLayout from '@/Layouts/PublicLayout.vue'

createInertiaApp({
  title: (title) => {
    const appName = import.meta.env?.VITE_APP_NAME ?? `Onboarder`

    return `${title} - ${appName}`
  },
  resolve: (name) => {
    const pages = import.meta.glob(`./Pages/**/*.vue`, { eager: true })
    let page = pages[`./Pages/${name}.vue`]

    page.default.layout = name.startsWith(`Public/`)
      ? PublicLayout
      : AuthenticatedLayout

    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(VueQueryPlugin)
      .mount(el)
  },
})
