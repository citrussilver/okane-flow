<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MayaAccountForm from './MayaAccountForm.vue';
import { Head, useForm, Link  } from '@inertiajs/vue3';

const props = defineProps({
    maya_account: {
        type: Object,
        required: true
    }
})

const form = useForm({...props.maya_account})

const update = () => {

    form.put(route('maya-accounts.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Maya Account
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <MayaAccountForm :form="form" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>