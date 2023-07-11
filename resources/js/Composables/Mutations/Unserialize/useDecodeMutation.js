import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const decode = async (serialized) => {
  const data = await axios.post(
    `/api/decode`,
    { serialized: serialized },
    {
      headers: {
        Accept: `application/json`,
      },
    },
  )

  return data
}

export const useDecodeMutation = ({ config = {} } = {}) =>
  useMutation({
    mutationKey: `decode`,
    mutationFn: (serialized) => decode(serialized),

    ...config,
  })
