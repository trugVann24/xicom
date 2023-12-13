<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, watchEffect, computed } from "vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import Table from "../../../Components/Table.vue";
import TableDataCell from "../../../Components/TableDataCell.vue";
import TableHeaderCell from "../../../Components/TableHeaderCell.vue";
import TableRow from "../../../Components/TableRow.vue";
import Modal from "../../../Components/Modal.vue";
import DangerButton from "../../../Components/DangerButton.vue";
import SecondaryButton from "../../../Components/SecondaryButton.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";
import Pagination from "@/Components/Pagination.vue";
const showConfirmDeleteBrand = ref(false);
const form = useForm({});
const confirmDeleteBrand = () => {
    showConfirmDeleteBrand.value = true;
};
const closeModal = () => {
    showConfirmDeleteBrand.value = false;
};

const deleteBrand = (id) => {
    form.delete(route("brands.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
const breadcrumbs = [
    { text: 'Danh sách thương hiệu', url: route('brands.index') },
];
defineProps(["brands"]);
</script>
<template>
    <Head title="Thương hiệu" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <div class="flex items-center justify-between">
                <h3 class="font-medium text-base">Danh sách thương hiệu</h3>
                <Link :href="route('brands.create')"
                    class="text-white bg-sky-600 px-3 py-2 rounded-sm text-sm font-500 flex items-center"><i
                    class='bx bx-save mr-1'></i>Thêm
                thương hiệu </Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Thương hiệu</TableHeaderCell>
                        <TableHeaderCell>Hình ảnh</TableHeaderCell>
                        <TableHeaderCell>Slug</TableHeaderCell>
                        <TableHeaderCell>Mô tả</TableHeaderCell>
                        <TableHeaderCell>Hiển thị</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="brand in brands.data" :key="brand.id" class="border-b">
                            <TableDataCell class="w-[6%]">{{ brand.id }}</TableDataCell>
                            <TableDataCell class="w-[14%]">{{ brand.name }}</TableDataCell>
                            <TableDataCell class="w-[10%]">
                                <div class="w-10 h-10 overflow-hidden ">
                                    <img :src="`/image/brands/${brand.image}`" alt=""
                                        classs="w-full h-full overflow-hidden object-cover">
                                </div>
                            </TableDataCell>
                            <TableDataCell class="w-[10%]">{{ brand.slug }}</TableDataCell>
                            <TableDataCell class="w-[30%]">{{ brand.description }}</TableDataCell>
                            <TableDataCell v-if="brand.status === 1" class="w-[10%]">
                                <i class='bx bx-check-circle text-green-500 text-xl'></i>
                            </TableDataCell>
                            <TableDataCell v-else class="w-[10%]">
                                <i class='bx bx-x-circle text-red-500 text-xl'></i>
                            </TableDataCell>
                            <TableDataCell class="space-x-4 w-[10%]">
                                <Link :href="route('brands.edit', brand.id)" as="button"
                                    class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full ">
                                <i class='bx bx-edit-alt text-xl'></i></Link>
                                <button @click="confirmDeleteBrand"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-xl'></i>
                                </button>
                                <Modal :show="showConfirmDeleteBrand" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteBrand(brand.id)
                                                ">Xoá</DangerButton>
                                            <SecondaryButton @click="closeModal">Huỷ</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
                <Pagination :links="brands.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
