<script setup>
import { faGithub } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { Button } from '@/Components/ui/button'
</script>

<template>
  <Button as="a" :href="route('oauth.redirect', 'github')">
    <FontAwesomeIcon class="mr-2 text-lg" :icon="faGithub" fixed-width />
    Login with Github
  </Button>
</template>
