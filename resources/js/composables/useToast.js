// composables/useToast.js
import { reactive, ref } from 'vue'

const displayToast = ref(false)
const toastType = ref('')
const raToast = reactive({
  toastText: '',
  toastType: ''
})

let toastTimeoutId = null

function handleShowToast(message, type, duration = 3000) {
  if (toastTimeoutId) {
    clearTimeout(toastTimeoutId)
  }

  displayToast.value = true
  raToast.toastText = message
  raToast.toastType = type

  toastTimeoutId = setTimeout(() => {
    displayToast.value = false
    toastTimeoutId = null
  }, duration)
}

function hideToast() {
  raToast.show = false
}

export function useToast() {
  return {
    raToast,
    hideToast,
    displayToast,
    handleShowToast
  }
}