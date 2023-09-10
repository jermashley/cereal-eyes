import { createInertiaApp } from '@inertiajs/react'
import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'

import { AppContextProvider } from '@/contexts/AppContextProvider'
import { AuthenticatedLayout } from '@/layouts/AuthenticatedLayout'
import { PublicLayout } from '@/layouts/PublicLayout'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob(`./pages/**/*.jsx`, { eager: true })

    let page = pages[`./pages/${name}.jsx`]

    page.default.layout = name.startsWith(`public/`)
      ? (page) => (
          <AppContextProvider>
            <PublicLayout>{page}</PublicLayout>
          </AppContextProvider>
        )
      : (page) => (
          <AppContextProvider>
            <AuthenticatedLayout>{page}</AuthenticatedLayout>
          </AppContextProvider>
        )

    return page
  },
  setup({ el, App, props }) {
    createRoot(el).render(
      <StrictMode>
        <App {...props} />
      </StrictMode>,
    )
  },
})
