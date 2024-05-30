<script setup>
import { VueQueryDevtools } from '@tanstack/vue-query-devtools'

import Navbar from '@/Components/layout/navigation/Navbar.vue'
</script>

<template>
  <div class="flex min-h-dvh w-full flex-col space-y-8">
    <Navbar />

    <div class="mx-auto w-full max-w-3xl grow">
      <slot></slot>
    </div>
  </div>

  <VueQueryDevtools />
</template>
