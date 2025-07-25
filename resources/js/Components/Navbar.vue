<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import NavDropdown from '@/Components/NavDropdown.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MaterialIconRenderer from '@/Components/MaterialIconRenderer.vue';
import ThemeSwitcher from '@/Components/ThemeSwitcher.vue';
import { Link } from '@inertiajs/vue3';

import { useLayoutStore } from '@/stores/layoutStore.js';
import { ref, computed } from 'vue'

const showingNavigationDropdown = ref(false);

import consts from '@/constants/constants.js';

const appName = consts.APP_NAME

</script>
<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-olivine-500/50 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3 relative">
        <!-- Top-level flex container -->
        <div class="flex justify-between items-center">
            <!-- Left: Logo + Burger Buttons -->
            <div class="flex items-center space-x-2">
                <div class="flex shrink-0 items-center ml-[1rem]">
                    <Link :href="route('dashboard')">
                        <!-- <ApplicationLogo
                            class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                        /> -->
                        <MaterialIconRenderer class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" mIcon="finance" textLabel="" />
                    </Link>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    <NavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="dashboard" textLabel="" />
                    </NavLink>
                    <NavDropdown 
                        label="Settings" 
                        :active="$page.url.startsWith('/sa')" 
                        :links="[
                            { label: 'Transactions', href: '/sa-transactions' },
                            { label: 'Accounts', href: '/savings-accounts' }
                        ]"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="receipt_long" textLabel="" />
                    </NavDropdown>
                    <NavDropdown 
                        label="Settings" 
                        :active="$page.url.startsWith('/c')" 
                        :links="[
                            { label: 'Transactions', href: '/cc-transactions' },
                            { label: 'Cards', href: '/credit-cards' }
                        ]"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="credit_card" textLabel="" />
                    </NavDropdown>
                    <NavDropdown 
                        label="Settings" 
                        :active="$page.url.startsWith('/maya')" 
                        :links="[
                            { label: 'Transactions', href: '/maya-transactions' },
                            { label: 'Accounts', href: '/maya-accounts' }
                        ]"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="request_quote" textLabel="" />
                    </NavDropdown>
                    <NavDropdown 
                        label="Settings" 
                        :active="$page.url.startsWith('/shopee')" 
                        :links="[
                            { label: 'Transactions', href: '/shopee-pay-transactions' },
                            { label: 'Wallets', href: '/shopee-pays' }
                        ]"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="money" textLabel="" />
                    </NavDropdown>
                    <NavLink
                        :href="route('users.index')" 
                        :active="route().current('users.*')"
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="patient_list" textLabel="" />
                    </NavLink>
                    <NavLink
                        :href="route('roles.index')" 
                        :active="route().current('roles.*')" 
                    >
                        <MaterialIconRenderer class="align-middle" mIcon="assignment_ind" textLabel="" />
                    </NavLink>
                </div>
            </div>
            
            <!-- Right side -->
            <div class="flex items-center gap-2">
                <ThemeSwitcher />
                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden z-45">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown" 
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-hidden dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                    >
                        <svg
                            class="h-6 w-6"
                            stroke="currentColor"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex':
                                        !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex':
                                        showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <!-- Responsive Navigation Menu -->
                <Transition name="fade">
                    <div
                        v-if="showingNavigationDropdown"
                        class="fixed inset-0 z-40 bg-opacity-50 sm:hidden"
                        @click.self="showingNavigationDropdown = false"
                    >
                        <div class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-full bg-white dark:bg-gray-800 shadow-xl p-4 overflow-y-auto">
                            <!-- Navigation items -->
                            <div class="space-y-1 pb-3 pt-2">
                                <ResponsiveNavLink 
                                    :href="route('dashboard')" 
                                    :active="route().current('dashboard')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="dashboard" textLabel="Dashboard" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('sa-transactions.index')" 
                                    :active="route().current('sa-transactions.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="receipt_long" textLabel="SA Transacts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('savings-accounts.index')" 
                                    :active="route().current('savings-accounts.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="savings" textLabel="SA Accts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('cc-transactions.index')" 
                                    :active="route().current('cc-transactions.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="credit_card" textLabel="CC Transacts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('credit-cards.index')" 
                                    :active="route().current('credit-cards.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="credit_card_gear" textLabel="Credit Cards" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('maya-transactions.index')" 
                                    :active="route().current('maya-transactions.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="request_quote" textLabel="Maya Transacts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('maya-accounts.index')" 
                                    :active="route().current('maya-accounts.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="price_change" textLabel="Maya Accounts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('shopee-pay-transactions.index')" 
                                    :active="route().current('shopee-pay-transactions.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="money" textLabel="ShopeePay Transacts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('shopee-pays.index')" 
                                    :active="route().current('shopee-pays.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="price_change" textLabel="ShopeePay Accounts" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('users.index')" 
                                    :active="route().current('users.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="patient_list" textLabel="Users" />
                                </ResponsiveNavLink>
                                <ResponsiveNavLink 
                                    :href="route('roles.index')" 
                                    :active="route().current('roles.*')" 
                                    class="flex items-center gap-2 text-base px-2 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 transition" 
                                    @click="showingNavigationDropdown = false"
                                >
                                    <MaterialIconRenderer mIcon="assignment_ind" textLabel="Roles" />
                                </ResponsiveNavLink>
                            </div>

                            <!-- Responsive Settings Options -->
                            <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600 sm:hidden">
                                <div class="px-4">
                                    <div
                                        class="text-base font-medium text-gray-800 dark:text-gray-200"
                                    >
                                        {{ $page.props.auth.user.name }}
                                    </div>
                                    <div class="text-sm font-medium text-gray-500">
                                        {{ $page.props.auth.user.email }}
                                    </div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <ResponsiveNavLink :href="route('profile.edit')">
                                        Profile
                                    </ResponsiveNavLink>
                                    <ResponsiveNavLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </ResponsiveNavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </Transition>
                    
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex items-center ms-3">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button
                                    type="button"
                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-hidden dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                >
                                    {{ $page.props.auth.user.full_name }}

                                    <svg
                                        class="-me-0.5 ms-2 h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink
                                :href="route('profile.edit')" 
                            >
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </div>

        <!-- Progress bar -->
        <div v-if="showingNavigationDropdown" class="fixed top-16 left-0 z-50 h-1 w-full bg-gradient-to-r from-pokedex-ghost via-pokedex-steel to-pokedex-poison animate-pulse"></div>
        </div>
    </nav>
</template>
<style scoped>
/* For mobile menu slide-in animation */
.fade-enter-active,
.fade-leave-active {
  transition: all 0.3s ease;
}
.fade-enter-from {
  opacity: 0;
  transform: translateX(-100%);
}
.fade-enter-to {
  opacity: 1;
  transform: translateX(0);
}
.fade-leave-from {
  opacity: 1;
  transform: translateX(0);
}
.fade-leave-to {
  opacity: 0;
  transform: translateX(-100%);
}
</style>
