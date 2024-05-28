import { useQuery } from '@tanstack/vue-query'
import axios from 'axios'

const fetchDecode = async ({ id = null }) => {
  const { data } = await axios.get(route(`api.decode.show`, id))

  console.log(data)

  return data
}

export const useGetDecodeQuery = ({ id = null, config = {} } = {}) =>
  useQuery({
    queryKey: [`decode`, id],
    queryFn: () => fetchDecode({ id }),

    ...config,
  })
