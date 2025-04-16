<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserForm from './UserForm.vue';
import { Head, useForm} from '@inertiajs/vue3';

const props = defineProps({
    roles: {
        type: Array,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
})

const form = useForm({...props.user, role_id: props.user.role.id})

const update = () => {
    form.role = props.roles.find(role => form.role_id === role.id)

    form.put(route('users.update', form.id), {
        onSuccess: () => form.reset(),
    });
};

</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit User
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <UserForm :form="form" :roles="roles" operation="Update" @submit="update" />

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>