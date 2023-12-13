<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputLableRequired from "@/Components/InputLableRequired.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import PrimaryButton from "../../../Components/PrimaryButton.vue";
import Checkbox from "../../../Components/Checkbox.vue";
import InputError from "../../../Components/InputError.vue";
import TextInput from "../../../Components/TextInput.vue";
import AuthenticatedLayout from "../../../Layouts/AuthenticatedLayout.vue";
import BreadcrumbsVue from "../../../Components/Breadcrumbs.vue";
import { watch, computed } from "vue";
import Editor from "@/Components/Editor.vue";
const form = useForm({
    category_id: "",
    brand_id: "",
    name: "",
    slug: "",
    image: "",
    price: "",
    quantity: "",
    import_price: "",
    warranty_id:"",
    sold_quantity: 0,
    description: "",
    status: false,
    imagePreview: null,
});
const handleImageChange = (event) => {
    const file = event.target.files[0];
    form.image = file;
    form.imagePreview = URL.createObjectURL(file);
};
const breadcrumbs = [
    { text: 'Danh sách sản phẩm', url: route('products.index') },
    { text: 'Thêm sản phẩm', url: route('products.create') }
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
const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    brands: {
        type: Array,
        required: true,
    },
    warranties: {
        type: Array,
        required: true,
    },
});
watch(
    () => form.name,
    (newValue) => {
        form.slug = slugify(newValue);
    }
);
</script>
<template>
    <Head title="Thêm mới sản phẩm" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h1 class="font-medium text-base">Thêm sản phẩm</h1>
            <div class="mt-6 w-full mx-auto border p-3 rounded">
                <form @submit.prevent="form.post(route('products.store'))">
                    <div class="">
                        <TextInput id="sold_quantity" type="number" class="hidden mt-1 w-full border px-3 py-2"
                            v-model="form.sold_quantity" autocomplete="current-sold_quantity" />
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div class="mt-2">
                            <InputLableRequired for="category_id" value="Danh mục" />
                            <select v-model="form.category_id" id="category_id"
                                class="block w-full border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6 mt-2">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.category_id" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="brand_id" value="Thương hiệu" />
                            <select v-model="form.brand_id" id="brand_id"
                                class="block w-full border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6 mt-2">
                                <option v-for="brand in brands" :key="brand.id" :value="brand.id">
                                    {{ brand.name }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.brand_id" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="warranty_id" value="Thương hiệu" />
                            <select v-model="form.warranty_id" id="warranty_id"
                                class="block w-full border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6 mt-2">
                                <option v-for="warranty in warranties" :key="warranty.id" :value="warranty.id">
                                    {{ warranty.warranty_period }}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.warranty_id" />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-2">
                        <div class="mt-2">
                            <InputLableRequired for="name" value="Tên sản phẩm" />
                            <TextInput id="name" type="text" class="mt-1 block w-full border px-3 py-2" v-model="form.name"
                                autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="slug" value="Slug" />
                            <TextInput id="slug" type="text" class="mt-1 block w-full border px-3 py-2" v-model="form.slug"
                                autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.slug" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="quantity" value="Số lượng" />
                            <TextInput id="quantity" type="text" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.quantity" autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.quantity" />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="mt-2">
                            <InputLableRequired for="price" value="Giá nhập vào (vnđ)" />
                            <TextInput id="price" type="number" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.price" autocomplete="current-name" />
                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div class="mt-2">
                            <InputLableRequired for="import_price" value="Giá bán ra (vnđ)" />
                            <TextInput id="import_price" type="number" class="mt-1 block w-full border px-3 py-2"
                                v-model="form.import_price" autocomplete="current-import_price" />
                            <InputError class="mt-2" :message="form.errors.import_price" />
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
                    </div>
                    <div class="mt-2">
                        <InputLableRequired for="description" value="Bài viết chi tiết" />
                        <Editor id="description" type="text"
                            class="block w-full border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6"
                            v-model="form.description" autocomplete="current-description"></Editor>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="mt-2">
                            <InputLableRequired for="image" value="Hình ảnh" />
                            <input id="image" type="file" class="mt-1 block w-full border px-3 py-2"
                                @input="handleImageChange($event)" />
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>
                        <div class="mt-2">
                            <InputLabel for="image" value="Chi tiết hình ảnh " />
                            <div v-if="form.imagePreview" class="w-full h-full overflow-hidden">
                                <img :src="form.imagePreview" alt="Image preview" class="max-w-full h-auto object-cover" />
                            </div>
                        </div>
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

