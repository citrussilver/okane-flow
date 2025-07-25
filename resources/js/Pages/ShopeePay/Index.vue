<script setup>
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
    shopee_pays: {
        type: Array,
        required: true
    }
})

// const { confirmDelete } = useCrud('multi-word-route', { toast: true, snackbar: true });
const { confirmDelete } = useCrud('shopee-pays', { toast: true });
</script>

<template>
    <Head title="ShopeePay Wallets" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                ShopeePay Wallets
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-screen sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg dark:bg-gray-800">
                    <!-- header label -->
                    <div class="m-4 flex justify-between" v-if="form.role_id == 1">
                        <div class="text-gray-900 dark:text-gray-100">ShopeePay Wallets</div>
                        <Link :href="route('shopee-pays.create')" class="bg-ceil hover:bg-jp-indigo px-4 py-1 rounded-full text-white active:translate-y-1">
                            + ShopeePay Wallet
                        </Link>
                    </div>


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="p-4">
                            <DataTable 
                                :cols="consts.SHOPEE_PAY_COLS" 
                                :rows="shopee_pays"
                                @edit-row="(row) => router.visit(route('shopee-pays.edit', row.id))" 
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