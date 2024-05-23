import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const storeDecode = async (formData = {}) => {
  const data = await axios.post(
    route(`api.decode.store`, {
      ...formData,
    }),
  )

  return data
}

export const useStoreDecodeMutation = ({ config = {} } = {}) =>
  useMutation({
    mutationKey: [`decode`, `store`],
    mutationFn: ({ formData }) => storeDecode(formData),

    ...config,
  })
