<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, } from "vue";
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

const showConfirmDeleteCustomer = ref(false);
const form = useForm({});
const confirmDeleteCustomer = () => {
    showConfirmDeleteCustomer.value = true;
};
const closeModal = () => {
    showConfirmDeleteCustomer.value = false;
};

const deleteCustomer = (id) => {
    form.delete(route("customers.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
const breadcrumbs = [
    { text: 'Danh sách khác hàng', url: route('customers.index') },
];
defineProps(["customers"]);
</script>
<template>
    <Head title="Khách hàng" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h3 class="font-medium text-base">Danh sách khách hàng</h3>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Tên</TableHeaderCell>
                        <TableHeaderCell>Hình ảnh</TableHeaderCell>
                        <TableHeaderCell>Địa chỉ</TableHeaderCell>
                        <TableHeaderCell>Số điện thoại</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="customer in customers.data" :key="customer.id" class="border-b">
                            <TableDataCell>{{ customer.id }}</TableDataCell>
                            <TableDataCell>{{ customer.email }}</TableDataCell>
                            <TableDataCell>{{ customer.name }}</TableDataCell>
                            <TableDataCell>
                                <div class="w-10 h-10 overflow-hidden ">
                                    <!-- <img :src="`/image/customers/${customer.image}`" alt=""
                                        classs="w-full h-full overflow-hidden object-cover"> -->
                                </div>
                            </TableDataCell>
                            <TableDataCell>{{ customer.address }}</TableDataCell>
                            <TableDataCell>{{ customer.phone }}</TableDataCell>
                            <TableDataCell class="space-x-4 ">
                                <button @click="confirmDeleteCustomer"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-xl'></i>
                                </button>
                                <Modal :show="showConfirmDeleteCustomer" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteCustomer(customer.id)
                                                ">Xoá</DangerButton>
                                            <SecondaryButton @click="closeModal">Huỷ</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
                <Pagination :links="customers.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
