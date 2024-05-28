import { useMutation } from '@tanstack/vue-query'
import axios from 'axios'

const destroyAllDecodes = async () => {
  const { data } = await axios.delete(route(`api.decode.destroyAll`))

  return data
}

export const useDestroyAllDecodeMutation = ({ config = {} } = {}) =>
  useMutation({
    mutationKey: [`decode`, `store`],
    mutationFn: () => destroyAllDecodes(),

    ...config,
  })
