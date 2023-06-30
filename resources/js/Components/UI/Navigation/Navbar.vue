<template>
  <nav
    class="sticky top-0 z-10 w-full border-b border-b-zinc-200/50 bg-zinc-100/75 backdrop-blur-md backdrop-brightness-125 backdrop-saturate-150 dark:border-b-zinc-700/50 dark:bg-zinc-800/75"
  >
    <div
      class="mx-auto flex w-full max-w-2xl flex-row items-center justify-start px-4 py-4 md:px-0"
    >
      <a href="/" class="text-base font-bold">{{ $page.props.app.name }}</a>

      <div class="ml-auto flex flex-row items-center justify-end">
        <a
          v-for="navLink in navLinks"
          :key="navLink.name"
          :href="navLink.href"
          class="rounded bg-transparent px-4 py-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75"
        >
          {{ navLink.name }}
        </a>
      </div>

      <UserMenu />
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue'

import UserMenu from './UserMenu.vue'

const navLinks = ref([
  {
    name: `Dashboard`,
    href: `/`,
  },
])
</script>
