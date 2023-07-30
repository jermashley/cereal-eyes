import { useQuery } from '@tanstack/vue-query'
import axios from 'axios'

const getDecodeById = async (id) => {
  const data = await axios.get(`/api/decode/${id}`)

  return data
}

export const useShowDecodeById = ({ config = {}, id = undefined } = {}) =>
  useQuery({
    queryKey: [`decode`, id],
    queryFn: () => getDecodeById(id),

    ...config,
  })
