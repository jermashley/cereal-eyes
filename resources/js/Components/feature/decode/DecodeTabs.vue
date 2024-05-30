<script setup>
import { faCopy } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useClipboard } from '@vueuse/core'

import { Button } from '@/Components/ui/button'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import { useGetDecodeQuery } from '@/Composables/Queries/Decode'

const props = defineProps({
  id: { type: Number, required: true },
})

const { data: decode, isSuccess } = useGetDecodeQuery({
  id: props.id,
})

const { isSupported, copy } = useClipboard()
</script>

<template>
  <Tabs
    v-if="decode && isSuccess && decode?.type?.name === `Serial`"
    default-value="print_r"
  >
    <TabsList class="flex w-full flex-row">
      <TabsTrigger
        :disabled="!decode?.print_r"
        class="w-full font-bold"
        value="print_r"
      >
        print_r
      </TabsTrigger>

      <TabsTrigger
        :disabled="!decode?.var_export"
        class="w-full font-bold"
        value="var_export"
      >
        var_export
      </TabsTrigger>

      <TabsTrigger
        :disabled="!decode?.json"
        class="w-full font-bold"
        value="json"
      >
        json
      </TabsTrigger>
    </TabsList>

    <TabsContent
      class="relative max-h-[calc(100vh-16rem)] overflow-y-auto rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="print_r"
    >
      <div
        class="sticky left-0 right-0 top-0 flex w-full flex-row justify-end rounded-md"
      >
        <Button
          v-if="decode?.print_r"
          variant="secondary"
          size="iconSm"
          :disabled="!isSupported"
          @click="copy(decode?.print_r)"
        >
          <FontAwesomeIcon :icon="faCopy" fixed-width />
        </Button>
      </div>

      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="decode?.print_r ?? `No print_r`"
        />
      </code>
    </TabsContent>

    <TabsContent
      class="max-h-[calc(100vh-16rem)] overflow-y-auto rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="var_export"
    >
      <div
        class="sticky left-0 right-0 top-0 flex w-full flex-row justify-end rounded-md"
      >
        <Button
          v-if="decode?.var_export"
          variant="secondary"
          size="iconSm"
          :disabled="!isSupported"
          @click="copy(decode?.var_export)"
        >
          <FontAwesomeIcon :icon="faCopy" fixed-width />
        </Button>
      </div>

      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="decode?.var_export ?? `No var_export`"
        />
      </code>
    </TabsContent>

    <TabsContent
      class="max-h-[calc(100vh-16rem)] overflow-y-auto rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="json"
    >
      <div
        class="sticky left-0 right-0 top-0 flex w-full flex-row justify-end rounded-md"
      >
        <Button
          v-if="decode?.json"
          variant="secondary"
          size="iconSm"
          :disabled="!isSupported"
          @click="copy(decode?.json)"
        >
          <FontAwesomeIcon :icon="faCopy" fixed-width />
        </Button>
      </div>

      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="
            JSON.stringify(decode?.json, null, 4).replace(/\\n|\\t/g, '') ??
            `No json`
          "
        />
      </code>
    </TabsContent>
  </Tabs>

  <Tabs
    v-if="decode && isSuccess && decode?.type?.name === `Base64`"
    default-value="base64"
    class="mx-auto w-full"
  >
    <TabsList class="flex w-full flex-row">
      <TabsTrigger
        :disabled="!decode?.base64"
        class="w-full font-bold"
        value="base64"
      >
        base64
      </TabsTrigger>
    </TabsList>

    <TabsContent
      class="max-h-[calc(100vh-16rem)] overflow-y-auto rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="base64"
    >
      <div
        class="sticky left-0 right-0 top-0 flex w-full flex-row justify-end rounded-md"
      >
        <Button
          v-if="decode?.base64"
          variant="secondary"
          size="iconSm"
          :disabled="!isSupported"
          @click="copy(decode?.base64)"
        >
          <FontAwesomeIcon :icon="faCopy" fixed-width />
        </Button>
      </div>

      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="decode?.base64"
        />
      </code>
    </TabsContent>
  </Tabs>
</template>
