<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useNavItemClasses } from '@/composables/useNavItemClasses';

const open = ref(false)
const dropdownRef = ref(null)

function toggleDropdown() {
  open.value = !open.value
}

const props = defineProps({
  label: { type: String, required: true },
  active: { type: Boolean, default: false },
  links: {
    type: Array,
    required: true, // [{ label: 'Sub Link', href: '/path' }]
  },
});

const toggle = () => (open.value = !open.value);

// Shared classes
const buttonClasses = useNavItemClasses(computed(() => props.active));

function handleClickOutside(event) {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    open.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
  <div ref="dropdownRef" class="relative">
    <!-- Trigger button (match NavLink structure) -->
    <button 
        id="dropdownButton" 
        data-dropdown-toggle="dropdownMenu" 
        @click="toggle" 
        type="button" 
        :class="buttonClasses + ' flex items-center justify-center h-[42px] px-3'"
    >
      <slot />
      <svg
        class="w-4 h-4 transition-transform" 
        :class="{ 'rotate-180': open }" 
        fill="none" 
        stroke="currentColor" 
        viewBox="0 0 24 24"
      >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>

    <!-- Dropdown menu -->
    <div 
        id="dropdownMenu" 
        v-show="open" 
        class="absolute left-0 top-full mt-2 z-50 ring-1 ring-olivine-500/50 dark:ring-inbike-green w-48 origin-top-left rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
    >
      <div class="py-1">
        <Link
          v-for="(link, index) in links"
          :key="index"
          :href="link.href"
          class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
        >
          {{ link.label }}
        </Link>
      </div>
    </div>
  </div>
</template>
