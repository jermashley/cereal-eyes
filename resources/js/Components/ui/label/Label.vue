<script setup>
import { Label } from 'radix-vue'
import { computed } from 'vue'

import { cn } from '@/Lib/utils'

const props = defineProps({
  for: { type: String, required: false, default: `` },
  asChild: { type: Boolean, required: false, default: false },
  as: { type: String, required: false, default: `label` },
  class: { type: String, required: false, default: `` },
})

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <Label
    v-bind="delegatedProps"
    :class="
      cn(
        'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70',
        props.class,
      )
    "
  >
    <slot />
  </Label>
</template>
