<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import SavingsAccountForm from './SavingsAccountForm.vue';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

defineProps({
    // probably mobile number
})

const form = useForm({
    bank_name: '',
    bank_abbrev: '',
    account_number: '',
    balance: '1'
});

let transactsList = [];

transactsList = objPushToArray(consts.savings_accts_transacts);

const store = () => {

    form.post(route('savings-accounts.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Savings Account" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Savings Account
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <SavingsAccountForm :form="form" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>