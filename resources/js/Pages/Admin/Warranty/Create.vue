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
import Editor from "../../../Components/Editor.vue";
const form = useForm({
    product_id: "",
    name: "",
    warranty_period: "",
    warranty_description: ""
});

const breadcrumbs = [
    { text: 'Danh sách bảo hành', url: route('warranties.index') },
    { text: 'Thêm bảo hành', url: route('warranties.create') }
];

</script>
<template>
    <Head title="Thêm bảo hành" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-medium text-base">Thêm bảo hành</h1>
            <div class="mt-6 mx-auto border p-3">
                <form @submit.prevent="form.post(route('warranties.store'))">
                    <div class="mt-2">
                        <InputLableRequired for="warranty_period" value="Thời gian bảo hành" />
                        <TextInput id="warranty_period" type="text" class="mt-1 block w-full border px-3 py-2"
                            v-model="form.warranty_period" autocomplete="current-warranty_period" />
                        <InputError class="mt-2" :message="form.errors.warranty_period" />
                    </div>
                    <div class="mt-2">
                        <InputLableRequired for="warranty_description" value="Chi tiết bảo hành" />
                        <Editor id="warranty_description" type="text" class="mt-1 block w-full border px-3 py-2"
                            v-model="form.warranty_description" autocomplete="current-name"></Editor>
                        <InputError class="mt-2" :message="form.errors.warranty_description" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Tạo mới
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
