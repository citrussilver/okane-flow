<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import { propsParser } from '@/functions/helpers';


const selected_acct_balance = ref('');

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    credit_cards: {
        type: Array,
        required: true
    },
    transactsList: {
        type: Array,
        required: true
    },
    operation: {
        type: String,
    }
});

const refDateTime = ref('');

// to properly parse date_time to html datetime-local tag
propsParser(refDateTime, props.form.date_time);

const handleCurrentBalance = () => {
    props.form.credit_card = props.credit_cards.find(credit_card => props.form.credit_card_id === credit_card.id);
            
    props.form.current_credit_limit = props.form.credit_card.avail_credit_limit;
    propsParser(selected_acct_balance, props.form.current_credit_limit);
}

const trackSelection = (val, target) => {

    if(target == 'credit_card') {
        handleCurrentBalance();
    }

    if(target == 'transact_type') {
        props.form.transact_type = props.transactsList.find(transaxn => props.form.transact_type_id === transaxn.id);
        props.form.remarks = `[${props.form.transact_type.name}] `;
    }
};

// call in template
const emit = defineEmits(['submit']);

onMounted(() => {
    handleCurrentBalance();
});

</script>

<template>
    <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="credit_card_id" value="Credit Card" />
                    <select 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="credit_card_id" 
                        v-model="form.credit_card_id" id="credit_card_id" 
                        @change="trackSelection($event.target.selectedIndex, 'credit_card')"
                    >
                        <option value="-1" disabled>-- Select Credit Card --</option>
                        <option v-for="credit_card in credit_cards" :key="credit_card.id" :value="credit_card.id">ID: {{ credit_card.id }} - {{ credit_card.cc_name }} - {{ credit_card.last_4_digits }}</option>
                    </select>
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="date_time" value="Date" />
                    <input type="datetime-local" id="date_time" v-model="form.date_time" class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <InputError class="mt-2" :message="form.errors.date_time" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="transact_type_id" value="Transaction" />
                    <select 
                        id="transact_type_id" 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="transact_type_id" 
                        v-model="form.transact_type_id" 
                        @change="trackSelection($event.target.selectedIndex, 'transact_type')"
                    >
                        <option value="-1" disabled>-- Select Transaction --</option>
                        <option v-for="transaction in transactsList" :key="transaction.id" :value="transaction.id">{{ transaction.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.transact_type_id" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="current_credit_limit" value="Avail Credit Limit" />
                    <input 
                        id="current_credit_limit" 
                        type="text" 
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.current_credit_limit" 
                        disabled
                    />
                    <InputError class="mt-2" :message="form.errors.current_credit_limit" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="amount" value="Amount" />
                    <input
                        id="amount"
                        type="text"
                        class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.amount" 
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.amount" />
                </ElementsGrouper>

                <BlockWideElementsGrouper>
                    <FormInputLabel for="description" value="Description" />
                    <TextInput
                        id="description"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.description" 
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.description" />
                </BlockWideElementsGrouper>

                <BlockWideElementsGrouper>
                    <FormInputLabel for="remarks" value="Remarks" />
                    <textarea name="remarks" v-model="form.remarks" id="description" class="shadow-xs border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" rows="3"></textarea>
                    <InputError class="mt-2" :message="form.errors.remarks" />
                </BlockWideElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="ref_no" value="Ref. No." />
                    <TextInput
                        id="ref_no"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.ref_no" 
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.ref_no" />
                </ElementsGrouper>

                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('cc-transactions.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>