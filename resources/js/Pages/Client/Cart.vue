<template>
    <HomeLayout>
        <div class="xl:pt-8 bg-gray-50 rounded h-max">
            <div class="bg-white">
                <div class="mx-auto max-w-2xl px-4 pt-16 pb-24 sm:px-6 lg:max-w-7xl lg:px-8">
                    <h1 class="text-lg font-600 tracking-tight text-gray-900 sm:text-4xl">Giỏ hàng của bạn</h1>
                    <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16">
                        <section aria-labelledby="cart-heading" class="lg:col-span-7">
                            <ul role="list" class="divide-y divide-gray-200 border-t border-b border-gray-200">
                                <li class="flex py-6 sm:py-10">
                                    <div class="flex-shrink-0">
                                        <img src="https://tailwindui.com/img/ecommerce-images/shopping-cart-page-01-product-01.jpg"
                                            alt="Front of men&#039;s Basic Tee in sienna."
                                            class="h-24 w-24 rounded-md object-cover object-center sm:h-48 sm:w-48">
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col justify-between sm:ml-6">
                                        <div class="relative pr-9">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-base">
                                                        <a href="#"
                                                            class="font-500 text-gray-700 hover:text-gray-800">Camera
                                                            Hikivison</a>
                                                    </h3>
                                                </div>
                                                <p class="mt-1 text-sm font-500 text-gray-900">300.000 vnđ</p>
                                            </div>

                                            <div class="mt-4">
                                                <span class="text-sm text-gray-600 mr-2">Số lượng :</span>
                                                <QuantityInput :maxQuantity="10"></QuantityInput>
                                            </div>
                                        </div>

                                        <p class="mt-4 flex space-x-2 text-sm text-gray-700">
                                            <!-- Heroicon name: mini/check -->
                                            <svg class="h-5 w-5 flex-shrink-0 text-green-500"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-sm font-500 text-gray-600">Còn: 12 sản phẩm có sẵn</span>
                                        </p>
                                    </div>
                                    <div class="">
                                        <button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </li>
                            </ul>
                        </section>

                        <!-- Order summary -->
                        <section aria-labelledby="summary-heading"
                            class="mt-16 rounded-lg border px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                            <h2 id="summary-heading" class="text-lg font-500 text-gray-900">Thông tin hoá đơn</h2>

                            <dl class="mt-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Tên sản phẩm</dt>
                                    <dd class="text-sm font-500 text-gray-900">Camera Hikivison</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Số lượng sản phẩm</dt>
                                    <dd class="text-sm font-500 text-gray-900">3</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Giá sản phẩm</dt>
                                    <dd class="text-sm font-500 text-gray-900">300.000 vnđ</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="flex items-center text-sm text-gray-600">
                                        <span>Giá vận chuyển</span>
                                    </dt>
                                    <dd class="text-sm font-500 text-gray-900">Miễn phí</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-base font-500 text-gray-900">Tổng số tiền</dt>
                                    <dd class="text-base font-500 text-gray-900">$112.32</dd>
                                </div>
                            </dl>

                            <div class="mt-6">
                                <button type="submit"
                                    class="w-full rounded-md border border-transparent bg-sky-600 py-3 px-4 text-base font-500 text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-gray-50">Đặt hàng</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
import QuantityInput from '@/Components/QuantityInput.vue';
</script>
