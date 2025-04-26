<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MayaTransactForm from './MayaTransactForm.vue';
import { useForm  } from '@inertiajs/vue3';
import { objPushToArray, roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';

const props = defineProps({
    maya_accounts: {
        type: Array,
        required: true
    },
    maya_transaction: {
        type: Object,
        required: true
    }
});

const form = useForm({
    ...props.maya_transaction, 
    maya_id: props.maya_transaction.maya_acct.id, 
    current_balance: props.maya_transaction.maya_acct.balance,
    current_balance_wc: props.maya_transaction.maya_acct.balance_wc
});

console.log(form);

let transactsList = [];

transactsList = objPushToArray(consts.maya_transacts);

const update = () => {

    form.maya_acct = props.maya_accounts.find(maya_acct => form.maya_id === maya_acct.id);

    if(form.transact_type_id == consts.maya_transacts.cash_in.id || form.transact_type_id == consts.maya_transacts.refund.id) {
        form.post_balance = parseFloat(form.current_balance) + parseFloat(form.amount);
    } else {
        form.post_balance = parseFloat(form.current_balance) - parseFloat(form.amount);
    }

    form.post_balance = roundNumber(form.post_balance, 2)

    form.put(route('maya-transactions.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Maya Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <MayaTransactForm :form="form" :maya_accounts="maya_accounts" :transactsList="transactsList" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>