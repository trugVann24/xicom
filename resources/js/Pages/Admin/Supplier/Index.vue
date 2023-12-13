<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watchEffect } from "vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import Table from "../../../Components/Table.vue";
import TableDataCell from "../../../Components/TableDataCell.vue";
import TableHeaderCell from "../../../Components/TableHeaderCell.vue";
import TableRow from "../../../Components/TableRow.vue";
import Modal from "../../../Components/Modal.vue";
import ModalContent from "../../../Components/ModalContent.vue";
import DangerButton from "../../../Components/DangerButton.vue";
import SecondaryButton from "../../../Components/SecondaryButton.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";
import TextInput from "../../../Components/TextInput.vue";
import Pagination from "@/Components/Pagination.vue";
const showConfirmDeleteSupplier = ref(false);
const form = useForm({});
const confirmDeleteSupplier = () => {
    showConfirmDeleteSupplier.value = true;
};
const closeModal = () => {
    showConfirmDeleteSupplier.value = false;
};

const deleteSupplier = (id) => {
    form.delete(route("suppliers.destroy", id), {
        onSuccess: () => closeModal(),
    });
};

const breadcrumbs = [
    { text: 'Danh sách nhà cung cấp', url: route('suppliers.index') },
];
defineProps({
    suppliers: Object,
});
</script>
<template>
    <Head title="Nhà cung cấp" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h3 class="font-500 text-base">Danh sách nhà cung cấp</h3>
            <div class="flex items-center justify-between">
                <div class="">
                    <form action="">
                        <!-- <TextInput id="search" type="text" name="search" class="" placeholder="Tìm kiếm ..." /> -->
                    </form>
                </div>
                <Link :href="route('suppliers.create')"
                    class="text-white bg-sky-600 px-3 py-2 rounded-sm text-sm font-500 flex items-center"><i
                    class='bx bx-save mr-1'></i>Thêm nhà cung cấp</Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Tên nhà cung cấp</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Số điện thoại</TableHeaderCell>
                        <TableHeaderCell>Địa chỉ</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="supplier in suppliers.data" :key="supplier.id" class="border-b">
                            <TableDataCell>{{ supplier.id }}</TableDataCell>
                            <TableDataCell>{{ supplier.name }}</TableDataCell>
                            <TableDataCell>{{ supplier.email }}</TableDataCell>
                            <TableDataCell>{{ supplier.address }}</TableDataCell>
                            <TableDataCell>{{ supplier.phone }}</TableDataCell>
                            <TableDataCell class="space-x-4 ">
                                <Link :href="route('suppliers.edit', supplier.id)" as="button"
                                    class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full ">
                                <i class='bx bx-edit-alt text-lg'></i></Link>
                                <button @click="confirmDeleteSupplier"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-lg'></i>
                                </button>
                                <Modal :show="showConfirmDeleteSupplier" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteSupplier(supplier.id)
                                                ">Xoá</DangerButton>
                                            <SecondaryButton @click="closeModal">Huỷ</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
                <!-- Pagination -->
                <Pagination :links="suppliers.links" />
            </div>

        </div>
    </AuthenticatedLayout>
</template>
