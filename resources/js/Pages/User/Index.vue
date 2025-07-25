<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { getUser } from '@/functions/helpers.js';
import { useCrud } from '@/composables/useCrud';
import consts from '@/constants/constants.js';
import DataTable from '@/Components/DataTable.vue';

const user = getUser();

const form = useForm({
    full_name: user.full_name,
    role_id: user.role_id
});

defineProps({
    // explicitly define as type Array coz Laravel Resource makes it an array
    users: {
        type: Array,
        required: true
    }
})


// const { confirmDelete } = useCrud('multi-word-route', { toast: true, snackbar: true });
const { confirmDelete } = useCrud('users', { toast: true });

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg dark:bg-gray-800">
                    <div class="m-4 flex justify-between" v-if="form.role_id == 1">
                        <div class="text-gray-900 dark:text-gray-100">Manage Users</div>
                        <Link :href="route('users.create')" class="bg-ceil hover:bg-jp-indigo dark:hover:bg-independence px-4 py-1 rounded-full text-white active:translate-y-1">+ User</Link>
                    </div>
                    <div class="p-4">
                        <DataTable 
                            :cols="consts.USER_TABLE_COLS" 
                            :rows="users" 
                            @edit-row="(row) => router.visit(route('users.edit', row.id))" 
                            @delete-row="confirmDelete" 
                            selectable 
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>