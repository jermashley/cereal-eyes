import { usePreferredColorScheme, useStorage } from '@vueuse/core'
import { watch } from 'vue'

export const useSystemTheme = () => {
  const preferredColorScheme = usePreferredColorScheme()

  const theme = useStorage(`theme`, preferredColorScheme.value)

  const body = document.body

  const setTheme = (themeValue) => {
    console.log(themeValue)
    theme.value = themeValue

    body.classList.toggle(`dark`)
  }

  watch(theme, (value) => setTheme(value))

  return {
    theme,
    setTheme,
  }
}
