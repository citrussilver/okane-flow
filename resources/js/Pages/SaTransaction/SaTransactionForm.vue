<script setup>
import FormInputLabel from '@/Components/FormInputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import InputError from '@/Components/InputError.vue';


const selected_acct_balance = ref('');

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    savings_accounts: {
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

// to properly parse date_time to html datetime-local tag
const refDateTime = ref('');

refDateTime.value = props.form.date_time;

const trackSelection = (val, target) => {

    if(target == 'savings_account') {
        // get the balance with comma
        selected_acct_balance.value = props.savings_accounts[val-1].balance_wc;
        // update the form's current balance
        props.form.current_balance = props.savings_accounts[val-1].balance;
    }

    if(target == 'transact_type') {
        props.form.remarks = `[${props.transactsList[val-1].name}] `;
    }
};

// call in template
const emit = defineEmits(['submit']);

onMounted(() => {
    // explicitly display the current balance of the first account

    if(props.operation == 'Update') {
        selected_acct_balance.value = props.form.current_balance_wc;
        props.form.current_balance = props.form.current_balance;
    } else {
        selected_acct_balance.value = props.savings_accounts[0].balance_wc;
        props.form.current_balance = props.savings_accounts[0].balance;
    }
});

</script>

<template>
    <form class="relative bg-white rounded-lg shadow dark:bg-gray-800" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="sa_account_id" value="Savings Acct" />
                    <select 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="role_id" 
                        v-model="form.sa_account_id" id="sa_account_id" 
                        @change="trackSelection($event.target.selectedIndex, 'savings_account')"
                    >
                        <option value="-1" disabled>-- Select Savings Account--</option>
                        <option v-for="savings_account in savings_accounts" :key="savings_account.id" :value="savings_account.id">ID: {{ savings_account.id }} - {{ savings_account.bank_name }} - {{ savings_account.account_number }}</option>
                    </select>
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="date_time" value="Date" />
                    <input type="datetime-local" id="date_time" v-model="form.date_time" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600">
                    <InputError class="mt-2" :message="form.errors.date_time" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="transact_type_id" value="Transaction" />
                    <select 
                        id="transact_type_id" 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        name="transact_type_id" 
                        v-model="form.transact_type_id" 
                        @change="trackSelection($event.target.selectedIndex, 'transact_type')"
                    >
                        <option value="-1" disabled>-- Select Transaction--</option>
                        <option v-for="transaction in transactsList" :key="transaction.id" :value="transaction.id">{{ transaction.name }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.transact_type_id" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="current_balance" value="Current Balance" />
                    <input 
                        id="current_balance" 
                        type="text" 
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="selected_acct_balance" 
                        disabled
                    />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="amount" value="Amount" />
                    <input
                        id="amount"
                        type="text"
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.amount" 
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.amount" />
                </ElementsGrouper>

                <div class="col-span-6 sm:col-span-6">
                    <FormInputLabel for="remarks" value="Remarks" />
                    <textarea name="remarks" v-model="form.remarks" id="description" class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" rows="3"></textarea>
                    <InputError class="mt-2" :message="form.errors.remarks" />
                </div>

                <ElementsGrouper>
                    <FormInputLabel for="location" value="Location" />
                    <input
                        id="location"
                        type="text"
                        class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                        v-model="form.location" 
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.location" />
                </ElementsGrouper>

                <ElementsGrouper>
                    <FormInputLabel for="ref_id" value="Ref. #" />
                    <TextInput
                        id="ref_id"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.reference_number" 
                        required
                        autofocus
                    />
                </ElementsGrouper>


                <BlockWideElementsGrouper>
                    <AltButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        {{ operation }}
                    </AltButton>
                    <Link :href="route('sa-transactions.index')" as="button" :disabled="form.processing" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                </BlockWideElementsGrouper>
            </div>
        </div>
    </form>
</template>