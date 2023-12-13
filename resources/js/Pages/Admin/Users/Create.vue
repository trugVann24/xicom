<script setup>
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";

defineProps({
    roles: Array,
    permissions: Array,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    roles: [],
    permissions: [],
});
const submit = () => {
    form.post(route("users.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
const breadcrumbs = [
    { text: 'Danh sách tài khoản', url: route('users.index') },
    { text: 'Thêm tài khoản', url: route('users.create') }
];
</script>

<template>
    <Head title="Tạo tài khoản" />
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-medium text-base">Tạo tài khoản</h1>
            <div class="mt-6 w-full mx-auto border p-3">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <InputLabel for="name" value="Họ Tên" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="">
                            <InputLabel for="email" value="Email" />
                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autocomplete="username" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="">
                            <InputLabel for="password" value="Mật khẩu" />
                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                                autocomplete="new-password" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="">
                            <InputLabel for="password_confirmation" value="Xác nhận mật khẩu" />
                            <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                                v-model="form.password_confirmation" required autocomplete="new-password" />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="roles" value="Vai trò" />
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="role in roles" :key="role.id">
                                <input type="checkbox" :id="'role-' + role.id" :value="role.id" v-model="form.roles"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2">
                                <label :for="'role-' + role.id" class="ms-2 text-sm font-medium text-gray-900 ">
                                    {{ role.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="permissions" value="Quyền" />
                        <div class="grid grid-cols-4 gap-4">
                            <div v-for="permission in permissions" :key="permission.id">
                                <input type="checkbox" :id="'permission-' + permission.id" :value="permission.id"
                                    v-model="form.permissions"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 focus:ring-2">
                                <label :for="'permission-' + permission.id" class="ms-2 text-sm font-medium text-gray-900 ">
                                    {{ permission.name }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Tạo tài khoản mới
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
