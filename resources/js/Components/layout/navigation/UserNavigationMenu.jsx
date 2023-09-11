import { faSignOut, faUser } from '@fortawesome/pro-duotone-svg-icons'
import { faCommand, faK, faRight, faUp } from '@fortawesome/pro-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { router } from '@inertiajs/react'
import { useOs } from '@mantine/hooks'
import axios from 'axios'

import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuTrigger,
} from '../../ui/dropdown-menu'

export const UserNavigationMenu = () => {
  const os = useOs()

  return (
    <>
      <DropdownMenu>
        <DropdownMenuTrigger
          className="flex aspect-square flex-row items-center justify-center rounded bg-transparent p-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75"
          asChild
        >
          <FontAwesomeIcon
            icon={faUser}
            className="aspect-square text-sm"
            fixedWidth
          />
        </DropdownMenuTrigger>

        <DropdownMenuContent className="max-w-56 w-full" align="end">
          <DropdownMenuLabel>My Account</DropdownMenuLabel>

          <DropdownMenuSeparator />

          <DropdownMenuGroup>
            <DropdownMenuItem className="w-full">
              <FontAwesomeIcon icon={faUser} className="mr-2" fixedWidth />

              <span className="mr-4">Profile</span>
            </DropdownMenuItem>
          </DropdownMenuGroup>

          <DropdownMenuSeparator />

          <DropdownMenuGroup>
            <DropdownMenuItem
              className="w-full"
              onClick={() =>
                axios.post(`/logout`).then(() => router.visit(`/`))
              }
            >
              <FontAwesomeIcon icon={faSignOut} className="mr-2" fixedWidth />

              <span className="mr-4">Sign out</span>
            </DropdownMenuItem>
          </DropdownMenuGroup>
        </DropdownMenuContent>
      </DropdownMenu>
    </>
  )
}
