<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLabel from "../../../Components/InputLabel.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import Checkbox from "../../../Components/Checkbox.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import { onMounted, watch } from "vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";

const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
    permissions: Array,
});
const form = useForm({
    name: props.role.name,
    permissions: [],
});
const breadcrumbs = [
    { text: 'Danh sách vai trò', url: route('roles.index') },
    { text: 'Sửa vai trò', url: '' },
];
onMounted(() => {
    form.permissions = props.role.permissions.map(p => p.id);
});

watch(
    () => props.role,
    (newRole) => {
        if (newRole && newRole.permissions) {
            form.permissions = newRole.permissions.map(p => p.id);
        } else {
            form.permissions = [];
        }
    }
);
</script>
<template>
    <Head title="Sửa vai trò" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-500">Sửa vai trò</h1>
            <div class="mt-6 max-w-2xl mx-auto border p-3">
                <form @submit.prevent="form.put(route('roles.update', role.id))">
                    <div>
                        <InputLabel for="name" value="Tên" />
                        <TextInput id="name" type="name" class="mt-1 block w-full border px-3 py-2" v-model="form.name"
                            autocomplete="current-name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mt-5">
                        <InputLabel for="permissions" value="Permissions" />
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="permission in permissions" :key="permission.id">
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" :id="'permission-' + permission.id" :value="permission.id"
                                        v-model="form.permissions"
                                        :checked="props.role.permissions.some(rolePermission => rolePermission.id === permission.id)"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2">
                                    <label :for="'permission-' + permission.id"
                                        class="ms-2 text-sm font-medium text-gray-900 ">{{ permission.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Lưu lại
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
