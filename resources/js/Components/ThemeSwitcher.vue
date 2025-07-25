<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Icon } from '@iconify/vue'
import { useLayoutStore } from '@/stores/layoutStore.js';

const layoutStore = useLayoutStore();

const options = [
  { value: 'light', label: 'Light', icon: 'flowbite:sun-solid' },
  { value: 'dark', label: 'Dark', icon: 'flowbite:moon-solid' },
  { value: 'system', label: 'System', icon: 'heroicons-solid:computer-desktop' }
]

const isOpen = ref(false)
const currentOption = ref(localStorage.getItem('color-theme') || 'system')
const dropdownRef = ref(null) // This will point to the outer div

const iconFor = (mode) =>
  options.find((o) => o.value === mode)?.icon || options[2].icon

const applyTheme = (mode) => {
  document.documentElement.classList.remove('dark') // ensure reset first

  if (mode === 'dark') {
    document.documentElement.classList.add('dark')
  } else if (mode === 'system') {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
    if (prefersDark) document.documentElement.classList.add('dark')
  }
}

const setTheme = (mode) => {
  currentOption.value = mode
  localStorage.setItem('color-theme', mode)
  applyTheme(mode)
  // console.log('Mode:', currentOption.value)
  isOpen.value = false
}

const toggleDropdown = () => {
  isOpen.value = !isOpen.value
}

// Close on outside click
const handleClickOutside = (event) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    isOpen.value = false
  }
}

onMounted(() => {
  // console.log('Mode:', currentOption.value)
  applyTheme(currentOption.value)

  document.addEventListener('click', handleClickOutside)

  // Auto update on system theme change
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (currentOption.value === 'system') {
      applyTheme('system')
    }
  })
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
  <div ref="dropdownRef">
    <!-- Toggle Button -->
    <button
      @click="toggleDropdown"
      aria-haspopup="true"
      class="p-2 rounded-lg text-gray-500 hover:bg-lite-steel-blue dark:text-gray-400 dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700"
    >
      <Icon :icon="iconFor(currentOption)" class="w-5 h-5 hover:text-pokedex-electric" />
    </button>

    <!-- Dropdown (same for mobile and desktop) -->
    <transition name="fade">
      <div
        v-if="isOpen"
        class="absolute top-full left-0 right-0 w-full max-w-full md:w-48 md:left-auto md:right-0 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50"
      >
        <ul class="flex flex-col w-full font-medium">
          <li
            v-for="opt in options"
            :key="opt.value"
            class="border-b border-gray-200 p-2 dark:border-gray-700 last:border-b-0"
          >
            <a
              href="#"
              @click.prevent="setTheme(opt.value)"
              class="flex items-center px-4 py-3 text-sm text-gray-900 dark:text-gray-200 hover:bg-lite-steel-blue dark:hover:bg-gray-700 dark:hover:text-inbike-green hover:text-cafe-noir rounded-sm"
            >
              <Icon :icon="opt.icon" class="w-5 h-5 mr-3 shrink-0" />
              <span class="flex-1 truncate">{{ opt.label }}</span>
            </a>
          </li>
        </ul>
      </div>
    </transition>
  </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 150ms ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
