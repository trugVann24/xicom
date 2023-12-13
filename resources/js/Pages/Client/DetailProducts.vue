<template>
    <HomeLayout>
        <div class="xl:pt-8 bg-gray-50 rounded">
            <div class="p-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <div class="w-full h-max p-3 bg-white rounded">
                            <div class="w-full h-[480px] overflow-hidden rounded-sm">
                                <img :src="`/image/products/${product.image}`" alt="" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded p-3 h-max">
                        <div class="h-[480px]">
                            <h3 class="line-clamp-2 text-base font-500 py-4 text-gray-600">{{ product.name }} Trọn bộ 6 mắt
                                camera Hikvision 2.0MP Full HD 1080P, IP66, IR 20m</h3>
                            <div class="py-4">
                                <div class="flex items-center justify-center">
                                    <div class="px-3 border-r">
                                        <span class="mr-1 text-sm">5.0</span>
                                        <span class="text-yellow-500">
                                            <i class='bx bxs-star'></i>
                                        </span>
                                        <span class="text-yellow-500">
                                            <i class='bx bxs-star'></i>
                                        </span>
                                        <span class="text-yellow-500">
                                            <i class='bx bxs-star'></i>
                                        </span>
                                        <span class="text-yellow-500">
                                            <i class='bx bxs-star'></i>
                                        </span>
                                        <span class="text-yellow-500">
                                            <i class='bx bxs-star'></i>
                                        </span>
                                    </div>
                                    <div class="px-3 border-r">
                                        <span class="text-sm">0 đánh giá</span>
                                    </div>
                                    <div class="px-3">
                                        <span class="text-sm">{{ product.sold_quantity }} đã bán</span>
                                    </div>
                                </div>
                            </div>

                            <div v-if="product.price">
                                <div class="bg-gray-50 flex items-center px-4 py-4">
                                    <span class="text-xl font-600 text-pink-600 flex px-2" id="price">
                                        {{ formatCurrency(product.price) }}
                                        <div class="text-xs mb-2">
                                            đ
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div v-else>
                                <div class="bg-gray-50 flex items-center px-4 py-4">
                                    <span class="text-base font-500 text-gray-500 flex px-2">
                                        {{ formatCurrency(product.price) }}
                                        <div class="text-xs mb-2">
                                            đ
                                        </div>
                                    </span>
                                    <span class="text-xl font-600 text-pink-600 flex px-2" id="price">
                                        {{ formatCurrency(product.price) }}
                                        <div class="text-xs mb-2">
                                            đ
                                        </div>
                                    </span>
                                    <span class="px-3 py-[3px] bg-orange-100 text-orange-600 font-500 text-xs">{{
                                        product.percent_discount }}%</span>
                                </div>
                            </div>
                            <div class="flex items-center mt-3 py-4">
                                <span class="text-gray-600 text-sm">Đơn vị vận chuyển: </span>
                                <div class="w-10 h-10 overflow-hidden ml-2">
                                    <img src="/icons/logo.png" alt="" class="w-full h-full object-cover">
                                </div>
                                <span class="text-gray-900 text-xs">Giao hàng tiết kiếm</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600 mr-2">Số lượng :</span>
                                <QuantityInput :maxQuantity="product.quantity"></QuantityInput>
                                <span class="text-sm text-gray-400 ml-2">{{ product.quantity }} sản phẩm có sẵn</span>
                            </div>
                            <div class="flex items-center justify-center mt-6">
                                <button
                                    class="px-4 py-2 font-600 bg-sky-50 text-sky-600 border border-sky-600 rounded text-sm mx-4 hover:shadow-md transition ease-linear duration-200 flex items-center">
                                    <i class='bx bx-shopping-bag text-lg mr-2'></i>
                                    Thêm vào giỏ hàng
                                </button>
                                <button
                                    class="bg-pink-50 px-4 py-2 font-600 text-sm text-pink-600 border border-pink-600 mx-4 hover:shadow-md transition ease-linear duration-200 rounded flex items-center">
                                    <i class="bx bx-cart text-lg mr-2"></i>
                                    Mua ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full h-max p-3 bg-white mt-4 rounded">
                    <div class="flex items-center justify-between">
                        <h4 class="uppercase font-600">Thông tin chi tiết</h4>
                        <p
                            class="font-600 text-xs flex items-center text-blue-700 border-b-[2px] border-sky-700 cursor-pointer">
                            Xem chi tiết<i class='bx bx-chevrons-right'></i></p>
                    </div>
                    <div class="grid xl:grid-cols-3 2xl:grid-cols-3 mt-4">
                        <div class="my-2">
                            <div class="text-sm leading-5 mt-1" v-html="product.description">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white mt-4 rounded p-3">
                    <h3 class="uppercase font-600">Sản phẩm tương tự</h3>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
<script setup>
import QuantityInput from "@/Components/QuantityInput.vue";
import HomeLayout from "../../Layouts/HomeLayout.vue";
const formatCurrency = ((value) => {
    if (!value) return '';
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

});
defineProps(["product"]);
</script>
