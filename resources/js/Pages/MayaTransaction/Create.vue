<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import MayaTransactForm from './MayaTransactForm.vue';
import { roundNumber } from '@/functions/helpers.js';

defineProps({
    maya_accounts: {
        type: Array,
        required: true
    }
})

const form = useForm({
    maya_id: 1,
    date_time: '',
    transact_type_id: 1,
    current_maya_balance: 0,
    amount: 1,
    post_maya_balance: 0,
    remarks: '',
    reference_id: ''
});

const store = () => {
    console.log(`form.amount: ${form.amount}`);

    if(form.amount > 0) {
        form.post_maya_balance = parseFloat(form.current_maya_balance) - parseFloat(form.amount);
        form.post_maya_balance = roundNumber(form.post_maya_balance, 2)
    }

    console.log(`form.post_maya_balance: ${form.post_maya_balance}`);

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

                        <MayaTransactForm :form="form" :maya_accounts="maya_accounts" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>