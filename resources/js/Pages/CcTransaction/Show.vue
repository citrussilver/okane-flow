<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, Link  } from '@inertiajs/vue3';

defineProps({
    cc_transaction: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Show Credit Card Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                Show Credit Card Transaction
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
                                        <FormInputLabel for="credit_card_id" value="Savings Acct" />
                                        <FormLabel>{{ cc_transaction.credit_card == null ? 'N/A' : cc_transaction.credit_card.cc_name }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="date_time" value="Date Time" />
                                        <FormLabel>{{ cc_transaction.date_time }}</FormLabel>
                                    </ElementsGrouper>

                                    <!-- <ElementsGrouper>
                                        <FormInputLabel for="transact_type_id" value="Transact Type ID" />
                                        <FormLabel>{{ cc_transaction.transact_type_id }}</FormLabel>
                                    </ElementsGrouper> -->

                                    <ElementsGrouper>
                                        <FormInputLabel for="description" value="Description" />
                                        <FormLabel>{{ cc_transaction.description }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="current_credit_limit" value="Current Credit Limit" />
                                        <FormLabel>{{ cc_transaction.current_credit_limit }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="amount" value="Amount" />
                                        <FormLabel>{{ cc_transaction.amount }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="post_credit_limit" value="Post Credit Limit" />
                                        <FormLabel>{{ cc_transaction.post_credit_limit }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="remarks" value="Remarks" />
                                        <FormLabel>{{ cc_transaction.remarks }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="ref_no" value="Ref. No." />
                                        <FormLabel>{{ cc_transaction.ref_no }}</FormLabel>
                                    </ElementsGrouper>


                                    <BlockWideElementsGrouper>
                                        <Link :href="route('cc-transactions.edit', cc_transaction.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-hidden focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                        <Link :href="route('cc-transactions.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
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