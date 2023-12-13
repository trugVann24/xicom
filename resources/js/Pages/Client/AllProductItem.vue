<template>
    <AllProduct>
        <div class="w-full h-full p-3 bg-white rounded">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div v-for="product in products.data" :key="product.id">
                    <div
                        class="relative w-[200px] h-max bg-white rounded  border-[2px] border-gray-200 hover:border-sky-500 duration-150 transition-all ease-linear">
                        <div class="absolute right-4 top-5">
                            <div
                                class="w-9 h-9 rounded-full bg-pink-50 flex items-center justify-center hover:bg-pink-100  hover:text-pink-600 text-pink-500 transition ease-linear duration-150">
                                <button><i class='bx bx-heart'></i></button>
                            </div>
                        </div>
                        <Link :href="route('details.products', product.id)" class="">
                        <div class="w-[190px] h-[190px] rounded overflow-hidden mx-auto mt-2 ">
                            <img :src="`/image/products/${product.image}`" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3">
                            <h3 class="line-clamp-2 text-sm font-500 text-gray-600 mb-1">{{ product.name }}</h3>
                            <span class="px-3 py-[3px] bg-orange-100 text-orange-600 font-500 text-xs">giảm 5%</span>
                            <div class="flex items-center justify-between mt-4">
                                <p class="text-pink-600 text-sm font-500">
                                    <span class="text-xs">đ</span>
                                    {{ product.price }}
                                </p>
                                <p class="text-gray-500 text-xs font-500">
                                    <span class="">Đã bán:</span>
                                    <span>0</span>
                                </p>
                            </div>
                        </div>
                        </Link>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center" v-if="products.length > 0">
                <span>Chưa có sản phẩm nào</span>
            </div>
            <div class="flex items-center justify-center" v-else>
                <Pagination :links="products.links" />
            </div>
        </div>
    </AllProduct>
</template>
<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import AllProduct from "./AllProduct.vue";
defineProps(["products"]);
</script>
