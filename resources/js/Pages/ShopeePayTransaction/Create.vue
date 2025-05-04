<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ShopeePayTransactionForm from './ShopeePayTransactionForm.vue';
import { roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

defineProps({
    shopee_pays: {
        type: Array,
        required: true
    }
})

const form = useForm({
    shopee_pay_id: 1,
    date_time: '',
    transact_type_id: -1,
    description: '',
    current_balance: 0,
    amount: 1,
    post_balance: 0,
    remarks: '',
    order_sn: '',
    reference_id: ''
});

let transactsList = [];

transactsList = objPushToArray(consts.shopee_pay_transacts);

const store = () => {
    
    if(form.transact_type_id == consts.shopee_pay_transacts.cash_in.id || form.transact_type_id == consts.shopee_pay_transacts.refund.id) {
        form.post_balance = parseFloat(form.current_balance) + parseFloat(form.amount);
    } else {
        form.post_balance = parseFloat(form.current_balance) - parseFloat(form.amount);
    }

    form.post_balance = roundNumber(form.post_balance, 2)


    form.post(route('shopee-pay-transactions.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New ShopeePay Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ShopeePay Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <ShopeePayTransactionForm :form="form" :shopee_pays="shopee_pays" :transactsList="transactsList" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>