<template>
  <DefaultLayout>
    <Navbar />

    <main
      id="AuthenticatedLayout"
      class="mx-auto flex w-full max-w-2xl flex-grow flex-col px-4 md:px-0"
    >
      <slot />
    </main>
  </DefaultLayout>
</template>

<script setup>
import Navbar from '@/Components/UI/Navigation/Navbar.vue'

import DefaultLayout from './DefaultLayout.vue'
</script>
