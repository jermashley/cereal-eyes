import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const storeDecode = async (decode) => {
  const data = await axios.post(
    `/api/decode`,
    {
      raw: decode,
    },
    {
      headers: {
        Accept: `application/json`,
      },
    },
  )

  return data
}

export const useStoreDecodeMutation = ({ config = {} } = {}) =>
  useMutation({
    mutationKey: [`decode`, `store`],
    mutationFn: (decode) => storeDecode(decode),

    ...config,
  })
