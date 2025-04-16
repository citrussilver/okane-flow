<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    operation: {
        type: String,
    }
});

// call in template
const emit = defineEmits(['submit'])
</script>

<template>
    <form class="relative bg-white rounded-lg shadow" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="name" value="Role name" />
                    <TextInput 
                        id="name" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.name" 
                        required
                    />
                </div>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="description" value="Description" />
                    <textarea name="description" v-model="form.description" id="description" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" rows="3"></textarea>
                </div>


                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('roles.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>