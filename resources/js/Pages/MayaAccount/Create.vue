<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import MayaAccountForm from './MayaAccountForm.vue';
import { roundNumber } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import { objPushToArray } from '@/functions/helpers.js';

defineProps({
    // probably mobile number
})

const form = useForm({
    mobile_number: '',
    account_nickname: '',
    last_4_digits: '',
    balance: '1'
});

const store = () => {

    form.post(route('maya-accounts.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Maya Account" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Maya Account
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <MayaAccountForm :form="form" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>