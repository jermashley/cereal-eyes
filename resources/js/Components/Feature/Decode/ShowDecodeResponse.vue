<template>
  <ResponseTabView
    v-if="currentDecodeResponse.response.value"
    :response="currentDecodeResponse.response.value"
  />
</template>

<script setup>
import ResponseTabView from '@/Components/Feature/Decode/ResponseTabView.vue'
import { useCurrentDecodeResponse } from '@/Composables/Hooks'

const currentDecodeResponse = useCurrentDecodeResponse()
</script>
