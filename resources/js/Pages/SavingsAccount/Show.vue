<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, Link  } from '@inertiajs/vue3';

defineProps({
    savings_account: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Show Savings Account" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                Show Savings Account
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <!-- Form -->
                        <form class="relative bg-white rounded-lg shadow-sm dark:bg-gray-800">
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <ElementsGrouper>
                                        <FormInputLabel for="bank_name" value="Bank Name" />
                                        <FormLabel>{{ savings_account.bank_name }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="bank_abbrev" value="Bank Abbrev" />
                                        <FormLabel>{{ savings_account.bank_abbrev }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="account_number" value="Account #" />
                                        <FormLabel>{{ savings_account.account_number }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="balance" value="Balance" />
                                        <FormLabel>{{ savings_account.balance_wc }}</FormLabel>
                                    </ElementsGrouper>


                                    <BlockWideElementsGrouper>
                                        <Link :href="route('savings-accounts.edit', savings_account.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-hidden focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                        <Link :href="route('savings-accounts.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                                    </BlockWideElementsGrouper>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>