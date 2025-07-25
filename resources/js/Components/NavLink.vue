<script setup>
import { useNavItemClasses } from '@/composables/useNavItemClasses';
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = useNavItemClasses(computed(() => props.active));
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
