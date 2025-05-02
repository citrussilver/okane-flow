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
    },
    cc_transaction: {
        type: Object,
        required: true
    }
})

const form = useForm({
    ...props.cc_transaction,
    credit_card_id: props.cc_transaction.credit_card.id,
    current_credit_limit: props.cc_transaction.credit_card.avail_credit_limit,
    current_credit_limit_wc: props.cc_transaction.credit_card.avail_credit_limit_wc
});

let transactsList = [];

transactsList = objPushToArray(consts.cc_transacts);

const update = () => {
    
    form.credit_card = props.credit_cards.find(credit_card => form.credit_card_id === credit_card.id);

    if(form.transact_type_id === consts.cc_transacts.cc_refund.id) {
        form.post_credit_limit = parseFloat(form.current_credit_limit) + parseFloat(form.amount);
    } else {
        form.post_credit_limit = parseFloat(form.current_credit_limit) - parseFloat(form.amount);
    }

    form.post_credit_limit = roundNumber(form.post_credit_limit, 2);

    form.put(route('cc-transactions.update', form.id), {
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

                        <CcTransactionForm :form="form" :credit_cards="credit_cards" :transactsList="transactsList" operation="Save" @submit="update" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>