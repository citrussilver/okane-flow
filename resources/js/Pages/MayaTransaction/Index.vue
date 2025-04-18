<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm} from '@inertiajs/vue3';
import { getUser, deleteRow } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';

const user = getUser();
// for admin activities that require permission
const form = useForm({
    role_id: user.role_id
})

defineProps({
    maya_transactions: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <Head title="Maya Transactions" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Maya Transactions
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-screen sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="m-4 flex justify-between" v-if="form.role_id == 1">
                        <div class="text-gray-900 dark:text-gray-100">Maya Transactions</div>
                        <Link :href="route('maya-transactions.create')" class="bg-ceil hover:bg-jp-indigo px-4 py-1 rounded-full text-white active:translate-y-1">+ Maya Transaction</Link>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-jp-indigo uppercase bg-azureish-white border-b">
                                <tr>
                                    <!-- <th v-for="col in consts.maya_transacts_cols" class="px-6 py-3">
                                        {{ col }}
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Maya ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date Time
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Current Balance
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Post Balance
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Remarks
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reference ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="maya_transaction in maya_transactions" :key="maya_transaction.id" class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-independence">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.id }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.maya_id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.date_time }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.transact_type_id }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.current_maya_balance_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.amount_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.post_maya_balance_wc }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                                        {{ maya_transaction.remarks }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ maya_transaction.reference_id }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2" v-if="form.role_id == 1">
                                        <Link :href="route('maya-transactions.show', maya_transaction.id)"  class="font-medium text-gray-600 hover:underline pr-4">Show</Link>
                                        <Link :href="route('maya-transactions.edit', maya_transaction.id)" class="font-medium text-blue-600 hover:underline pr-4">Edit</Link>
                                        <a href="#" class="font-medium text-red-600 hover:underline" @click.prevent="deleteRow(maya_transaction, 'maya-transactions')">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Temporary Pagination Template -->
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between py-2 px-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-700 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-700">1-{{ maya_transactions.length }}</span> of <span class="font-semibold text-gray-700">1</span></span>
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