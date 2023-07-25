import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const storeSerialized = async (serialized) => {
  const data = await axios.post(
    `/api/serialized`,
    { data: serialized },
    {
      headers: {
        Accept: `application/json`,
      },
    },
  )

  return data
}

export const useStoreSerializedMutation = ({ config = {} } = {}) =>
  useMutation({
    mutationKey: [`serialized`, `store`],
    mutationFn: (serialized) => storeSerialized(serialized),

    ...config,
  })
