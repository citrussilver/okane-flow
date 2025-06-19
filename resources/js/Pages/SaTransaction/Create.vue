<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import SaTransactionForm from './SaTransactionForm.vue';
import { roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

const props = defineProps({
    savings_accounts: {
        type: Array,
        required: true
    }
})

const form = useForm({
    sa_account_id: 1,
    transfer_to_sa_account_id: 2, //set this to 2 coz sa_account_id is 1, and to make the watcher run smooth
    date_time: new Date().toISOString(),
    transact_type_id: -1,
    current_balance: 0,
    target_sa_acct_balance: 0,
    amount: 0,
    post_balance: 0,
    remarks: '',
    location: '',
    reference_number: '',
    instaPayFee: 0
});

let transactsList = [];

transactsList = objPushToArray(consts.savings_accts_transacts);

const store = () => {
    
    // add instaPay for now, its zero if transaction is not Transfer Money
    if(form.transact_type_id === consts.savings_accts_transacts.deposit.id || form.transact_type_id === consts.savings_accts_transacts.earn_interest.id || form.transact_type_id === consts.savings_accts_transacts.salary_income.id || form.transact_type_id === consts.savings_accts_transacts.adjustment_2.id) {
        form.post_balance = parseFloat(form.current_balance) + (parseFloat(form.amount) + parseFloat(form.instaPayFee));
    } else {
        form.post_balance = parseFloat(form.current_balance) - (parseFloat(form.amount) + parseFloat(form.instaPayFee));
    }

    form.target_sa_acct_balance = parseFloat(form.target_sa_acct_balance) + parseFloat(form.amount);

    form.post_balance = roundNumber(form.post_balance, 2);

    form.post(route('sa-transactions.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Savings Acct Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Savings Acct Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <SaTransactionForm :form="form" :savings_accounts="savings_accounts" :transactsList="transactsList" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>