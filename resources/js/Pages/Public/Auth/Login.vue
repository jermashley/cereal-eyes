<template>
  <Head title="Login" />
  <section
    class="flex h-full w-full flex-grow flex-col items-center justify-center space-y-2"
  >
    <TransitionRoot
      appear
      :show="true"
      as="template"
      enter="transform transition duration-[600ms]"
      enter-from="opacity-0 scale-90"
      enter-to="opacity-100 scale-100"
      leave="transform duration-200 transition ease-in-out"
      leave-from="opacity-100 scale-100 "
      leave-to="opacity-80 scale-90"
    >
      <div
        class="flex w-full max-w-sm flex-col rounded-sm border border-zinc-200 bg-zinc-50/80 px-8 py-10 shadow-xl dark:border-zinc-700 dark:bg-zinc-800/80"
      >
        <h1 class="text-center text-3xl font-medium opacity-80">
          {{ $page.props.app.name }}
        </h1>

        <p class="mt-4 text-center text-sm opacity-80">
          Your portal for onboarding a new team member.
        </p>

        <a
          :class="block"
          class="mt-12 flex flex-row items-center justify-center space-x-2 rounded-sm border border-zinc-200/75 bg-zinc-100 px-4 py-2 text-sm text-zinc-700 transition-all duration-200 dark:border-zinc-600/75 dark:bg-zinc-700 dark:text-zinc-200 hover:dark:bg-zinc-600"
          href="/auth/redirect/github"
        >
          <FontAwesomeIcon :icon="faGithub" class="text-lg" fixed-width />

          <span>Sign in with Github</span>
        </a>
      </div>
    </TransitionRoot>

    <p
      v-if="$page.props.errors.email"
      class="text-sm text-rose-700 dark:text-rose-400"
    >
      You need a valid email address to log in.
    </p>
  </section>
</template>

<script setup>
import { faGithub } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { TransitionRoot } from '@headlessui/vue'
import { Head } from '@inertiajs/vue3'
</script>
