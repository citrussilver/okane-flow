<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import MayaTransactForm from './MayaTransactForm.vue';
import { roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

defineProps({
    maya_accounts: {
        type: Array,
        required: true
    }
})

const form = useForm({
    maya_id: 1,
    date_time: '',
    transact_type_id: -1,
    current_balance: 0,
    amount: 1,
    post_balance: 0,
    remarks: '',
    reference_id: ''
});

let transactsList = [];

transactsList = objPushToArray(consts.maya_transacts);

const store = () => {
    
    if(form.transact_type_id == consts.maya_transacts.cash_in.id || form.transact_type_id == consts.maya_transacts.refund.id || form.transact_type_id === consts.maya_transacts.adjustment_2.id) {
        form.post_balance = parseFloat(form.current_balance) + parseFloat(form.amount);
    } else {
        form.post_balance = parseFloat(form.current_balance) - parseFloat(form.amount);
    }

    form.post_balance = roundNumber(form.post_balance, 2)


    form.post(route('maya-transactions.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Maya Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Maya Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <MayaTransactForm :form="form" :maya_accounts="maya_accounts" :transactsList="transactsList" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>