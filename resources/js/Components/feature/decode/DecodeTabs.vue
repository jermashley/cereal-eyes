<script setup>
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import { useDecodeType } from '@/Composables/Hooks/DecodeType'
import { useGetDecodeQuery } from '@/Composables/Queries/Decode'

const props = defineProps({
  decodeId: { type: Number, required: true },
})

const { decodeType } = useDecodeType()

const { data: decode, isSuccess } = useGetDecodeQuery({ id: props.decodeId })
</script>

<template>
  <Tabs
    v-if="decode && isSuccess && decodeType === `Serial`"
    default-value="print_r"
    class="mx-auto mt-12 w-full"
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
      class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="print_r"
    >
      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="decode?.print_r ?? `No print_r`"
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
          v-html="decode?.var_export ?? `No var_export`"
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
            JSON.stringify(decode?.json, null, 4).replace(/\\n|\\t/g, '') ??
            `No json`
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
          v-html="decode?.base64_decode ?? `No base64_decode`"
        />
      </code>
    </TabsContent> -->
  </Tabs>

  <Tabs
    v-if="decode && isSuccess && decodeType === `Base64`"
    default-value="base64"
    class="mx-auto mt-12 w-full"
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
      class="rounded-md border border-zinc-100 bg-zinc-50/75 px-4 py-2 dark:border-zinc-900 dark:bg-zinc-900/75"
      value="base64"
    >
      <code>
        <pre
          class="whitespace-break-spaces break-all text-xs font-medium leading-loose"
          v-html="
            !!JSON.parse(decode?.base64)
              ? JSON.stringify(JSON.parse(decode?.base64), null, 4).replace(
                  /\\n|\\t/g,
                  '',
                )
              : decodeResponse?.base64
          "
        />
      </code>
    </TabsContent>
  </Tabs>
</template>
