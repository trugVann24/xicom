<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLabel from "../../../Components/InputLabel.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import Checkbox from "../../../Components/Checkbox.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";

const props = defineProps({
    permission: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    name: props.permission?.name,
});
const breadcrumbs = [
    { text: 'Danh sách quyền', url: route('permissions.index') },
    { text: 'Sửa quyền', url: '' },
];
</script>
<template>
    <Head title="Sửa quyền" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-500">Sửa quyền</h1>
            <div class="mt-6 max-w-md mx-auto border p-3">
                <form @submit.prevent="form.put(route('permissions.update', permission.id))">
                    <div>
                        <InputLabel for="name" value="Tên" />
                        <TextInput id="name" type="name" class="mt-1 block w-full border px-3 py-2" v-model="form.name"
                            autocomplete="current-name" />
                        <InputError class="mt-2" :message="form.errors.name" />
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
