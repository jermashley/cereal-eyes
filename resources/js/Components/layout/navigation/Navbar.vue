<script setup>
import { usePage } from '@inertiajs/vue3'

import ThemeToggle from '@/Components/feature/theme/ThemeToggle.vue'
import { Button } from '@/Components/ui/button'
import { useLogout } from '@/Composables/Hooks/Auth'

const { user } = usePage().props.auth

const { logout } = useLogout()
</script>

<template>
  <header class="w-full py-2">
    <nav
      class="mx-auto flex w-full max-w-3xl flex-row items-center justify-between"
    >
      <p class="text-lg font-extrabold text-zinc-700 dark:text-zinc-200">
        Cereal Eyes
      </p>

      <div class="flex flex-row items-center justify-end space-x-2">
        <ThemeToggle />

        <Button v-if="user" size="sm" @click="logout">Logout</Button>
      </div>
    </nav>
  </header>
</template>
