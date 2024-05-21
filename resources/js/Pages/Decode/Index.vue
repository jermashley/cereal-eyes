<script setup>
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'
import { ref } from 'vue'

import Button from '@/Components/ui/button/Button.vue'
import Label from '@/Components/ui/label/Label.vue'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import Textarea from '@/Components/ui/textarea/Textarea.vue'
import ToggleGroup from '@/Components/ui/toggle-group/ToggleGroup.vue'
import ToggleGroupItem from '@/Components/ui/toggle-group/ToggleGroupItem.vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const responseData = ref(null)
const decodeType = ref(`Serial`)

const form = useForm({
  encoded_data: ``,
  type: decodeType,
})

const submit = async () => {
  const { data } = await axios.post(route(`api.decode.store`), form)

  responseData.value = data
}

const resetFormAndData = () => {
  form.reset()
  responseData.value = null
}
</script>

<template>
  <AppLayout>
    <ToggleGroup
      v-model="decodeType"
      type="single"
      size="lg"
      default-value="Serial"
      :model-value="decodeType"
      @update:model-value="resetFormAndData"
    >
      <ToggleGroupItem value="Serial"> Serial </ToggleGroupItem>

      <ToggleGroupItem value="Base64"> Base64 </ToggleGroupItem>
    </ToggleGroup>

    <form class="flex flex-col gap-4" @submit.prevent="submit">
      <Label>Put that dang data down there.</Label>

      <Textarea
        v-model="form.encoded_data"
        placeholder="Your encoded data."
        name="data"
        rows="8"
      />

      <Button size="sm" type="submit">Decode</Button>

      <Button
        size="sm"
        variant="outline"
        type="button"
        @click="resetFormAndData"
        >Clear</Button
      >
    </form>

    <Tabs
      v-if="responseData && decodeType === `Serial`"
      default-value="print_r"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!responseData?.print_r"
          class="w-full font-mono font-bold"
          value="print_r"
        >
          print_r
        </TabsTrigger>

        <TabsTrigger
          :disabled="!responseData?.var_export"
          class="w-full font-mono font-bold"
          value="var_export"
        >
          var_export
        </TabsTrigger>

        <TabsTrigger
          :disabled="!responseData?.json"
          class="w-full font-mono font-bold"
          value="json"
        >
          json
        </TabsTrigger>

        <!-- <TabsTrigger
          :disabled="!responseData?.base64_decode"
          class="w-full font-mono font-bold"
          value="base64_decode"
        >
          base64_decode
        </TabsTrigger> -->
      </TabsList>

      <TabsContent
        class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
        value="print_r"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
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
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
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
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
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
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            v-html="responseData?.base64_decode ?? `No base64_decode`"
          />
        </code>
      </TabsContent> -->
    </Tabs>

    <Tabs
      v-if="responseData && decodeType === `Base64`"
      default-value="print_r"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger
          :disabled="!responseData?.base64"
          class="w-full font-mono font-bold"
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
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            v-html="responseData?.base64 ?? `No base64`"
          />
        </code>
      </TabsContent>
    </Tabs>
  </AppLayout>
</template>
