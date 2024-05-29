<script setup>
import { faEye } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useQueryClient } from '@tanstack/vue-query'
import dayjs from 'dayjs'
import localizedFormat from 'dayjs/plugin/LocalizedFormat'

import { Badge } from '@/Components/ui/badge'
import { Button } from '@/Components/ui/button'
import { Card, CardContent } from '@/Components/ui/card'
import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/Components/ui/sheet'
import { useDestroyAllDecodeMutation } from '@/Composables/Mutations/Decode'
import { useGetDecodesQuery } from '@/Composables/Queries/Decode'

import DestroyDecode from './DestroyDecode.vue'
import ShowDecode from './ShowDecode.vue'

const queryClient = useQueryClient()

const { data: decodes, isSuccess } = useGetDecodesQuery()

const { mutate: destroyAllDecodes } = useDestroyAllDecodeMutation({
  config: {
    onSuccess: () => queryClient.invalidateQueries([`decodes`]),
  },
})

dayjs.extend(localizedFormat)
</script>

<template>
  <Sheet>
    <SheetTrigger class="mb-16 w-full" as-child>
      <Button class="w-full" variant="secondary">Old Decodes</Button>
    </SheetTrigger>

    <SheetContent
      class="flex w-full max-w-2xl flex-col items-stretch justify-start sm:max-w-md"
    >
      <SheetHeader>
        <SheetTitle>Decodes</SheetTitle>
      </SheetHeader>

      <div
        v-if="decodes.length >= 1 && isSuccess"
        class="mt-4 flex flex-grow flex-col space-y-4 overflow-y-auto"
      >
        <Card v-for="decode in decodes" :key="decode.uuid" class="group">
          <CardContent class="px-4 py-2">
            <div class="grid grid-cols-12 grid-rows-2 gap-x-2 gap-y-1">
              <div class="col-start-1 col-end-10 row-start-1 row-end-2">
                <span class="text-xs">
                  {{ dayjs(decode?.created_at).format(`LLL`) }}
                </span>
              </div>

              <div
                class="col-start-10 col-end-13 row-start-1 row-end-3 flex flex-row content-center items-center justify-end space-x-2 justify-self-end opacity-0 transition-opacity duration-200 group-hover:opacity-100"
              >
                <DestroyDecode :id="decode.id" />

                <ShowDecode :id="decode.id" />
              </div>

              <div class="col-start-1 col-end-10 row-start-2 row-end-3">
                <Badge variant="secondary">{{ decode?.type?.name }}</Badge>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      <div
        v-else
        class="mt-4 flex flex-grow flex-col items-center justify-center space-y-2 overflow-y-auto"
      >
        <p class="text-lg text-zinc-600 dark:text-zinc-300">
          No decodes...yet!
        </p>
      </div>

      <!-- <SheetFooter>
        <SheetClose as-child>
          <Button size="sm" variant="secondary">Close</Button>
        </SheetClose>

        <Button size="sm" variant="destructive" @click="destroyAllDecodes">
          Delete all
        </Button>
      </SheetFooter> -->
    </SheetContent>
  </Sheet>
</template>
