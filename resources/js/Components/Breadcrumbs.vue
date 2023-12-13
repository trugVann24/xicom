<template>
    <nav class="flex">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{route('dashboard')}}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 ">
                    <i class='bx bx-home'></i>
                    Trang chủ
                </a>
            </li>
            <li v-for="(item, index) in breadcrumbs" :key="index">
                <div class="flex items-center">
                    <i class='bx bx-chevron-right text-gray-400 mx-1'></i>
                    <a v-if="index !== breadcrumbs.length - 1" :href="item.url"
                        class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400">{{ item.text }}</a>
                    <span v-else class="ms-1 text-sm font-medium text-gray-600 md:ms-2 dark:text-gray-400">{{ item.text
                    }}</span>
                </div>
            </li>
        </ol>
    </nav>
</template>
<script >
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        breadcrumbs: {
            type: Array,
            required: true
        }
    }
};
</script>
