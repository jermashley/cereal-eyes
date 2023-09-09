import { Navbar } from '@/Components/UI/Navigation'

import { DefaultLayout } from './DefaultLayout'

export const AuthenticatedLayout = ({ children }) => {
  return (
    <DefaultLayout>
      <Navbar />

      <main
        id="AuthenticatedLayout"
        className="mx-auto flex w-full max-w-2xl flex-grow flex-col px-4 md:px-0"
      >
        {children}
      </main>
    </DefaultLayout>
  )
}
