<template>
  <div>
    <form
      class="flex flex-col items-stretch justify-start space-y-2"
      @submit.prevent="handleSubmit"
    >
      <textarea
        id="serialized"
        v-model="serializedInput"
        name="serialized"
        rows="10"
        placeholder="Paste your serialized data here."
        class="w-full rounded border border-zinc-600 bg-zinc-800 px-4 py-2 text-zinc-100"
      />

      <button
        type="submit"
        class="rounded bg-transparent px-4 py-2 text-sm font-semibold transition-all duration-300 hover:bg-zinc-200/75 dark:hover:bg-zinc-700/75"
      >
        Unserialize
      </button>
    </form>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

import { useCurrentSerializedResponse } from '@/Composables/Hooks'
import { useStoreSerializedMutation } from '@/Composables/Mutations/Serialized'

const { setResponse, response } = useCurrentSerializedResponse()

const storeSerialized = useStoreSerializedMutation({
  config: {
    onSuccess: ({ data }) => {
      setResponse(data.serialized)
    },
  },
})

const serializedInput = ref(``)

const handleSubmit = () => storeSerialized.mutate(serializedInput.value)

watch(storeSerialized.data, () => (serializedInput.value = ``))

watch(response, () => console.log(response.value))
</script>
