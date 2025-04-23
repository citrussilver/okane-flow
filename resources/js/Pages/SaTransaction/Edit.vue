<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SaTransactionForm from './SaTransactionForm.vue';
import { useForm  } from '@inertiajs/vue3';
import { objPushToArray, roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';

const props = defineProps({
    savings_accounts: {
        type: Array,
        required: true
    },
    sa_transaction: {
        type: Object,
        required: true
    }
});

const form = useForm({ ...props.sa_transaction, sa_account_id: props.sa_transaction.savings_acct.id });

console.log(form);

let transactsList = [];

transactsList = objPushToArray(consts.savings_accts_transacts);

const update = () => {

    form.savings_acct = props.savings_accounts.find(savings_acct => form.sa_account_id === savings_acct.id);

    if(form.transact_type_id === consts.savings_accts_transacts.deposit.id || form.transact_type_id === consts.savings_accts_transacts.earn_interest.id || form.transact_type_id === consts.savings_accts_transacts.salary_income.id) {
        form.post_balance = parseFloat(form.current_balance) + parseFloat(form.amount);
    } else {
        form.post_balance = parseFloat(form.current_balance) - parseFloat(form.amount);
    }

    form.post_balance = roundNumber(form.post_balance, 2);

    form.put(route('sa-transactions.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Savings Acct Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <SaTransactionForm :form="form" :savings_accounts="savings_accounts" :transactsList="transactsList" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>