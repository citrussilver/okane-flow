// useModal.js
import { reactive } from 'vue'

const raModal = reactive({
  show: false,
  modalText: '',
})

let resolver = null

function showModal(message = '') {
  raModal.modalText = message
  raModal.show = true

  return new Promise((resolve) => {
    resolver = resolve
  })
}

function confirm() {
  raModal.show = false
  resolver?.(true)
  resolver = null
}

function cancel() {
  raModal.show = false
  resolver?.(false)
  resolver = null
}

export function useModal() {
  return {
    raModal,
    showModal,
  }
}

export { confirm, cancel }
