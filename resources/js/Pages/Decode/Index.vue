<script setup>
import { useForm } from '@inertiajs/vue3'
import { useQueryClient } from '@tanstack/vue-query'
import { watch } from 'vue'

import DecodeSheet from '@/Components/feature/decode/DecodeSheet.vue'
import DecodeTabs from '@/Components/feature/decode/DecodeTabs.vue'
import { Button } from '@/Components/ui/button'
import { Label } from '@/Components/ui/label'
import { Textarea } from '@/Components/ui/textarea'
import { ToggleGroup, ToggleGroupItem } from '@/Components/ui/toggle-group'
import { useDecodeType } from '@/Composables/Hooks/DecodeType'
import { useStoreDecodeMutation } from '@/Composables/Mutations/Decode'
import AppLayout from '@/Layouts/AppLayout.vue'

const queryClient = useQueryClient()

const {
  mutate: storeDecode,
  data: decodeResponse,
  isSuccess,
  reset,
} = useStoreDecodeMutation({
  config: {
    onSuccess: () => {
      queryClient.invalidateQueries([`decodes`])
    },
  },
})

const { decodeType } = useDecodeType()

const form = useForm({
  encoded_data: ``,
  type: decodeType.value,
})

watch(decodeType, () => (form.type = decodeType.value))

const submit = () => {
  storeDecode({
    formData: form,
  })
}

const resetFormAndData = () => {
  form.reset()
  reset()
}
</script>

<template>
  <AppLayout>
    <DecodeSheet />

    <div
      class="mb-4 flex flex-row items-center justify-between rounded-lg bg-zinc-50/50 px-4 py-2 outline outline-zinc-300/50 dark:bg-zinc-900/50 dark:outline-zinc-700/50"
    >
      <Label class="text-base font-semibold">Decode Type</Label>

      <ToggleGroup
        v-model="decodeType"
        type="single"
        size="lg"
        default-value="Serial"
      >
        <ToggleGroupItem class="text-monospace font-bold" value="Serial">
          Serial
        </ToggleGroupItem>

        <ToggleGroupItem class="text-monospace font-bold" value="Base64">
          Base64
        </ToggleGroupItem>
      </ToggleGroup>
    </div>

    <form class="flex flex-col gap-4" @submit.prevent="submit">
      <Textarea
        v-model="form.encoded_data"
        placeholder="V2hvbGUgR3JhaW4gT2F0cywgQ29ybiBTdGFyY2gsIFN1Z2FyLCBTYWx0LCBUcmlwb3Rhc3NpdW0gUGhvc3BoYXRlLiBWaXRhbWluIEUgKG1peGVkIHRvY29waGVyb2xzKSBBZGRlZCB0byBQcmVzZXJ2ZSBGcmVzaG5lc3MuIFZpdGFtaW5zIGFuZCBNaW5lcmFsczogQ2FsY2l1bSBDYXJib25hdGUsIElyb24gYW5kIFppbmMgKG1pbmVyYWwgbnV0cmllbnRzKSwgVml0YW1pbiBDIChzb2RpdW0gYXNjb3JiYXRlKSwgQSBCIFZpdGFtaW4gKG5pYWNpbmFtaWRlKSwgVml0YW1pbiBCNiAocHlyaWRveGluZSBoeWRyb2NobG9yaWRlKSwgVml0YW1pbiBBIChwYWxtaXRhdGUpLCBWaXRhbWluIEIxICh0aGlhbWluIG1vbm9uaXRyYXRlKSwgQSBCIFZpdGFtaW4gKGZvbGljIGFjaWQpLCBWaXRhbWluIEIxMiwgVml0YW1pbiBEMw=="
        name="data"
        rows="8"
      />

      <div class="flex w-full flex-row items-center justify-center space-x-2">
        <Button
          class="w-full"
          size="sm"
          variant="outline"
          type="button"
          :disabled="!form.encoded_data && !decodeResponse?.data"
          @click="resetFormAndData"
        >
          Clear
        </Button>

        <Button class="w-full" size="sm" type="submit">Decode</Button>
      </div>
    </form>

    <DecodeTabs
      v-if="decodeResponse?.data && isSuccess"
      :decode-id="decodeResponse?.data"
    />
  </AppLayout>
</template>
