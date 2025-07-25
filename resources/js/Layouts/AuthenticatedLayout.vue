<script setup>
import { ref, computed, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';

import Navbar from '@/Components/Navbar.vue';

import { useToast } from '@/composables/useToast.js'
import { useModal } from '@/composables/useModal.js'
import Toast from '@/flowbite/Toast.vue'
import Modal from '@/flowbite/Modal.vue'

const { raToast, displayToast } = useToast()
const { raModal } = useModal()

onMounted(() => {
    
});

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            <Navbar/>

            <!-- Page Heading -->
            <header
                class="bg-white shadow-sm dark:bg-gray-800 flex items-center justify-between"
                v-if="$slots.header"
            >
                <div class="max-w-7xl px-4 py-6 sm:px-6 lg:px-8 justify-s`tart">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
        <div
            class="fixed top-[5rem] left-1/2 -translate-x-1/2 z-50 w-11/12 sm:w-auto md:w-auto"
            v-if="displayToast"
        >
            <Toast :toastMessage="raToast.toastText" :toastType="raToast.toastType" />
        </div>
        <!-- Modal mountpoint here -->
        <transition name="fade">
        <div 
            v-if="raModal.show"
            id="your-modal-id"
            tabindex="-1"
            class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full bg-black/50"
        >
            <Modal 
            :modalMessage="raModal.modalText"
            />
        </div>
        </transition>
    </div>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 150ms ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>