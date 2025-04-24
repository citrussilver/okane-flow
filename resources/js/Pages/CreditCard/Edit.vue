<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreditCardForm from './CreditCardForm.vue';
import { useForm  } from '@inertiajs/vue3';

const props = defineProps({
    credit_card: {
        type: Object,
        required: true
    }
})

const form = useForm({...props.credit_card})

const update = () => {

    form.put(route('credit-cards.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Credit Card
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <CreditCardForm :form="form" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>