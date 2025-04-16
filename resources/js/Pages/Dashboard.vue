<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DataGridLayout from '@/Layouts/DataGridLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { getUser, getSharedData } from '@/functions/helpers.js';

const user = getUser();

const global_data_info = getSharedData();

const form = useForm({
    full_name: user.full_name,
    shared_data: global_data_info
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <p>Hello {{ form.full_name }}!</p>

                        <!-- <div>
                            {{ form.shared_data }} 
                            {{ form.shared_data.gcash_accounts[0] }}
                        </div> -->
                    </div>

                    <DataGridLayout :sharedData="form.shared_data" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
