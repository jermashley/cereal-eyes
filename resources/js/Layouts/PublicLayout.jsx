import { DefaultLayout } from './DefaultLayout'

export const PublicLayout = ({ children }) => {
  return (
    <DefaultLayout>
      <main className="flex w-full flex-grow flex-col px-4 md:px-0">
        {children}
      </main>
    </DefaultLayout>
  )
}
