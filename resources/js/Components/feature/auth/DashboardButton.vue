<script setup>
import { faEyes } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { Link } from '@inertiajs/vue3'

import { Button } from '@/Components/ui/button'
</script>

<template>
  <Button as-child>
    <Link :href="route('dashboard')">
      <FontAwesomeIcon class="mr-2 text-lg" :icon="faEyes" fixed-width />
      Dashboard
    </Link>
  </Button>
</template>
