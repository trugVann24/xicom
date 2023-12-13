<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import HomeLayout from '@/Layouts/HomeLayout.vue';
import Pagination from "@/Components/Pagination.vue";
defineProps(["products"]);
</script>

<template>
    <Head title="Tất cả sản phẩm" />
    <HomeLayout>
        <div class=" bg-gray-50 ">
            <div class="p-4">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <div class="w-full h-full p-3 bg-white rounded">
                            <div class="">
                                <div class="flex items-center">
                                    <i class='bx bx-filter-alt text-xl mr-1'></i>
                                    <span class="text-base font-600">Lọc theo giá</span>
                                </div>
                                <div class="">
                                    <ul class="">
                                        <li class="">
                                            <a href="" class="text-sm font-500 px-6 py-2 hover:bg-gray-50 text-gray-500">
                                                Mới nhất
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="text-sm font-500 px-6 py-2 hover:bg-gray-50 text-gray-500">
                                                Giá giảm dần
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="text-sm font-500 px-6 py-2 hover:bg-gray-50 text-gray-500">
                                                Giá tăng dần
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
