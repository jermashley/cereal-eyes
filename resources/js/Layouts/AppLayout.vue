<script setup>
import Navbar from '@/Components/layout/navigation/Navbar.vue'
</script>

<template>
  <div class="flex min-h-screen w-full flex-col space-y-4">
    <Navbar />

    <div class="mx-auto w-full max-w-3xl grow">
      <slot></slot>
    </div>
  </div>
</template>
