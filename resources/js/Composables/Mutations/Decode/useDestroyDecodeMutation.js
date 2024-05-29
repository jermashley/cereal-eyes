import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const destroyDecode = async (decodeId) => {
  const { data } = await axios.delete(route(`api.decode.destroy`, decodeId))

  return data
}

export const useDestroyDecodeMutation = ({
  config = {},
  decodeId = null,
} = {}) =>
  useMutation({
    mutationKey: [`decode`, `destroy`, decodeId],
    mutationFn: () => destroyDecode(decodeId),

    ...config,
  })
