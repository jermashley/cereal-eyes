import { ref } from 'vue'

const response = ref(null)

export const useCurrentDecodeResponse = () => {
  const clearResponse = () => {
    response.value = null
  }

  const setResponse = (data) => {
    console.log(`setResponseData`, data)
    response.value = data
    console.log(response.value)
  }

  return {
    response,
    setResponse,
    clearResponse,
  }
}
