<script setup>
import { faTrashAlt } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useQueryClient } from '@tanstack/vue-query'
import { ref } from 'vue'

import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger,
} from '@/Components/ui/alert-dialog'
import { Button } from '@/Components/ui/button'
import { useDestroyDecodeMutation } from '@/Composables/Mutations/Decode'

const props = defineProps({
  id: { type: Number, required: true },
})

const alertIsOpen = ref(false)

const queryClient = useQueryClient()

const { mutate: destroy } = useDestroyDecodeMutation({
  decodeId: props.id,
  config: {
    onSuccess: () => {
      queryClient.invalidateQueries([`decodes`])
      alertIsOpen.value = false
    },
  },
})
</script>

<template>
  <AlertDialog v-model:open="alertIsOpen">
    <AlertDialogTrigger as-child>
      <Button size="iconSm" variant="destructive">
        <FontAwesomeIcon :icon="faTrashAlt" fixed-width />
      </Button>
    </AlertDialogTrigger>

    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>
          Are you sure you want to delete this decode?
        </AlertDialogTitle>

        <AlertDialogDescription>
          This action cannot be undone. This will permanently delete your decode
          and remove the data from our servers.
        </AlertDialogDescription>
      </AlertDialogHeader>

      <AlertDialogFooter>
        <AlertDialogCancel>Cancel</AlertDialogCancel>

        <AlertDialogAction variant="destructive" @click="destroy">
          Delete
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
