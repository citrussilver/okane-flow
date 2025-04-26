<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, Link  } from '@inertiajs/vue3';

defineProps({
    maya_account: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <Head title="Show Maya Account" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-100">
                Show Maya Account
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
                                        <FormInputLabel for="mobile_number" value="Mobile #" />
                                        <FormLabel>{{ maya_account.mobile_number }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="account_nickname" value="Acct. Nickname" />
                                        <FormLabel>{{ maya_account.account_nickname }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="last_4_digits" value="Last 4 Digits" />
                                        <FormLabel>{{ maya_account.last_4_digits }}</FormLabel>
                                    </ElementsGrouper>

                                    <ElementsGrouper>
                                        <FormInputLabel for="balance" value="Balance" />
                                        <FormLabel>{{ maya_account.balance }}</FormLabel>
                                    </ElementsGrouper>


                                    <BlockWideElementsGrouper>
                                        <Link :href="route('maya-accounts.edit', maya_account.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-hidden focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                        <Link :href="route('maya-accounts.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-hidden hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
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