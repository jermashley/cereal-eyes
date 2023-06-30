<template>
  <DefaultLayout>
    <main class="flex w-full flex-grow flex-col px-4 md:px-0">
      <slot />
    </main>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from './DefaultLayout.vue'
</script>
