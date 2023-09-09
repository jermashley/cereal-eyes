<template>
  <div class="w-full">
    <TabGroup>
      <TabList
        class="flex w-full flex-row items-center justify-evenly space-x-1"
      >
        <Tab
          v-for="debugItem in debugItems"
          :key="debugItem.label"
          v-slot="{ selected }"
          as="template"
        >
          <button
            :class="[
              selected ? `text-red-600` : `text-zinc-200`,
              `font-mono font-bold`,
            ]"
          >
            {{ debugItem.label }}
          </button>
        </Tab>
      </TabList>

      <TabPanels class="mt-2">
        <TabPanel
          v-for="debugItem in debugItems"
          :key="`${debugItem.label}_content`"
        >
          <pre>
            <code class="whitespace-pre font-mono text-sm font-bold leading-loose tracking-wide" v-text="debugItem.value" />
          </pre>
        </TabPanel>
      </TabPanels>
    </TabGroup>
  </div>
</template>

<script setup>
import { Tab, TabGroup, TabList, TabPanel, TabPanels } from '@headlessui/vue'
import { computed } from 'vue'

const props = defineProps({
  response: {
    type: Object,
    required: true,
  },
})

const debugItems = computed(() => {
  return [
    {
      label: `print_r`,
      value: props.response.print_r,
    },
    {
      label: `var_export`,
      value: props.response.var_export,
    },
  ]
})
</script>
