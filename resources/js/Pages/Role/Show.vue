<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FormInputLabel from '@/Components/FormInputLabel.vue';
import AltButton from '@/Components/AltButton.vue';
import ElementsGrouper from '@/Components/ElementsGrouper.vue';
import FormLabel from '@/Components/FormLabel.vue';
import BlockWideElementsGrouper from '@/Components/BlockWideElementsGrouper.vue';
import { Head, useForm, Link  } from '@inertiajs/vue3';

defineProps({
    role: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <Head title="Show Role" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Show Role
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">

                        <!-- Form -->
                        <form class="relative bg-white rounded-lg shadow" @submit.prevent="update">
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <ElementsGrouper>
                                        <FormInputLabel for="name" value="Role name" />
                                        <FormLabel>{{ role.name }}</FormLabel>
                                    </ElementsGrouper>

                                    <div class="col-span-6 sm:col-span-6">
                                        <FormInputLabel for="description" value="Description" />
                                        <FormLabel>{{ role.description }}</FormLabel>
                                    </div>


                                    <BlockWideElementsGrouper>
                                        <Link :href="route('roles.edit', role.id)" class="text-white bg-jp-indigo hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</Link>
                                        <Link :href="route('roles.index')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">Cancel</Link>
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