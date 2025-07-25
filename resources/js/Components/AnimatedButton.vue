<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'button',
  },
  color: {
    type: String,
    default: 'red-600',
  },
  disabled: {
    type: Boolean,
    default: false,
  },
})
</script>
<template>
    <button
      :type="type"
      :disabled="disabled"
      class="h-[40px] text-white text-sm px-2 rounded border border-transparent
             active:enabled:translate-y-1 transform transition duration-100 ease-in-out
             flex items-center justify-center
             disabled:opacity-50
             hover:brightness-110
             bg-[[color]]"
      :class="[
        `bg-${color}`,
        'dark:text-white',
        disabled && 'cursor-not-allowed',
      ]"
    >
      <slot />
    </button>
</template>