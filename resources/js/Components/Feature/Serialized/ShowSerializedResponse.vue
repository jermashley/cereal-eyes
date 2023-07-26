<template>
  <ResponseTabView
    v-if="currentSerializedResponse.response.value"
    :response="currentSerializedResponse.response.value"
  />
</template>

<script setup>
import ResponseTabView from '@/Components/Feature/Serialized/ResponseTabView.vue'
import { useCurrentSerializedResponse } from '@/Composables/Hooks'

const currentSerializedResponse = useCurrentSerializedResponse()
</script>
