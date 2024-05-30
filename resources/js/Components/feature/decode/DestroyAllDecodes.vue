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
import { useDestroyAllDecodeMutation } from '@/Composables/Mutations/Decode'

const alertIsOpen = ref(false)

const queryClient = useQueryClient()

const { mutate: destroy } = useDestroyAllDecodeMutation({
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
      <Button class="w-full" size="sm" variant="destructive">
        <FontAwesomeIcon class="mr-2" :icon="faTrashAlt" fixed-width />

        <span>Delete All</span>
      </Button>
    </AlertDialogTrigger>

    <AlertDialogContent>
      <AlertDialogHeader>
        <AlertDialogTitle>
          Are you sure you want to delete all decodes?
        </AlertDialogTitle>

        <AlertDialogDescription>
          This action cannot be undone. This will permanently delete all decodes
          and remove the data from our servers.
        </AlertDialogDescription>
      </AlertDialogHeader>

      <AlertDialogFooter>
        <AlertDialogCancel>Cancel</AlertDialogCancel>

        <AlertDialogAction variant="destructive" @click="destroy">
          Delete All
        </AlertDialogAction>
      </AlertDialogFooter>
    </AlertDialogContent>
  </AlertDialog>
</template>
