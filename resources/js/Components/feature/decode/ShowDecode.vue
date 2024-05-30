<script setup>
import { faEye } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { Button } from '@/Components/ui/button'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog'

import DecodeTabs from './DecodeTabs.vue'

const props = defineProps({
  id: { type: Number, required: true },
})
</script>

<template>
  <Dialog>
    <DialogTrigger as-child>
      <Button size="iconSm" variant="secondary">
        <FontAwesomeIcon :icon="faEye" fixed-width />
      </Button>
    </DialogTrigger>

    <DialogContent class="w-full max-w-xl sm:max-w-3xl">
      <DialogHeader class="sticky top-0">
        <DialogTitle>View Decode</DialogTitle>
      </DialogHeader>

      <DecodeTabs v-if="id" :id="id" />
    </DialogContent>
  </Dialog>
</template>
