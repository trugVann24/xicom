<template>
    <HomeLayout>
        <div class="xl:py-6 overflow-hidden ">
            <div class="w-full xl:h-[400px] overflow-hidden">
                <img src="https://images.unsplash.com/photo-1682686581854-5e71f58e7e3f?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="" class="object-cover w-full h-full" />
            </div>
        </div>
        <div class="max-w-7xl">
            <div class=" xl:mt-8">
                <div class="flex items-center justify-between">
                    <h4 class="text-2xl font-600 uppercase">Sản phẩm mới nhất</h4>
                    <Link :href="route('details.all')" class="flex items-center text-sm font-500 text-sky-600">
                    Xem tất cả
                    <i class='bx bx-link'></i>
                    </Link>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 xl:mt-4">
                    <div v-for="product in $page.props.products" :key="product.id">
                        <div
                            class="relative w-[200px] h-max bg-white rounded  border-[2px] border-gray-200 hover:border-sky-500 duration-150 transition-all ease-linear">
                            <div class="absolute right-3 top-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-pink-50 flex items-center justify-center hover:bg-pink-100  hover:text-pink-600 text-pink-500 transition ease-linear duration-150">
                                    <button><i class='bx bx-heart'></i></button>
                                </div>
                            </div>
                            <Link :href="route('details.products', product.id)" class="">
                                <div class="p-1">
                                    <div class="w-[180px] h-[190px] rounded overflow-hidden mx-auto ">
                                        <img :src="`/image/products/${product.image}`" alt="" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            <div class="p-3">
                                <h3 class="line-clamp-2 text-sm font-500 text-gray-600 mb-1">{{ product.name }} Nguyễn Trung Văn đây này</h3>
                                <!-- <span class="px-3 py-[3px] bg-orange-100 text-orange-600 font-500 text-xs">giảm 5%</span> -->
                                <div class="flex items-center justify-between mt-4">
                                    <p class="text-pink-600 text-sm font-500">
                                        <span class="text-xs">đ</span>
                                        {{ formatCurrency(product.price) }}
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
            </div>
        </div>
        <!-- <div>
            <div class="xl:mt-8  ">
                <div class="flex items-center justify-between">
                    <h4 class="text-2xl font-600 uppercase">Sản phẩm của Hikivison</h4>
                    <Link :href="route('details.all')" class="flex items-center text-sm font-500 text-sky-600">
                    Xem tất cả
                    <i class='bx bx-link'></i>
                    </Link>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 xl:mt-4">
                </div>
            </div>
        </div> -->
        <div>
            <div class="xl:mt-8  ">
                <h4 class=" text-2xl font-600 uppercase">Tin tức công nghệ</h4>
                <div class="grid xl:grid-cols-6 2xl:grid-cols-6 gap-4 p-4 xl:mt-4">
                    <div class="w-full h-max bg-white rounded-md p-2  border-[2px] border-gray-200 ">
                        <div class="w-[180px] h-[180px] overflow-hidden mx-auto">
                            <img src="https://th.bing.com/th/id/R.e6de8e6e473b9190df010bed59e7e5aa?rik=oUk9C94t3QvN1g&pid=ImgRaw&r=0"
                                alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="p-3 flex flex-wrap">
                            <h3 class="line-clamp-2 text-xs font-600">Lenovo ThinkPad T14 Gen 3 AMD R5 Pro 6650U,
                                16GB, 256GB, FHD+</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import { Link } from '@inertiajs/vue3';
const formatCurrency = ((value) => {
    if (!value) return '';
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

});
</script>
