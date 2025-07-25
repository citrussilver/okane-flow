import { defineStore } from 'pinia'
import { ref, onMounted, onUnmounted } from 'vue'

export const useLayoutStore = defineStore('layout', () => {
  const isSidebarCollapsed = ref(false)
  const isMobileSidebarOpen = ref(false)
  const isMobile = ref(window.innerWidth <= 768)

  function updateIsMobile() {
    isMobile.value = window.innerWidth <= 768
  }

  onMounted(() => {
    updateIsMobile()
    window.addEventListener('resize', updateIsMobile)
  })

  onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile)
  })

  return { 
    isSidebarCollapsed, 
    isMobileSidebarOpen, 
    isMobile
  }
});