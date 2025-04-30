<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

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
    <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <ElementsGrouper>
                    <FormInputLabel for="mobile_number" value="Mobile Number" />
                    <TextInput 
                        id="mobile_number" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.mobile_number" 
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.mobile_number" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="account_nickname" value="Account Nickname" />
                    <TextInput 
                        id="account_nickname" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.account_nickname" 
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.account_nickname" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="last_4_digits" value="Last 4 Digits" />
                    <TextInput 
                        id="last_4_digits" 
                        type="text" 
                        class="mt-1 block w-full"
                        v-model="form.last_4_digits" 
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.last_4_digits" />
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
                    <InputError class="mt-2" :message="form.errors.balance" />
                </ElementsGrouper>

                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('maya-accounts.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>