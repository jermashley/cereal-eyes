<script setup>
import axios from 'axios'
import { reactive } from 'vue'
import { ref } from 'vue'

import Button from '@/Components/ui/button/Button.vue'
import Label from '@/Components/ui/label/Label.vue'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs'
import Textarea from '@/Components/ui/textarea/Textarea.vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = reactive({
  data: ``,
})

const responseData = ref(null)

const submit = async () => {
  const { data } = await axios.post(route(`api.decode.store`), form)

  responseData.value = data
}
</script>

<template>
  <AppLayout>
    <form class="flex flex-col gap-4" @submit.prevent="submit">
      <Label>Put that dang data down here.</Label>

      <Textarea
        v-model="form.data"
        placeholder="Your serialized data."
        name="data"
      />

      <Button size="sm" type="submit">Decode</Button>
    </form>

    <Tabs
      v-if="responseData"
      default-value="print_r"
      class="mx-auto mt-12 w-full"
    >
      <TabsList class="flex w-full flex-row">
        <TabsTrigger class="bold w-full font-mono" value="print_r">
          print_r
        </TabsTrigger>

        <TabsTrigger class="bold w-full font-mono" value="var_export">
          var_export
        </TabsTrigger>

        <TabsTrigger class="bold w-full font-mono"
value="json"
          >json</TabsTrigger
        >

        <TabsTrigger class="bold w-full font-mono" value="base64_decode">
          base64_decode
        </TabsTrigger>
      </TabsList>

      <TabsContent
        class="rounded-md border border-slate-100 bg-slate-50/75 px-4 py-2"
        value="print_r"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            >{{ responseData?.print_r ?? `No print_r` }}</pre
          >
        </code>
      </TabsContent>

      <TabsContent
        class="rounded-md border border-slate-100 bg-slate-50/75 px-4 py-2"
        value="var_export"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            >{{ responseData?.var_export ?? `No var_export` }}</pre
          >
        </code>
      </TabsContent>

      <TabsContent
        class="rounded-md border border-slate-100 bg-slate-50/75 px-4 py-2"
        value="json"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            >{{ responseData?.json ?? `No json` }}</pre
          >
        </code>
      </TabsContent>

      <TabsContent
        class="rounded-md border border-slate-100 bg-slate-50/75 px-4 py-2"
        value="base64_decode"
      >
        <code>
          <pre
            class="whitespace-break-spaces break-all font-mono text-xs font-medium leading-loose"
            >{{ responseData?.base64_decode ?? `No base64_decode` }}</pre
          >
        </code>
      </TabsContent>
    </Tabs>
  </AppLayout>
</template>
