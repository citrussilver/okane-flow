<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { getUser, deleteRow } from '@/functions/helpers.js'

const user = getUser();

const form = useForm({
    full_name: user.full_name,
    role_id: user.role_id
});

defineProps({
    // explicitly define as type Array coz Laravel Resource makes it an array
    users: {
        type: Array,
        required: true
    }
})

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Users
            </h2>
        </template>
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="m-4 flex justify-between" v-if="form.role_id == 1">
                        <div class="text-gray-900">Manage Users</div>
                        <Link :href="route('users.create')" class="bg-ceil hover:bg-jp-indigo px-4 py-1 rounded-full text-white active:translate-y-1">Add New User</Link>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-jp-indigo uppercase bg-azureish-white border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        User Full name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3" v-if="form.role_id == 1">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id" class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ user.full_name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ user.email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ user.role.name }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2" v-if="form.role_id == 1">
                                        <Link :href="route('users.show', user.id)" class="font-medium text-gray-600 hover:underline pr-4">Show</Link>
                                        <Link :href="route('users.edit', user.id)" class="font-medium text-blue-600 hover:underline pr-4">Edit</Link>
                                        <a href="#" class="font-medium text-red-600 hover:underline" @click.prevent="deleteRow(user, 'users')">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Temporary Pagination Template -->
                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between py-2 px-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-700 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-700">1-10</span> of <span class="font-semibold text-gray-700">1</span></span>
                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <!-- <li><a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 hover:text-gray-700">Previous</a></li> -->
                                <li><a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">1</a></li>
                                <!-- <li><a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">2</a></li>
                                <li><a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 hover:text-blue-700">3</a></li>
                                <li><a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">4</a></li>
                                <li><a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">5</a></li> -->
                                <!-- <li><a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">Next</a></li> -->
                            </ul>
                        </nav>
                    </div>
                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>