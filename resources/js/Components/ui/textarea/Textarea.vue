<script setup>
import { useVModel } from '@vueuse/core'

import { cn } from '@/Lib/utils'

const props = defineProps({
  class: { type: String, default: `` },
  defaultValue: { type: [String, Number], required: false, default: `` },
  modelValue: { type: [String, Number], required: false, default: `` },
})

const emits = defineEmits([`update:modelValue`])

const modelValue = useVModel(props, `modelValue`, emits, {
  passive: true,
  defaultValue: props.defaultValue,
})
</script>

<template>
  <textarea
    v-model="modelValue"
    :class="
      cn(
        'flex min-h-20 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground/50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',
        props.class,
      )
    "
  />
</template>
