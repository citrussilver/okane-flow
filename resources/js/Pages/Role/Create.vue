<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import RoleForm from './RoleForm.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: ''
})

const store = () => {
    form.post(route('roles.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                New Role
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <RoleForm :form="form" operation="Save" @submit="store" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>