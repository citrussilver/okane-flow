<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import CreditCardForm from './CreditCardForm.vue';


defineProps({
    // probably mobile number
})

const form = useForm({
    last_4_digits: '',
    cc_name: '',
    credit_limit: 1,
    avail_credit_limit: '1'
});

const store = () => {

    form.post(route('credit-cards.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Credit Cards" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Credit Cards
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <CreditCardForm :form="form" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>