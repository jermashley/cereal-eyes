<template>
  <div v-if="response">
    <ResponseTabView :response="response" />
  </div>
</template>

<script setup>
import ResponseTabView from '@/Components/Feature/Serialized/ResponseTabView.vue'
import { useCurrentSerializedResponse } from '@/Composables/Hooks'

const { response } = useCurrentSerializedResponse()
</script>
