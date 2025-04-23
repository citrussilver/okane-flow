<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
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
    <form class="relative bg-white rounded-lg shadow dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <ElementsGrouper>
                    <FormInputLabel for="bank_name" value="Bank Name" />
                    <TextInput 
                        id="bank_name" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.bank_name" 
                        required
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="bank_abbrev" value="Bank Abbrev" />
                    <TextInput 
                        id="bank_abbrev" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.bank_abbrev" 
                        required
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="account_number" value="Account #" />
                    <TextInput 
                        id="account_number" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.account_number" 
                        required
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="balance" value="Balance" />
                    <TextInput 
                        id="balance" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.balance" 
                        required
                    />
                </ElementsGrouper>

                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('savings-accounts.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>