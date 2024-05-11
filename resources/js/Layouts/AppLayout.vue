<script setup>
import { router, usePage } from '@inertiajs/vue3'

import AuthGithubButton from '@/Components/feature/auth/AuthGithubButton.vue'
import { Button } from '@/Components/ui/button'

const user = usePage().props.auth.user

const logout = () => router.post(route(`oauth.logout`))
</script>

<template>
  <div class="mx-auto flex max-w-3xl flex-col">
    <nav class="flex flex-row items-center justify-end">
      <Button v-if="user" size="sm" @click="logout">Logout</Button>
      <AuthGithubButton v-else size="sm" />
    </nav>

    <div class="grow">
      <slot></slot>
    </div>
  </div>
</template>
