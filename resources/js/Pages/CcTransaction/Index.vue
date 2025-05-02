<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm} from '@inertiajs/vue3';
import { getUser, deleteRow, checkIfArrayExists } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import ConfirmDialog from '@/volt/ConfirmDialog.vue';
import Toast from '@/volt/Toast.vue';
import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast';

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
})

const confirm = useConfirm();
const toast = useToast();

const confirmDelete = (row, route) => {

    confirm.require({
        message: consts.toasts_detail.delete.message,
        header: consts.toasts_detail.delete.header,
        rejectProps: {
            label: 'Cancel',
            severity: 'secondary',
            outlined: true
        },
        acceptProps: {
            label: 'Confirm'
        },
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmed', detail: consts.toasts_detail.delete.confirm, life: 3000 });
            deleteRow(row, route)
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: consts.toasts_detail.delete.cancel, life: 3000 });
        }
    });
};
</script>

<template>
    <Head title="Credit Card Transactions" />

    <Toast />
    <ConfirmDialog />

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
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-jp-indigo uppercase bg-azureish-white border-b">
                                <tr>
                                    <th v-for="col in consts.cc_transacts_cols" class="px-6 py-3">
                                        {{ col }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cc_transaction in cc_transactions" :key="cc_transaction.id" class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-independence">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.id }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.credit_card == null ? 'N/A' : cc_transaction.credit_card.cc_name }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.date_time_em }}
                                    </td>
                                    <!-- <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.transact_type_id }}
                                    </td> -->
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        <div class="line-clamp-1">
                                            {{ cc_transaction.description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.current_credit_limit_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.amount_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.post_credit_limit_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        <div class="line-clamp-1">
                                            {{ cc_transaction.remarks }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ cc_transaction.ref_no }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2" v-if="form.role_id == 1">
                                        <Link :href="route('cc-transactions.show', cc_transaction.id)"  class="font-medium text-gray-600 hover:underline pr-4">Show</Link>
                                        <Link :href="route('cc-transactions.edit', cc_transaction.id)" class="font-medium text-blue-600 hover:underline pr-4">Edit</Link>
                                        <a href="#" class="font-medium text-red-600 hover:underline" @click.prevent="confirmDelete(cc_transaction, 'cc-transactions')">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Temporary Pagination Template -->
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between py-2 px-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-700 mb-4 md:mb-0 block w-full md:inline md:w-auto dark:text-gray-100">Showing <span class="font-semibold text-gray-700 dark:text-gray-100">1-{{ checkIfArrayExists(cc_transactions) }}</span> of <span class="font-semibold text-gray-700 dark:text-gray-100">1</span></span>
                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">1</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>