<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { useQueryClient } from '@tanstack/vue-query'
import { ref } from 'vue'
import { watch } from 'vue'

import DecodeSheet from '@/Components/feature/decode/DecodeSheet.vue'
import Button from '@/Components/ui/button/Button.vue'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import Textarea from '@/Components/ui/textarea/Textarea.vue'
import ToggleGroup from '@/Components/ui/toggle-group/ToggleGroup.vue'
import ToggleGroupItem from '@/Components/ui/toggle-group/ToggleGroupItem.vue'
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
    onSuccess: () => queryClient.invalidateQueries([`decodes`]),
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
    <ToggleGroup
      v-model="decodeType"
      type="single"
      class="mb-12 flex w-full flex-row"
      size="lg"
    >
      <ToggleGroupItem class="text-monospace w-full font-bold" value="Serial">
        Serial
      </ToggleGroupItem>

      <ToggleGroupItem class="text-monospace w-full font-bold" value="Base64">
        Base64
      </ToggleGroupItem>
    </ToggleGroup>

    <DecodeSheet />

    <form class="flex flex-col gap-4" @submit.prevent="submit">
      <!-- <Label class="text-left">Encoded Data</Label> -->

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
          :disabled="!form.encoded_data && !decodeResponse"
          @click="resetFormAndData"
        >
          Clear
        </Button>

        <Button class="w-full" size="sm" type="submit">Decode</Button>
      </div>
    </form>

    <Tabs
      v-if="decodeResponse?.data && isSuccess && decodeType === `Serial`"
      default-value="print_r"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!decodeResponse?.data?.print_r"
          class="w-full font-bold"
          value="print_r"
        >
          print_r
        </TabsTrigger>

        <TabsTrigger
          :disabled="!decodeResponse?.data?.var_export"
          class="w-full font-bold"
          value="var_export"
        >
          var_export
        </TabsTrigger>

        <TabsTrigger
          :disabled="!decodeResponse?.data?.json"
          class="w-full font-bold"
          value="json"
        >
          json
        </TabsTrigger>
      </TabsList>

      <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="print_r"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
            v-html="decodeResponse?.data?.print_r ?? `No print_r`"
          />
        </code>
      </TabsContent>

      <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="var_export"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
            v-html="decodeResponse?.data?.var_export ?? `No var_export`"
          />
        </code>
      </TabsContent>

      <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="json"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
            v-html="
              JSON.stringify(decodeResponse?.data?.json, null, 4).replace(
                /\\n|\\t/g,
                '',
              ) ?? `No json`
            "
          />
        </code>
      </TabsContent>

      <!-- <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="base64_decode"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
            v-html="decodeResponse?.base64_decode ?? `No base64_decode`"
          />
        </code>
      </TabsContent> -->
    </Tabs>

    <Tabs
      v-if="decodeResponse && isSuccess && decodeType === `Base64`"
      default-value="base64"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!decodeResponse?.data?.base64"
          class="w-full font-bold"
          value="base64"
        >
          base64
        </TabsTrigger>
      </TabsList>

      <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="base64"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
            v-html="
              !!JSON.parse(decodeResponse?.data?.base64)
                ? JSON.stringify(
                    JSON.parse(decodeResponse?.data?.base64),
                    null,
                    4,
                  ).replace(/\\n|\\t/g, '')
                : decodeResponse?.data?.base64
            "
          />
        </code>
      </TabsContent>
    </Tabs>
  </AppLayout>
</template>
