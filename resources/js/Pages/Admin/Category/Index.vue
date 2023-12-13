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
const showConfirmDeleteCategory = ref(false);
const form = useForm({});
const confirmDeleteCategory = () => {
    showConfirmDeleteCategory.value = true;
};
const closeModal = () => {
    showConfirmDeleteCategory.value = false;
};

const deleteCategory = (id) => {
    form.delete(route("categories.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
const breadcrumbs = [
    { text: 'Danh sách danh mục', url: route('categories.index') },
];
defineProps(["categories"]);
</script>
<template>
    <Head title="Danh mục" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <div class="flex items-center justify-between">
                <h3 class="font-medium text-base">Danh sách danh mục</h3>
                <Link :href="route('categories.create')"
                    class="text-white bg-sky-600 px-3 py-2 rounded-sm text-sm font-500 flex items-center"><i
                    class='bx bx-save mr-1'></i>Thêm
                danh mục </Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Tên danh mục</TableHeaderCell>
                        <TableHeaderCell>Slug</TableHeaderCell>
                        <TableHeaderCell>Trạng thái</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="category in categories.data" :key="category.id" class="border-b">
                            <TableDataCell>{{ category.id }}</TableDataCell>
                            <TableDataCell>{{ category.name }}</TableDataCell>
                            <TableDataCell>{{ category.slug }}</TableDataCell>
                            <TableDataCell v-if="category.status === 1">
                                <i class='bx bx-check-circle text-green-500 text-xl'></i>
                            </TableDataCell>
                            <TableDataCell v-else>
                                <i class='bx bx-x-circle text-red-500 text-xl'></i>
                            </TableDataCell>
                            <TableDataCell class="space-x-4">
                                <Link :href="route('categories.edit', category.id)" as="button"
                                    class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full ">
                                <i class='bx bx-edit-alt text-xl'></i></Link>
                                <button @click="confirmDeleteCategory"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-xl'></i>
                                </button>
                                <Modal :show="showConfirmDeleteCategory" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteCategory(category.id)
                                                ">Xoá</DangerButton>
                                            <SecondaryButton @click="closeModal">Huỷ</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
                <Pagination :links="categories.links"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
