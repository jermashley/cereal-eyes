<script setup>
import { faEye, faPencil, faTrashAlt } from '@fortawesome/pro-duotone-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import dayjs from 'dayjs'
import relativeTime from 'dayjs/plugin/relativeTime'

import { Badge } from '@/Components/ui/badge'
import Button from '@/Components/ui/button/Button.vue'
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card'
import {
  Sheet,
  SheetClose,
  SheetContent,
  SheetFooter,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from '@/Components/ui/sheet'
import { useDecodesQuery } from '@/Composables/Queries/Decode'

const { data: decodes, isSuccess } = useDecodesQuery()
console.log(decodes[0]?.type)

dayjs.extend(relativeTime)
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
        v-if="decodes && isSuccess"
        class="mt-4 flex flex-grow flex-col space-y-2 overflow-y-auto"
      >
        <Card v-for="decode in decodes" :key="decode.uuid">
          <CardHeader>
            <CardTitle
              class="flex flex-row items-center justify-between text-sm font-semibold"
            >
              <span>{{ dayjs(decode?.created_at).fromNow() }}</span>

              <Badge>{{ decode?.type?.name }}</Badge>
            </CardTitle>
          </CardHeader>

          <CardContent>
            <div class="flex flex-row items-center justify-start space-x-2">
              <Button size="iconSm" variant="secondary">
                <FontAwesomeIcon :icon="faEye" fixed-width />
              </Button>

              <Button size="iconSm" variant="secondary">
                <FontAwesomeIcon :icon="faPencil" fixed-width />
              </Button>

              <Button size="iconSm" variant="secondary">
                <FontAwesomeIcon :icon="faTrashAlt" fixed-width />
              </Button>

              <Button size="sm" variant="destructive">Delete</Button>

              <Button size="sm" variant="secondary">Cancel</Button>
            </div>
          </CardContent>
        </Card>
      </div>

      <p v-else class="text-sm text-zinc-600 dark:text-zinc-300">
        No decodes...yet!
      </p>

      <SheetFooter>
        <SheetClose as-child>
          <Button size="sm" variant="secondary">Close</Button>
        </SheetClose>

        <Button size="sm" variant="destructive">Delete all</Button>
      </SheetFooter>
    </SheetContent>
  </Sheet>
</template>
