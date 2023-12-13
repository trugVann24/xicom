<template>
    <Head title="Thương hiệu" />
    <div class="w-full">
        <div class="">
            <section class="max-w-7xl mx-auto z-[15] bg-white"
                :class="{ 'fixed top-0 right-0 left-0 border-b': isNavbarFixed, 'relative': !isNavbarFixed }">
                <div class="flex items-center justify-between py-3 border-b">
                    <div class="">
                        <Link :href="route('index')" class="text-lg uppercase font-700 text-sky-600">Xicomex</Link>
                    </div>
                    <div class="bg-white transition-all duration-150 ease-linear text-black z-[20] flex items-center justify-between  max-w-7xl mx-auto "
                        id="navbar">
                        <div class="">
                            <ul class="flex items-center text-gray-600">
                                <li>
                                    <Link :href="route('index')" class="px-3 py-2 text-sm font-500 block">Trang chủ</Link>
                                </li>
                                <li class="group">
                                    <Link :href="route('product.category')"
                                        class="px-3 py-2 text-sm font-500 flex items-center ">
                                    Danh mục
                                    <i class='bx bx-chevron-down'></i>
                                    </Link>
                                    <ul
                                        class="absolute bg-white shadow-md w-full left-0 right-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-700 ease-in-out  p-4">
                                        <div class="max-w-7xl mx-auto grid grid-cols-4">
                                            <li v-for="category in $page.props.categories" :key="category.id"
                                                class="px-2 py-2 text-black font-500 text-sm  hover:text-sky-600 transition-all duration-200">
                                                <Link :href="route('product.by.category', category.id)"
                                                    class="px-3 py-2 text-black font-500 text-sm hover:text-sky-600 border-b-[2px] border-transparent hover:border-sky-600 transition-all duration-200">
                                                {{ category.name }}
                                                </Link>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                                <li class="group">
                                    <Link :href="route('product.brand')"
                                        class="px-3 py-2 text-sm font-500 flex items-center ">
                                    Thương hiệu
                                    <i class='bx bx-chevron-down'></i>
                                    </Link>
                                    <ul
                                        class="absolute bg-white shadow-md w-full left-0 right-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-700 ease-in-out p-4">
                                        <div class="max-w-7xl mx-auto grid grid-cols-4">
                                            <li v-for="brand in $page.props.brands" :key="brand.id"
                                                class="px-2 py-2 text-black font-500 text-sm hover:text-sky-600 transition-all duration-200">
                                                <Link :href="route('product.by.brand', brand.id)"
                                                    class="px-3 py-2 text-black font-500 text-sm hover:text-sky-600 border-b-[2px] border-transparent hover:border-sky-600 transition-all duration-200">
                                                {{ brand.name }}
                                                </Link>
                                            </li>
                                        </div>
                                    </ul>
                                </li>
                                <li>
                                    <Link :href="route('index')" class="px-3 py-2 text-sm font-500 block">Liên hệ</Link>
                                </li>
                                <li>
                                    <Link :href="route('index')" class="px-3 py-2 text-sm font-500 block">Tin tức</Link>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="">
                        <form @submit.prevent=" form.get(route('search'))">
                            <div class="bg-gray-100 px-2 rounded-md flex items-center">
                                <i class='bx bx-search-alt'></i>
                                <input type="text" v-model="form.query"
                                    class="bg-gray-100 border-0 font-500 text-sm px-4 focus:outline-none focus:border-none focus:ring-0"
                                    placeholder="Tìm kiếm ..">
                            </div>
                        </form>
                    </div>
                    <div class="flex items-center">
                        <div class="">
                            <Link :href="route('index')" class="px-2">
                            <i class='bx bx-heart text-xl'></i>
                            </Link>
                        </div>
                        <div class="mr-2">
                            <Link :href="route('cart')" class="px-2 relative">
                            <i class='bx bx-shopping-bag text-xl'></i>
                            <span
                                class="absolute bg-sky-100 w-5 h-5 flex items-center justify-center top-2 left-5 rounded-full font-500 text-sm">1</span>
                            </Link>
                        </div>
                        <div v-if="$page.props.auth.customer">
                            <div class=" sm:flex sm:items-center">
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2  text-sm leading-4 font-500 text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.customer.name }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('customer.profile.edit')"> Cá nhân </DropdownLink>
                                            <DropdownLink :href="route('cart')">Đơn hàng</DropdownLink>
                                            <DropdownLink :href="route('customer.logout')" method="post" as="button">
                                                Đăng xuất
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <Link :href="route('customer.get.login')"
                                class="px-3 text-gray-600 font-500 bg-white hover:text-gray-700 text-sm ">
                            Đăng nhập
                            </Link>
                        </div>
                    </div>
                </div>

            </section>
        </div>
        <main class="max-w-7xl mx-auto">
            <slot />
        </main>
        <footer>
            <div class="max-w-7xl mx-auto bg-white mt-4">
                <h4 class="uppercase text-xl font-600 mb-2">Cửa hàng</h4>
                <div class="grid xl:grid-cols-3">
                    <div class="w-full h-max bg-blue-50 p-3 rounded ">
                        <p class="font-600 text-sm">Tỉnh Bắc Giang</p>
                        <p class="text-sm my-2">
                            Thôn Đầu, Xã Tự Lạn, Huyện Việt Yên, Tỉnh Bắc Giang, Việt Nam
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="">
                                <p class="text-green-600 text-xs font-600">Thời gian mở cửa:</p>
                                <p class="text-sm mt-1">09:00 - 22:00</p>
                            </div>
                            <div class="">
                                <a href="" class="text-xs flex items-center font-600 text-blue-700">Đường đi<i
                                        class='bx bx-right-arrow-alt'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto bg-white mt-4">
                <h4 class="uppercase text-xl font-600">Xicomex</h4>
                <div class="grid xl:grid-cols-4 gap-6">
                    <div class="bg-sky-50 mt-6 p-4 rounded">
                        <h5 class="font-600 text-left">Thông tin và chính sách</h5>
                        <div class="">
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-badge-check text-sky-700 mr-1'></i>Chính
                                sách
                                bảo hành </a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-car text-sky-700 mr-1'></i>Chính sách
                                vận chuyển</a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-check-shield text-sky-700 mr-1'></i>Chính
                                sách
                                bảo hành </a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-error-circle text-sky-700 mr-1'></i>Về
                                chúng tôi</a>
                        </div>
                    </div>
                    <div class="bg-sky-50 mt-6 p-4 rounded">
                        <h5 class="font-600 text-left">Mạng xã hội</h5>
                        <div class="">
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxl-facebook-circle text-sky-700 mr-1'></i>Facebook</a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxl-youtube text-sky-700 mr-1'></i>Youtube</a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxl-tiktok text-sky-700 mr-1'></i>Tiktok
                            </a>
                        </div>
                    </div>
                    <div class="bg-sky-50 mt-6 p-4 rounded">
                        <h5 class="font-600 text-left">Thông tin</h5>
                        <div class="">
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-location-plus text-sky-700 mr-1'></i>Thôn Đầu, Xã Tự Lạn, Huyện Việt Yên,
                                Tỉnh Bắc
                                Giang, Việt Nam</a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-phone-call text-sky-700 mr-1'></i>0374407152</a>
                            <a href="" class="flex items-center text-sm m-1"><i
                                    class='bx bxs-envelope text-sky-700 mr-1'></i>trugvann.24@gmail.com </a>
                        </div>
                    </div>
                    <div class="bg-sky-50 mt-6 p-4 rounded">
                        <h5 class="font-600 text-left">Gửi đánh giá về trang web</h5>
                        <div class="">
                            <span class="text-sm text-black font-400 block py-2">Hãy cho chúng tôi biết được trải nghiệm
                                của quý
                                khách về trang web, đội ngũ sẽ lắng nghe và tiếp thu ý kiến</span>
                            <button
                                class="mt-2 bg-blue-600 rounded-sm w-full text-white py-2 font-600 flex items-center justify-center mr-2">Gửi
                                phản hồi<i class='bx bx-right-arrow-alt'></i></button>
                        </div>
                    </div>
                </div>
                <p class="py-4 text-center font-600 text-sm text-gray-800 ">2023@Van Nguyen Trung</p>
            </div>

        </footer>
    </div>
</template>
<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed, watchEffect } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
const isNavbarFixed = ref(false);
const handleScroll = () => {
    isNavbarFixed.value = window.scrollY > 0;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});
const form = useForm({
    query: "",
});
</script>
