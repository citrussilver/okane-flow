<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { getUser } from '@/functions/helpers.js';
import { useCrud } from '@/composables/useCrud';
import consts from '@/constants/constants.js';
import DataTable from '@/Components/DataTable.vue';

const user = getUser();
// for admin activities that require permission
const form = useForm({
    role_id: user.role_id
})

defineProps({
    cc_transactions: {
        type: Array,
        required: true
    }
});

// const { confirmDelete } = useCrud('multi-word-route', { toast: true, snackbar: true });
const { confirmDelete } = useCrud('cc-transactions', { toast: true });

</script>

<template>
    <Head title="Credit Card Transactions" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Credit Card Transactions
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-screen sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg dark:bg-gray-800">
                    <div class="m-4 flex justify-between" v-if="form.role_id == 1">
                        <div class="text-gray-900 dark:text-gray-100">Credit Card Transactions</div>
                        <Link :href="route('cc-transactions.create')" class="bg-ceil hover:bg-jp-indigo px-4 py-1 rounded-full text-white active:translate-y-1">+ CC Transaction</Link>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="p-4">
                            <DataTable 
                                :cols="consts.CC_TRANSACTS_COLS" 
                                :rows="cc_transactions" 
                                @edit-row="(row) => router.visit(route('sa-transactions.edit', row.id))" 
                                @delete-row="confirmDelete" 
                                selectable 
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>