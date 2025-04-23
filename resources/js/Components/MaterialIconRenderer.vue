<script setup>
defineProps({
    mIcon: {
        type: String,
    },
    textLabel: {
        type: String,
    },
});
</script>
<template>
    <div class="flex gap-x-2 items-center">
        <span class="material-symbols-outlined">
            {{ mIcon }}
        </span>
        <p>{{ textLabel }}</p>
    </div>
</template>