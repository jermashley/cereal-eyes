<script setup>
import { faMoon, faSun } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { ToggleGroup, ToggleGroupItem } from '@/Components/ui/toggle-group'
import { useSystemTheme } from '@/Composables/Hooks/Theme/useSystemTheme'

const { theme } = useSystemTheme()
</script>

<template>
  <ToggleGroup
    v-model="theme"
    type="single"
    size="sm"
    :default-value="theme"
    :model-value="theme"
  >
    <ToggleGroupItem value="light">
      <FontAwesomeIcon class="" :icon="faSun" fixed-width />
    </ToggleGroupItem>

    <ToggleGroupItem value="dark">
      <FontAwesomeIcon class="" :icon="faMoon" fixed-width />
    </ToggleGroupItem>
  </ToggleGroup>
</template>
