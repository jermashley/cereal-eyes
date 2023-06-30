<template>
  <Menu as="root" class="relative z-10">
    <div>
      <MenuButton
        v-slot="{ open }"
        :class="`flex aspect-square flex-row items-center justify-center rounded p-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75 ${
          open ? `bg-zinc-200/75 dark:bg-zinc-700/75` : `bg-transparent`
        }`"
      >
        <FontAwesomeIcon
          :icon="faUser"
          class="aspect-square text-sm"
          :fixed-width="true"
        />
      </MenuButton>
    </div>

    <TransitionRoot
      as="template"
      enter="duration-200 transform ease-out"
      enter-from="opacity-0 scale-95 -translate-y-2"
      enter-to="opacity-100 scale-100 translate-y-0"
      leave="duration-200 ease-in"
      leave-from="opacity-100 scale-100 translate-y-0"
      leave-to="opacity-0 scale-95 -translate-y-2"
    >
      <MenuItems
        class="absolute right-0 mt-2 min-w-[12rem] rounded bg-zinc-100 shadow-lg dark:bg-zinc-700"
      >
        <div
          class="flex flex-col items-stretch justify-start space-y-1 px-1 py-1"
        >
          <MenuItem class="w-full px-2">
            <a
              href="/account"
              class="flex flex-row items-center justify-start space-x-4 rounded px-4 py-2 text-sm font-medium hover:bg-blue-600 hover:text-zinc-100 dark:hover:bg-blue-700"
            >
              <FontAwesomeIcon :icon="faUser" :fixed-width="true" />

              <span>My account</span>
            </a>
          </MenuItem>

          <hr
            class="border-b border-t border-b-zinc-200 border-t-transparent dark:border-b-zinc-800"
          />

          <MenuItem class="w-full px-2">
            <button
              class="flex flex-row items-center justify-start space-x-4 rounded px-4 py-2 text-sm font-medium hover:bg-blue-600 hover:text-zinc-100 dark:hover:bg-blue-700"
              @click="axios.post('/logout').then(() => router.visit('/'))"
            >
              <FontAwesomeIcon :icon="faSignOut" :fixed-width="true" />

              <span>Logout</span>
            </button>
          </MenuItem>
        </div>
      </MenuItems>
    </TransitionRoot>
  </Menu>
</template>

<script setup>
import { faSignOut, faUser } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionRoot,
} from '@headlessui/vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'
</script>
