<script setup>
import AuthGithubButton from '@/Components/feature/auth/AuthGithubButton.vue'
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from '@/Components/ui/tooltip'
import AppLayout from '@/Layouts/AppLayout.vue'
</script>

<template>
  <TooltipProvider>
    <AppLayout>
      <div class="flex flex-col items-center justify-center space-y-12 py-24">
        <h1
          class="text-center text-3xl font-semibold text-zinc-800 dark:text-zinc-200"
        >
          Decode
          <Tooltip>
            <TooltipTrigger class="line-through decoration-rose-600">
              and encode
            </TooltipTrigger>

            <TooltipContent>Coming soon!</TooltipContent>
          </Tooltip>
          your data with ease
        </h1>

        <AuthGithubButton />
      </div>
    </AppLayout>
  </TooltipProvider>
</template>
