<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watchEffect } from "vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import Table from "../../../Components/Table.vue";
import TableHeaderCell from "../../../Components/TableHeaderCell.vue";
import TableDataCell from "../../../Components/TableDataCell.vue";
import TableRow from "../../../Components/TableRow.vue";
import Modal from "../../../Components/Modal.vue";
import DangerButton from "../../../Components/DangerButton.vue";
import SecondaryButton from "../../../Components/SecondaryButton.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";
const showConfirmDeleteUser = ref(false);
const form = useForm({});
const confirmDeleteUser = () => {
    showConfirmDeleteUser.value = true;
};
const closeModal = () => {
    showConfirmDeleteUser.value = false;
};

const deleteUser = (id) => {
    form.delete(route("users.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
const breadcrumbs = [
    { text: 'Danh sách tài khoản', url: route('users.index') },
];
defineProps(["users"]);
</script>
<template>
    <Head title="Tài khoản" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <div class="flex items-center justify-between">
                <h1 class="font-medium text-base">Danh sách tài khoản</h1>
                <Link :href="route('users.create')"
                    class="text-white bg-sky-600 px-3 py-2 rounded-sm text-sm font-500 flex items-center"><i
                    class='bx bx-save mr-1' />Tạo
                tài khoản</Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Tên</TableHeaderCell>
                        <TableHeaderCell>Email</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="user in users" :key="user.id" class="border-b">
                            <TableDataCell>{{ user.id }}</TableDataCell>
                            <TableDataCell>{{ user.name }}</TableDataCell>
                            <TableDataCell>{{ user.email }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <Link :href="route('users.edit', user.id)" as="button"
                                    class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full ">
                                <i class='bx bx-edit-alt text-xl'></i>
                                </Link>
                                <button @click="confirmDeleteUser"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-xl'></i>
                                </button>
                                <Modal :show="showConfirmDeleteUser" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteUser(user.id)
                                                ">Xoá</DangerButton>
                                            <SecondaryButton @click="closeModal">Huỷ</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
