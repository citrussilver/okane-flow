<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import CcTransactionForm from './CcTransactionForm.vue';
import { roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

const props = defineProps({
    credit_cards: {
        type: Array,
        required: true
    }
})

const form = useForm({
    credit_card_id: 1,
    date_time: '',
    description: '',
    transact_type_id: -1,
    current_credit_limit: 0,
    amount: 1,
    post_credit_limit: 0,
    remarks: '',
    ref_no: ''
});

let transactsList = [];

transactsList = objPushToArray(consts.cc_transacts);

const store = () => {
    
    if(form.transact_type_id === consts.cc_transacts.cc_refund.id || form.transact_type_id === consts.cc_transacts.adjustment_2.id) {
        form.post_credit_limit = parseFloat(form.current_credit_limit) + parseFloat(form.amount);
    } else {
        form.post_credit_limit = parseFloat(form.current_credit_limit) - parseFloat(form.amount);
    }

    form.post_credit_limit = roundNumber(form.post_credit_limit, 2);

    form.post(route('cc-transactions.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Credit Card Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Credit Cards Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <CcTransactionForm :form="form" :credit_cards="credit_cards" :transactsList="transactsList" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>