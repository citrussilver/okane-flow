<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ShopeePayTransactionForm from './ShopeePayTransactionForm.vue';
import { useForm  } from '@inertiajs/vue3';
import { objPushToArray, roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';

const props = defineProps({
    shopee_pays: {
        type: Array,
        required: true
    },
    shopee_pay_transaction: {
        type: Object,
        required: true
    }
});

const form = useForm({
    ...props.shopee_pay_transaction, 
    shopee_pay_id: props.shopee_pay_transaction.shopee_pay.id, 
    current_balance: props.shopee_pay_transaction.shopee_pay.balance,
    current_balance_wc: props.shopee_pay_transaction.shopee_pay.balance_wc
});

console.log(form);

let transactsList = [];

transactsList = objPushToArray(consts.shopee_pay_transacts);

const update = () => {

    form.shopee_pay = props.shopee_pays.find(shopee_pay => form.shopee_pay_id === shopee_pay.id);

    if(form.transact_type_id == consts.shopee_pay_transacts.cash_in.id || form.transact_type_id == consts.shopee_pay_transacts.refund.id) {
        form.post_balance = parseFloat(form.current_balance) + parseFloat(form.amount);
    } else {
        form.post_balance = parseFloat(form.current_balance) - parseFloat(form.amount);
    }

    form.post_balance = roundNumber(form.post_balance, 2)

    form.put(route('shopee-pay-transactions.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit ShopeePay Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <ShopeePayTransactionForm :form="form" :shopee_pays="shopee_pays" :transactsList="transactsList" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>