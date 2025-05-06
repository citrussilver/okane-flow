<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { getUser, deleteRow, checkIfArrayExists } from '@/functions/helpers.js';
import consts from '@/constants/constants.js';
import ConfirmDialog from '@/volt/ConfirmDialog.vue';
import Toast from '@/volt/Toast.vue';
import { useConfirm } from 'primevue/useconfirm';
import { useToast } from 'primevue/usetoast';
import DataTable from '@/volt/DataTable.vue';
import Column from 'primevue/column';
import { FilterMatchMode } from '@primevue/core/api';
import InputText from '@/volt/InputText.vue';

const user = getUser();
// for admin activities that require permission
const form = useForm({
    role_id: user.role_id
})

const props = defineProps({
    cc_transactions: {
        type: Array,
        required: true
    }
});

const cc_transacts = ref([]);

cc_transacts.value = [...props.cc_transactions]

const cc_transacts_data_cols = ref([]);

cc_transacts_data_cols.value = [...consts.cc_transacts_table];

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

const dataTablePtStyle = ref({...consts.global_data_table_pt_style});
const dataTableSearchPtStyle = ref({...consts.global_data_table_search});

const ccFilterFields = ref(consts.cc_transacts_table.map(q => q.field));

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
});

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
                        <DataTable 
                            :value="cc_transacts" 
                            dataKey="id" 
                            paginator 
                            :rows="10" 
                            v-model:filters="filters" 
                            pt:table="min-w-200" 
                            :pt="dataTablePtStyle" 
                            paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown" 
                            :rowsPerPageOptions="[5, 10, 25]"
                            currentPageReportTemplate="Showing {first} to {last} of {totalRecords} transactions" 
                            :globalFilterFields="ccFilterFields"
                        >
                            <template #header>
                                <div class="flex flex-wrap gap-2 items-center justify-end">
                                    <div class="relative">
                                        <i class="pi pi-search absolute top-1/2 -mt-2 text-surface-400 leading-none start-3 z-1" />
                                        <InputText v-model="filters['global'].value" placeholder="Search..." :pt="dataTableSearchPtStyle" />
                                    </div>
                                </div>
                            </template>
                            <Column v-for="col of cc_transacts_data_cols" :key="col.field" :field="col.field" :header="col.header"></Column>
                            <Column header="Actions">
                                <template #body="slotProps">
                                    <Link :href="route('cc-transactions.show', slotProps.data.id)"  class="font-medium text-gray-600 hover:underline pr-4">Show</Link>
                                    <Link :href="route('cc-transactions.edit', slotProps.data.id)" class="font-medium text-blue-600 hover:underline pr-4">Edit</Link>
                                    <a href="#" class="font-medium text-red-600 hover:underline" @click.prevent="confirmDelete(slotProps.data, 'cc-transactions')">Delete</a>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>