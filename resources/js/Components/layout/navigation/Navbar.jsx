import { Link, usePage } from '@inertiajs/react'

import { UserNavigationMenu } from './UserNavigationMenu'

export const Navbar = () => {
  const {
    app: { name: appName },
  } = usePage().props

  const navLinks = [
    {
      name: `Dashboard`,
      href: `/`,
    },
  ]

  return (
    <nav className="sticky top-0 z-10 w-full border-b border-b-zinc-200/50 bg-zinc-100/75 backdrop-blur-md backdrop-brightness-125 backdrop-saturate-150 dark:border-b-zinc-700/50 dark:bg-zinc-800/75">
      <div className="mx-auto flex w-full max-w-2xl flex-row items-center justify-start px-4 py-4 md:px-0">
        <a href="/" className="text-base font-bold">
          {appName}
        </a>

        <div className="ml-auto flex flex-row items-center justify-end">
          {navLinks.map((link) => (
            <Link
              key={`${link.name}_NavbarLink`}
              href={link.href}
              className="rounded bg-transparent px-4 py-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75"
            >
              {link.name}
            </Link>
          ))}
        </div>

        <UserNavigationMenu />
      </div>
    </nav>
  )
}
