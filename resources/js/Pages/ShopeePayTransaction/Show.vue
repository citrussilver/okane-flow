<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, Link  } from '@inertiajs/vue3';

defineProps({
    shopee_pay_transaction: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Show Shopee Pay Transaction" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                Show Shopee Pay Transaction
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
                                        <FormInputLabel for="shopee_pay_id" value="ShopeePay Wallet" />
                                        <FormLabel>{{ shopee_pay_transaction.shopee_pay == null ? 'N/A' : shopee_pay_transaction.shopee_pay.shopee_username }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="date_time" value="Date Time" />
                                        <FormLabel>{{ shopee_pay_transaction.date_time }}</FormLabel>
                                    </ElementsGrouper>

                                    <!-- <ElementsGrouper>
                                        <FormInputLabel for="transact_type_id" value="Transact Type ID" />
                                        <FormLabel>{{ shopee_pay_transaction.transact_type_id }}</FormLabel>
                                    </ElementsGrouper> -->

                                    <ElementsGrouper>
                                        <FormInputLabel for="description" value="Description" />
                                        <FormLabel>{{ shopee_pay_transaction.description }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="balance" value="Current Balance" />
                                        <FormLabel>{{ shopee_pay_transaction.current_balance }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="amount" value="Amount" />
                                        <FormLabel>{{ shopee_pay_transaction.amount }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="post_maya_balance" value="Post Balance" />
                                        <FormLabel>{{ shopee_pay_transaction.post_balance }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="order_sn" value="Order SN" />
                                        <FormLabel>{{ shopee_pay_transaction.order_sn }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="remarks" value="Remarks" />
                                        <FormLabel>{{ shopee_pay_transaction.remarks }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="reference_id" value="Ref. ID" />
                                        <FormLabel>{{ shopee_pay_transaction.reference_id }}</FormLabel>
                                    </ElementsGrouper>


                                    <BlockWideElementsGrouper>
                                        <Link :href="route('shopee-pay-transactions.edit', shopee_pay_transaction.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-hidden focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                        <Link :href="route('shopee-pay-transactions.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
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