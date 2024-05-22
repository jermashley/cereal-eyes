<script setup>
import { faEye, faPencil, faTrashAlt } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { router, useForm, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'
import { ref } from 'vue'
import { watch } from 'vue'

import { Badge } from '@/Components/ui/badge'
import Button from '@/Components/ui/button/Button.vue'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import Label from '@/Components/ui/label/Label.vue'
import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/Components/ui/sheet'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import Textarea from '@/Components/ui/textarea/Textarea.vue'
import ToggleGroup from '@/Components/ui/toggle-group/ToggleGroup.vue'
import ToggleGroupItem from '@/Components/ui/toggle-group/ToggleGroupItem.vue'
import { useDecodeType } from '@/Composables/Hooks/DecodeType'
import AppLayout from '@/Layouts/AppLayout.vue'

const { decodes } = usePage().props

const responseData = ref(null)

const { decodeType } = useDecodeType()

const form = useForm({
  encoded_data: ``,
  type: decodeType.value,
})

watch(decodeType, () => (form.type = decodeType.value))

const submit = async () => {
  await axios.post(route(`api.decode.store`), form).then(({ data }) => {
    router.reload({ only: [`decodes`] })

    responseData.value = data
  })
}

const resetFormAndData = () => {
  form.reset()
  responseData.value = null
}

dayjs.extend(relativeTime)
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

    <!-- <Sheet>
      <SheetTrigger class="mb-16 w-full" as-child>
        <Button class="w-full" variant="secondary">Old Decodes</Button>
      </SheetTrigger>

      <SheetContent
        class="flex w-full max-w-2xl flex-col items-stretch justify-start sm:max-w-md"
      >
        <SheetHeader>
          <SheetTitle>Decodes</SheetTitle>
        </SheetHeader>

        <div
          v-if="decodes"
          class="mt-4 flex flex-grow flex-col space-y-2 overflow-y-auto"
        >
          <Card v-for="decode in decodes" :key="decode.uuid">
            <CardHeader>
              <CardTitle
                class="flex flex-row items-center justify-between text-sm font-semibold"
              >
                <span>{{ dayjs(decode.created_at).fromNow() }}</span>

                <Badge>{{ decode.type.name }}</Badge>
              </CardTitle>
            </CardHeader>

            <CardContent>
              <div class="flex flex-row items-center justify-start space-x-2">
                <Button size="iconSm" variant="secondary">
                  <FontAwesomeIcon :icon="faEye" fixed-width />
                </Button>

                <Button size="iconSm" variant="secondary">
                  <FontAwesomeIcon :icon="faPencil" fixed-width />
                </Button>

                <Button size="iconSm" variant="secondary">
                  <FontAwesomeIcon :icon="faTrashAlt" fixed-width />
                </Button>

                <Button size="sm" variant="destructive">Delete</Button>

                <Button size="sm" variant="secondary">Cancel</Button>
              </div>
            </CardContent>
          </Card>
        </div>

        <p v-else class="text-sm text-zinc-600 dark:text-zinc-300">
          No decodes...yet!
        </p>

        <SheetFooter>
          <SheetClose as-child>
            <Button size="sm" variant="secondary">Close</Button>
          </SheetClose>

          <Button size="sm" variant="destructive">Delete all</Button>
        </SheetFooter>
      </SheetContent>
    </Sheet> -->

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
          :disabled="!form.encoded_data && !responseData"
          @click="resetFormAndData"
        >
          Clear
        </Button>

        <Button class="w-full" size="sm" type="submit">Decode</Button>
      </div>
    </form>

    <Tabs
      v-if="responseData && decodeType === `Serial`"
      default-value="print_r"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!responseData?.print_r"
          class="w-full font-bold"
          value="print_r"
        >
          print_r
        </TabsTrigger>

        <TabsTrigger
          :disabled="!responseData?.var_export"
          class="w-full font-bold"
          value="var_export"
        >
          var_export
        </TabsTrigger>

        <TabsTrigger
          :disabled="!responseData?.json"
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
            v-html="responseData?.print_r ?? `No print_r`"
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
            v-html="responseData?.var_export ?? `No var_export`"
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
              JSON.stringify(responseData?.json, null, 4).replace(
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
            v-html="responseData?.base64_decode ?? `No base64_decode`"
          />
        </code>
      </TabsContent> -->
    </Tabs>

    <Tabs
      v-if="responseData && decodeType === `Base64`"
      default-value="base64"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!responseData?.base64"
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
              !!JSON.parse(responseData?.base64)
                ? JSON.stringify(
                    JSON.parse(responseData?.base64),
                    null,
                    4,
                  ).replace(/\\n|\\t/g, '')
                : responseData?.base64
            "
          />
        </code>
      </TabsContent>
    </Tabs>
  </AppLayout>
</template>
