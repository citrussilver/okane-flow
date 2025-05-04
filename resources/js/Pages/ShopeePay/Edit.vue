<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ShopeePayForm from './ShopeePayForm.vue';
import { useForm  } from '@inertiajs/vue3';

const props = defineProps({
    shopee_pay: {
        type: Object,
        required: true
    }
})

const form = useForm({...props.shopee_pay})

const update = () => {

    form.put(route('shopee-pays.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit ShopeePay Wallet
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <ShopeePayForm :form="form" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>