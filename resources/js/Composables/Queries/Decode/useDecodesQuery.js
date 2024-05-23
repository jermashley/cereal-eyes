import { useQuery } from '@tanstack/vue-query'
import axios from 'axios'

const fetchDecodes = async () => {
  const data = await axios.get(route(`api.decode.index`))

  return data
}

export const useDecodesQuery = ({ config = {} } = {}) =>
  useQuery({
    queryKey: [`decodes`],
    queryFn: fetchDecodes,

    ...config,
  })
