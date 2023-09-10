import { faSignOut, faUser } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Menu, Transition } from '@headlessui/react'
import { router } from '@inertiajs/react'
import axios from 'axios'
import { Fragment } from 'react'

export const UserNavigationMenu = () => {
  return (
    <Menu as="div" className="relative z-10">
      {({ open }) => (
        <>
          <div>
            <Menu.Button
              className={`flex aspect-square flex-row items-center justify-center rounded p-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75 ${
                open ? `bg-zinc-200/75 dark:bg-zinc-700/75` : `bg-transparent`
              }`}
            >
              <FontAwesomeIcon
                icon={faUser}
                className="aspect-square text-sm"
                fixedWidth
              />
            </Menu.Button>
          </div>

          <Transition
            as={Fragment}
            enter="duration-200 transform ease-out"
            enterFrom="opacity-0 scale-95 -translate-y-2"
            enterTo="opacity-100 scale-100 translate-y-0"
            leave="duration-200 ease-in"
            leaveFrom="opacity-100 scale-100 translate-y-0"
            leaveTo="opacity-0 scale-95 -translate-y-2"
          >
            <Menu.Items className="absolute right-0 mt-2 min-w-[12rem] rounded bg-zinc-100 shadow-lg dark:bg-zinc-700">
              <div className="flex flex-col items-stretch justify-start space-y-1 px-1 py-1">
                <Menu.Item className="w-full px-2">
                  <a
                    href="/account"
                    className="flex flex-row items-center justify-start space-x-4 rounded px-4 py-2 text-sm font-medium hover:bg-blue-600 hover:text-zinc-100 dark:hover:bg-blue-700"
                  >
                    <FontAwesomeIcon icon={faUser} fixedWidth />

                    <span>My account</span>
                  </a>
                </Menu.Item>

                <hr className="border-b border-t border-b-zinc-200 border-t-transparent dark:border-b-zinc-800" />

                <Menu.Item className="w-full px-2">
                  <button
                    className="flex flex-row items-center justify-start space-x-4 rounded px-4 py-2 text-sm font-medium hover:bg-blue-600 hover:text-zinc-100 dark:hover:bg-blue-700"
                    onClick={() =>
                      axios.post(`/logout`).then(() => router.visit(`/`))
                    }
                  >
                    <FontAwesomeIcon icon={faSignOut} fixedWidth />

                    <span>Logout</span>
                  </button>
                </Menu.Item>
              </div>
            </Menu.Items>
          </Transition>
        </>
      )}
    </Menu>
  )
}
