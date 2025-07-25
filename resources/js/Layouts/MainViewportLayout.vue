<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue'
import { useLayoutStore } from '@/stores/layoutStore';
import Navbar from '@/components/Navbar.vue';

const layoutStore = useLayoutStore();


</script>
<template>
    <div>
        <Navbar />
    </div>
</template>
<style scoped>
/* Vue's default transition animation */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>