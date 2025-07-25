<script setup>
import { onMounted, ref, computed } from 'vue';

const props = defineProps({
    type: {
        type: String,
        default: 'text',
    },
    id: {
        type: String,
        required: false,
    },
    class: {
        type: String,
        default: '',
    },
    required: {
        type: Boolean,
        default: false,
    },
    autocomplete: {
        type: String,
        default: '',
    },
});

const model = defineModel({ type: String, required: true });

const input = ref(null);
const showPassword = ref(false);

const inputType = computed(() => {
    return props.type === 'password' && showPassword.value ? 'text' : props.type;
});

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};
</script>

<template>
    <div class="relative w-full">
        <input
            :id="id"
            :type="inputType"
            :required="required"
            :autocomplete="autocomplete"
            v-model="model"
            ref="input"
            class="block w-full pr-10 rounded-md border-gray-300 shadow-xs focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
            :class="class"
        />

        <!-- Eye toggle button (only for password type) -->
        <button
            v-if="props.type === 'password'"
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
            @click="togglePasswordVisibility"
        >
             <svg v-if="showPassword" class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-4 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <svg v-else class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <span class="sr-only">Toggle password visibility</span>
        </button>
    </div>
</template>
