<script setup>
import { ref, computed, watchEffect } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import SidebarLink from "@/Components/SidebarLink.vue"
const openSidebar = ref(true);
const showingNavigationDropdown = ref(false);

</script>

<template>
    <div class="flex">
        <nav class="">
            <div class="h-screen overflow-y-auto transition-width duration-300 ease-linear scrollbar-thin "
                :class="openSidebar ? 'w-64' : 'w-0'">
                <ul class="px-2">
                    <li class="py-3 ">
                        <a href="">
                            <p class="text-center text-xl uppercase font-600">
                                Admin
                                <span class="text-sky-600">Xicomex</span>
                            </p>
                        </a>
                    </li>
                    <li class="py-2">
                        <SidebarLink :href="route('dashboard')" :active="route().current('dashboard')">
                            <i class='bx bx-home text-xl mr-2'></i>
                            Trang chủ
                        </SidebarLink>
                    </li>
                    <li class="py-2">
                        <div class="flex items-center bg-gray-50 border-r-[4px] border-gray-400 font-500 text-gray-600 px-3 py-[6px]">
                            <p>Quản lý</p>
                        </div>
                        <ul>
                            <li class="py-1">
                                <SidebarLink :href="route('categories.index')" :active="route().current('categories.index')">
                                    <i class='bx bx-notepad mr-2 text-lg'></i>
                                    Danh mục
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('brands.index')" :active="route().current('brands.index')">
                                    <i class='bx bx-cube-alt mr-2 text-lg'></i>
                                    Thương hiệu
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('suppliers.index')" :active="route().current('suppliers.index')">
                                    <i class='bx bx-cube-alt mr-2 text-lg'></i>
                                    Nhà cung cấp
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('products.index')" :active="route().current('products.index')">
                                    <i class='bx bx-hive mr-2 text-lg'></i>
                                    Sản phẩm
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('warranties.index')" :active="route().current('warranties.index')">
                                    <i class='bx bx-hive mr-2 text-lg'></i>
                                   Bảo hành
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <a href=""
                                    class="flex items-center justify-between font-500 text-sm pl-6 py-[6px] text-gray-500 rounded-md">
                                    <div class="flex items-center">
                                        <i class='bx bx-cart-alt mr-2 text-lg'></i>
                                        <p>Đơn hàng</p>
                                    </div>
                                    <p class="w-6 h-6 bg-sky-50 flex items-center justify-center rounded-full text-sky-500">
                                        6</p>
                                </a>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('customers.index')" :active="route().current('customers.index')">
                                    <i class='bx bx-group mr-2 text-lg'></i>
                                    Khách hàng
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <a href=""
                                    class="flex items-center font-500 text-sm pl-6 py-[6px] text-gray-500 rounded-md">
                                    <i class='bx bx-purchase-tag-alt mr-2 text-lg'></i>
                                    Mã giảm giá
                                </a>
                            </li>
                            <li class="py-1">
                                <a href=""
                                    class="flex items-center font-500 text-sm pl-6 py-[6px] text-gray-500 rounded-md">
                                    <i class='bx bx-star mr-2 text-lg'></i>
                                    Đánh giá
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="py-2">
                        <div class="flex items-center bg-gray-50 border-r-[4px] border-gray-400 font-500 text-gray-600 px-3 py-[6px]">
                            <p>Administrator</p>
                        </div>
                        <ul>
                            <li class="py-1">
                                <SidebarLink :href="route('users.index')" :active="route().current('users.index')">
                                    <i class='bx bx-user mr-2 text-lg'></i>
                                    Tài khoản
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('roles.index')" :active="route().current('roles.index')">
                                    <i class='bx bx-shield-alt-2 mr-2 text-lg'></i>
                                    Vai trò
                                </SidebarLink>
                            </li>
                            <li class="py-1">
                                <SidebarLink :href="route('permissions.index')"
                                    :active="route().current('permissions.index')">
                                    <i class='bx bx-layer mr-2 text-lg'></i>
                                    Quyền
                                </SidebarLink>
                            </li>
                        </ul>
                    </li>
                    <li class="py-2">
                        <a href="" class="flex items-center font-500 text-gray-600 px-3 py-[6px] rounded-md">
                            <i class='bx bx-cog text-xl mr-1'></i>
                            <p>Cài đặt</p>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="w-full h-screen">
            <!-- Navigation Menu -->
            <div class="w-full  px-4 sm:px-6 lg:px-8 ">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <button @click="openSidebar = !openSidebar" class="bg-gray-50 px-2 rounded-md">
                            <i :class="openSidebar ? 'bx bx-chevron-left' : 'bx bx-chevron-right'" class='text-2xl'></i>
                        </button>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                            {{ $page.props.auth.user.name }}

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
                                    <DropdownLink :href="route('profile.edit')"> Cá nhân </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Đăng xuất
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Page Content -->
            <div class="py-12">
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
