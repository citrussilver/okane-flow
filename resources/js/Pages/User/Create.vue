<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserForm from './UserForm.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    roles: {
        type: Array,
        required: true
    }
})

const form = useForm({
    full_name: '',
    email: '',
    role_id: 0,
    password: '',
    password_confirmation: ''
})

const store = () => {
    form.post(route('users.store'), {
        onSuccess: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <Head title="New User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                New User
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <UserForm :form="form" :roles="roles" operation="Save" @submit="store" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>