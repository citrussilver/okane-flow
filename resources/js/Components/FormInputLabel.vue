<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-100">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
