<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ref,computed, watchEffect } from "vue";
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

const showConfirmDeleteProduct = ref(false);
const form = useForm({query: "",});
const confirmDeleteProduct = () => {
    showConfirmDeleteProduct.value = true;
};
const closeModal = () => {
    showConfirmDeleteProduct.value = false;
};

const deleteProduct = (id) => {
    form.delete(route("products.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
const selectedProduct = ref({});
const showDataProduct = ref(false);
const showSelectDataProductByID = (productItem) => {
    selectedProduct.value = productItem;
    showDataProduct.value = true;
};
const closeModalSelect = () => {
    showDataProduct.value = false;
};

const breadcrumbs = [
    { text: 'Danh sách sản phẩm', url: route('products.index') },
];
defineProps({
    products: Object,
});

</script>
<template>
    <Head title="Sản phẩm" />

    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <BreadcrumbsVue :breadcrumbs="breadcrumbs" />
            <h3 class="font-500 text-base">Danh sách sản phẩm</h3>
            <div class="flex items-center justify-between">
                <div class="">
                    <form action="">
                        <TextInput id="search" type="text" name="search" class="" placeholder="Tìm kiếm ..." v-model="form.query"/>
                    </form>
                </div>
                <Link :href="route('products.create')"
                    class="text-white bg-sky-600 px-3 py-2 rounded-sm text-sm font-500 flex items-center"><i
                    class='bx bx-save mr-1'></i>Thêm
                sản phẩm </Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableHeaderCell>ID</TableHeaderCell>
                        <TableHeaderCell>Danh mục</TableHeaderCell>
                        <TableHeaderCell>Thương hiệu</TableHeaderCell>
                        <TableHeaderCell>Sản phẩm</TableHeaderCell>
                        <TableHeaderCell>Hình ảnh</TableHeaderCell>
                        <TableHeaderCell>Giá</TableHeaderCell>
                        <TableHeaderCell>Số lượng</TableHeaderCell>
                        <TableHeaderCell>Đã bán</TableHeaderCell>
                        <TableHeaderCell>Hiển thị</TableHeaderCell>
                        <TableHeaderCell>Thao Tác</TableHeaderCell>
                    </template>
                    <template #default>
                        <TableRow v-for="product in products.data" :key="product.id" class="border-b">
                            <TableDataCell>{{ product.id }}</TableDataCell>
                            <TableDataCell>{{ product.category.name }}</TableDataCell>
                            <TableDataCell>{{ product.brand.name }}</TableDataCell>
                            <TableDataCell>{{ product.name }}</TableDataCell>
                            <TableDataCell>
                                <div class="w-10 h-10 overflow-hidden ">
                                    <img :src="`/image/products/${product.image}`" alt=""
                                        classs="w-full h-full overflow-hidden object-cover">
                                </div>
                            </TableDataCell>
                            <TableDataCell >{{ product.price }} VNĐ</TableDataCell>
                            <TableDataCell >{{ product.quantity }} </TableDataCell>
                            <TableDataCell >{{ product.sold_quantity }}</TableDataCell>
                            <TableDataCell v-if="product.status === 1">
                                <i class='bx bx-check-circle text-green-500 text-lg'></i>
                            </TableDataCell>
                            <TableDataCell v-else>
                                <i class='bx bx-x-circle text-red-500 text-lg'></i>
                            </TableDataCell>
                            <TableDataCell class="space-x-4 ">
                                <button class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full "
                                    @click="showSelectDataProductByID(product)">
                                    <i class='bx bx-show-alt text-lg'></i>
                                </button>
                                <Link :href="route('products.edit', product.id)" as="button"
                                    class="w-8 h-8 bg-gray-50 text-sky-500 font-500 rounded-full ">
                                <i class='bx bx-edit-alt text-lg'></i></Link>
                                <button @click="confirmDeleteProduct"
                                    class="w-8 h-8 bg-gray-50 text-red-500 font-500 rounded-full ">
                                    <i class='bx bx-trash-alt text-lg'></i>
                                </button>
                                <Modal :show="showConfirmDeleteProduct" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg text-slate-800 font-semibold">
                                            Bạn có chắc chắn muốn xoá ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="($event) =>
                                                deleteProduct(product.id)
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
                <Pagination :links="products.links" />
            </div>
            <!-- Modal -->
            <ModalContent :show="showDataProduct" @close="closeModalSelect">
                <div class="p-6">

                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Tên sản phẩm:
                        </p>
                        <h3>{{ selectedProduct.name }}</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Slug:
                        </p>
                        <h3>{{ selectedProduct.slug }}</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Số lượng sản phẩm:
                        </p>
                        <h3>{{ selectedProduct.quantity }}</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Giá nhập vào:
                        </p>
                        <h3>{{ selectedProduct.import_price }} vnđ</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Giá bán ra:
                        </p>
                        <h3>{{ selectedProduct.price }} vnđ</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Giảm giá:
                        </p>
                        <h3>{{ selectedProduct.percent_discount }} %</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Giá cuối cùng:
                        </p>
                        <h3>{{ selectedProduct.reduced_price }}</h3>
                    </div>
                    <div class="flex items-center text-sm font-500">
                        <p class=" my-2 text-sky-600 mr-2">Trạng thái hoạt động:
                        </p>
                        <div v-if="selectedProduct.status == 1">
                            <span class="px-3 py-1 bg-green-50 text-green-600">Hiển thị</span>
                        </div>
                        <div v-else>
                            <span class="px-3 py-1 bg-red-50 text-red-600">Ẩn</span>
                        </div>
                    </div>
                    <!-- <div class="">
                        <p class="font-500 my-2 text-sky-600 mr-2">Hình ảnh :</p>
                        <img v-lazy="'storage/' + selectedProduct.image" alt="" class="w-32 h-32 object-cover">
                    </div> -->
                    <p class="font-500 my-2 text-sky-600 mr-2">Bài viết:</p>
                    <span class="text-sm" v-html="selectedProduct.description"></span>
                    <div class="mt-6 flex space-x-4">
                        <SecondaryButton @click="closeModalSelect">Đóng</SecondaryButton>
                    </div>
                </div>
            </ModalContent>
        </div>
    </AuthenticatedLayout>
</template>
