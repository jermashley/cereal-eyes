<script setup>
import { Primitive } from 'radix-vue'

import { cn } from '@/Lib/utils'

import { buttonVariants } from '.'

const props = defineProps({
  variant: { type: String, required: false, default: `` }, // Specify a type and default value
  size: { type: String, required: false, default: `` },
  class: { type: String, required: false, default: `` },
  asChild: { type: Boolean, required: false },
  as: { type: null, required: false, default: `button` },
})
</script>

<template>
  <Primitive
    :as="as"
    :as-child="asChild"
    :class="cn(buttonVariants({ variant, size }), props.class)"
  >
    <slot />
  </Primitive>
</template>
