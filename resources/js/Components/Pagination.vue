<template>
    <div class="m-2 p-2 flex items-center">
        <Link v-for="(link, key) in links" :key="key" :href="link.label"
            class="mb-1 mr-1 px-2 py-1 text-gray-600 text-sm leading-4 border focus:text-indigo-600 focus:border-indigo-500 hover:bg-white"
            :class="{ 'bg-indigo-50 text-indigo-700': link.active }">
        <span v-if="link.label.includes('Previous')"><i class='bx bx-chevrons-left'></i></span>
        <span v-else-if="link.label.includes('Next')"><i class='bx bx-chevrons-right'></i></span>
        <span v-else>{{ link.label }}</span>
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    links: Array
});
</script>
