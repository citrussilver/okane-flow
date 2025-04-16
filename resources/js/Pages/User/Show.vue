<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    user: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <Head title="Show User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                View User
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <ElementsGrouper>
                                    <FormInputLabel for="full_name" value="Full name" />
                                    <FormLabel>{{ user.full_name }}</FormLabel>                     
                                </ElementsGrouper>
                                <ElementsGrouper>
                                    <FormInputLabel for="email" value="Email" />
                                    <FormLabel>{{ user.email }}</FormLabel>
                                </ElementsGrouper>
                                <ElementsGrouper>
                                    <FormInputLabel for="role" value="Role" />
                                    <FormLabel>{{ user.role.name }}</FormLabel>
                                </ElementsGrouper>

                                <BlockWideElementsGrouper>
                                    <Link :href="route('users.edit', user.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                    <Link :href="route('users.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
                                </BlockWideElementsGrouper>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>