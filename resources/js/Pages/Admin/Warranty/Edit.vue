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
    category: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    name: props.category?.name,
    slug: props.category?.slug,
    status: props.category?.status, 
});
const breadcrumbs = [
    { text: 'Danh sách danh mục', url: route('categories.index') },
    { text: 'Sửa danh mục', url: '' },
];
const slugify = (text) => {
    text = text.replace(/đ/g, "d").replace(/Đ/g, "D");
    text = text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    return text
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\-]+/g, "")
        .replace(/\-\-+/g, "-")
        .replace(/^-+/, "")
        .replace(/-+$/, "");
};
watch(
    () => form.name,
    (newValue) => {
        form.slug = slugify(newValue);
    }
);
</script>
<template>
    <Head title="Sửa danh mục" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-medium">Sửa danh mục</h1>

            <div class="mt-6 max-w-md mx-auto border p-3">
                <form @submit.prevent="form.put(route('categories.update', category.id))">
                    <div class="mt-2">
                        <InputLableRequired for="name" value="Tên danh mục" />
                        <TextInput id="name" type="name" class="mt-1 block w-full border px-3 py-2" v-model="form.name"
                            autocomplete="current-name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mt-2">
                        <InputLableRequired for="slug" value="Slug" />
                        <TextInput id="slug" type="slug" class="mt-1 block w-full border px-3 py-2" v-model="form.slug"
                            autocomplete="current-name" />
                        <InputError class="mt-2" :message="form.errors.slug" />
                    </div>
                    <div class="mt-2">
                        <InputLableRequired for="status" value="Trạng thái hoạt động">
                        </InputLableRequired>
                        <div class="flex items-center my-2">
                            <input id="status" type="checkbox" name="status" v-model="form.status"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                        </div>
                        <InputError class="mt-2" :message="form.errors.status" />
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
