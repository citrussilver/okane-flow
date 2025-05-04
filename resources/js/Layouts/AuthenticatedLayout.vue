<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MaterialIconRenderer from '@/Components/MaterialIconRenderer.vue';
import { ref, computed, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import ThemeSwitcher from '@/Components/ThemeSwitcher.vue';
import Button from '@/volt/Button.vue';
import Menu from '@/volt/Menu.vue';
import consts from '@/constants/constants.js';

const showingNavigationDropdown = ref(false);

const activeClass = ref('inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-hidden focus:border-indigo-700 transition duration-150 ease-in-out');
const inactiveClass = ref('inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-hidden focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out');

// Savings Acct Menu
const saMenuActive = ref(false);

const saMenuClasses = computed(() =>
    saMenuActive.value 
    ? activeClass.value
    : inactiveClass.value
);

const saMenuOv = ref();
const saMenuItems = ref([
    {
        label: 'Savings Account',
        items: [
            {
                label: 'Transactions',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/sa-transactions', { method: 'get'});
                }
            },
            {
                label: 'Accounts',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/savings-accounts', { method: 'get' });
                }
            }
        ]
    }
]);

const saToggle = (event) => {
    saMenuOv.value.toggle(event);
};

// Maya Menu
const mayaMenuActive = ref(false);

const mayaMenuClasses = computed(() =>
    mayaMenuActive.value 
    ? activeClass.value
    : inactiveClass.value,
);

const mayaMenuOv = ref();
const mayaMenuItems = ref([
    {
        label: 'Maya',
        items: [
            {
                label: 'Transactions',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/maya-transactions', { method: 'get'});
                }
            },
            {
                label: 'Accounts',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/maya-accounts', { method: 'get' });
                }
            }
        ]
    }
]);

const mayaToggle = (event) => {
    mayaMenuOv.value.toggle(event);
};

// Credit Cards Menu
const ccMenuActive = ref(false);

const ccMenuClasses = computed(() =>
    ccMenuActive.value 
    ? activeClass.value
    : inactiveClass.value,
);

const ccMenuOv = ref();
const ccMenuItems = ref([
    {
        label: 'Credit Cards',
        items: [
            {
                label: 'Transactions',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/cc-transactions', { method: 'get'});
                }
            },
            {
                label: 'Cards',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/credit-cards', { method: 'get' });
                }
            }
        ]
    }
]);

const ccToggle= (event) => {
    ccMenuOv.value.toggle(event);
};

// ShopeePay Wallet Menu
const shopeePayMenuActive = ref(false);

const shopeePayMenuClasses = computed(() =>
    shopeePayMenuActive.value 
    ? activeClass.value
    : inactiveClass.value,
);

const shopeePayMenuOv = ref();
const shopeePayMenuItems = ref([
    {
        label: 'ShopeePay',
        items: [
            {
                label: 'Transactions',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/shopee-pay-transactions', { method: 'get'});
                }
            },
            {
                label: 'Wallets',
                icon: 'pi pi-plus',
                command: () => {
                    router.visit('/shopee-pays', { method: 'get' });
                }
            }
        ]
    }
]);

const shopeePayToggle = (event) => {
    shopeePayMenuOv.value.toggle(event);
};

onMounted(() => {
    saMenuActive.value = consts.global_page_routes.savings_acct.includes(route().current()) ? true : false;
    mayaMenuActive.value = consts.global_page_routes.maya.includes(route().current()) ? true : false;
    ccMenuActive.value = consts.global_page_routes.cc.includes(route().current()) ? true : false;
    shopeePayMenuActive.value = consts.global_page_routes.shopee_pays.includes(route().current()) ? true: false;
});

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav
                class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800"
            >
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link :href="route('dashboard')">
                                    <!-- <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    /> -->
                                    <MaterialIconRenderer class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" mIcon="finance" textLabel="" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    <MaterialIconRenderer mIcon="dashboard" textLabel="" />
                                </NavLink>
                                <div :class="saMenuClasses">
                                    <div class="hover:cursor-pointer flex items-center" @click="saToggle">
                                        <span class="material-symbols-outlined">receipt_long</span>
                                    </div>
                                    <!-- <Button 
                                        id="saMenu" 
                                        type="button" 
                                        icon="pi pi-home" 
                                        plain 
                                        @click="saToggle" 
                                        aria-haspopup="true" 
                                        aria-controls="overlay_menu" 
                                        class="bg-transparent hover:bg-jp-indigo text-white"
                                    /> -->
                                    <Menu ref="saMenuOv" id="sa_overlay_menu" :model="saMenuItems" :popup="true" />
                                </div>
                                <div :class="ccMenuClasses">
                                    <div class="hover:cursor-pointer flex items-center" @click="ccToggle">
                                        <span class="material-symbols-outlined">credit_card</span>
                                    </div>
                                    <Menu ref="ccMenuOv" id="cc_overlay_menu" :model="ccMenuItems" :popup="true" />
                                </div>
                                <!-- <NavLink
                                    :href="route('credit-cards.index')" 
                                    :active="route().current('credit-cards.*')"
                                >
                                    <MaterialIconRenderer mIcon="credit_card" textLabel="Credit Cards" />
                                </NavLink> -->
                                <div :class="mayaMenuClasses">
                                    <div class="hover:cursor-pointer flex items-center" @click="mayaToggle">
                                        <span class="material-symbols-outlined">request_quote</span>
                                    </div>
                                    <Menu ref="mayaMenuOv" id="maya_overlay_menu" :model="mayaMenuItems" :popup="true" />
                                </div>
                                <div :class="shopeePayMenuClasses">
                                    <div class="hover:cursor-pointer flex items-center" @click="shopeePayToggle">
                                        <span class="material-symbols-outlined">money</span>
                                    </div>
                                    <Menu ref="shopeePayMenuOv" id="shopeePay_overlay_menu" :model="shopeePayMenuItems" :popup="true" />
                                </div>
                                <NavLink
                                    :href="route('users.index')" 
                                    :active="route().current('users.*')"
                                >
                                    <MaterialIconRenderer mIcon="patient_list" textLabel="" />
                                </NavLink>
                                <NavLink
                                    :href="route('roles.index')" 
                                    :active="route().current('roles.*')" 
                                >
                                    <MaterialIconRenderer mIcon="assignment_ind" textLabel="" />
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <div>
                                 <ThemeSwitcher/>
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3">
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

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <div class="mr-2">
                                <ThemeSwitcher />
                            </div>
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
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
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            <MaterialIconRenderer mIcon="dashboard" textLabel="Dashboard" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('sa-transactions.index')"
                            :active="route().current('sa-transactions.*')"
                        >
                            <MaterialIconRenderer mIcon="receipt_long" textLabel="SA Transacts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('savings-accounts.index')"
                            :active="route().current('savings-accounts.*')"
                        >
                            <MaterialIconRenderer mIcon="savings" textLabel="SA Accts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('cc-transactions.index')"
                            :active="route().current('cc-transactions.*')"
                        >
                            <MaterialIconRenderer mIcon="credit_card" textLabel="CC Transacts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('credit-cards.index')"
                            :active="route().current('credit-cards.*')"
                        >
                            <MaterialIconRenderer mIcon="credit_card_gear" textLabel="Credit Cards" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('maya-transactions.index')"
                            :active="route().current('maya-transactions.*')"
                        >
                            <MaterialIconRenderer mIcon="request_quote" textLabel="Maya Transacts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('maya-accounts.index')"
                            :active="route().current('maya-accounts.*')"
                        >
                            <MaterialIconRenderer mIcon="price_change" textLabel="Maya Accounts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('shopee-pay-transactions.index')"
                            :active="route().current('shopee-pay-transactions.*')"
                        >
                            <MaterialIconRenderer mIcon="money" textLabel="ShopeePay Transacts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('shopee-pays.index')"
                            :active="route().current('shopee-pays.*')"
                        >
                            <MaterialIconRenderer mIcon="price_change" textLabel="ShopeePay Accounts" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('users.index')"
                            :active="route().current('users.*')"
                        >
                            <MaterialIconRenderer mIcon="patient_list" textLabel="Users" />
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('roles.index')"
                            :active="route().current('roles.*')"
                        >
                            <MaterialIconRenderer mIcon="assignment_ind" textLabel="Roles" />
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600"
                    >
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
            </nav>

            <!-- Page Heading -->
            <header
                class="bg-white shadow-sm dark:bg-gray-800 flex items-center justify-between"
                v-if="$slots.header"
            >
                <div class="max-w-7xl px-4 py-6 sm:px-6 lg:px-8 justify-s`tart">
                    <slot name="header" />
                </div>
                <!-- <div class="sm:px-4 sm:px-6 lg:px-8 ">
                    <ThemeSwitcher/>
                </div> -->
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
