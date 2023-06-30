<template>
  <div
    class="flex h-full min-h-screen w-full flex-col items-center justify-start"
  >
    <slot />

    <footer class="flex w-full flex-row items-center justify-center px-4 py-6">
      <p class="text-xs font-bold text-zinc-500 opacity-80 dark:text-zinc-600">
        <a
          href="https://prologuetechnology.com"
          class="transition-all duration-200 dark:hover:text-sky-400"
          target="_blank"
          rel="noreferrer"
        >
          Jeremiah Ashley
        </a>

        {{ ` ` }}

        <FontAwesomeIcon :icon="faCopyright" class="text-xs" fixed-width />

        {{ new Date().getFullYear() }}
      </p>
    </footer>
  </div>
</template>

<script setup>
import { faCopyright } from '@fortawesome/pro-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
</script>
