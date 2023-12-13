<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLableRequired from "@/Components/InputLableRequired.vue"
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import Checkbox from "../../../Components/Checkbox.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";
import { watch } from "vue";
const props = defineProps({
    supplier: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    name: props.supplier?.name,
    email: props.supplier?.email,
    phone: props.supplier?.phone,
    address: props.supplier?.address,
});
const breadcrumbs = [
    { text: 'Danh sách nhà cung cấp', url: route('suppliers.index') },
    { text: 'Sửa nhà cung cấp', url: '' },
];
</script>
<template>
    <Head title="Sửa nhà cung cấp" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-medium">Sửa nhà cung cấp</h1>

            <div class="t-6 max-w-5xl mx-auto border p-3 rounded">
                <form @submit.prevent="form.put(route('suppliers.update', supplier.id))">
                    <div class="grid grid-cols-2 gap-5">
                        <div class="mt-2">
                            <InputLableRequired for="name" value="Tên nhà cung cấp" />
                            <TextInput id="name" type="text" class="mt-1 block w-full border px-3 py-2" v-model="form.name"
                                autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="email" value="Email" />
                            <TextInput id="email" type="email" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.email" autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <div class="mt-2">
                            <InputLableRequired for="phone" value="Số điện thoại" />
                            <TextInput id="phone" type="text" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.phone" autocomplete="current-phone" />
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="address" value="Địa chỉ" />
                            <TextInput id="address" type="address" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.address" autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.address" />
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
