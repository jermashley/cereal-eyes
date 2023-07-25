import { useQuery } from '@tanstack/vue-query'
import axios from 'axios'

const getSerializedById = async (id) => {
  const data = await axios.get(`/api/serialized/${id}`)

  return data
}

export const useShowSerializedById = ({ config = {}, id = undefined } = {}) =>
  useQuery({
    queryKey: [`serialized`, id],
    queryFn: () => getSerializedById(id),

    ...config,
  })
