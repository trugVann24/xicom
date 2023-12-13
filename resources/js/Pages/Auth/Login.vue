<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Đăng nhập" />
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <!-- <form class="" @submit.prevent="submit">
            <div class="max-w-sm mx-auto border p-5 rounded-md mt-10">
                <h2 class="text-xl font-600 text-center leading-7 text-gray-900">Đăng nhập</h2>
                <p class="mt-1 text-sm leading-6 text-center text-gray-600">Trang đăng nhập vào trang quản trị</p>
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-12 md:col-span-12">
                        <label for="email" class="block text-sm font-500 leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email"
                                class="block w-full border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6"
                                v-model="form.email" />
                                <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="sm:col-span-12 md:col-span-12">
                        <label for="password" class="block text-sm font-500 leading-6 text-gray-900">Mật khẩu</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="password"
                                class="block w-full border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 focus:outline-0 sm:text-sm sm:leading-6"
                                v-model="form.password" />
                                <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                    </div>
                    <div class="sm:col-span-12 md:col-span-12">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600">Nhớ mật khẩu</span>
                        </label>
                    </div>
                </div>
                <button :disabled="form.processing"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-500 text-sm w-full px-5 py-2.5 text-center mt-4">
                    Đăng nhập
                </button>
            </div>
        </form> -->
        <div class="max-w-sm mx-auto border p-5 rounded-md mt-10">
            <h2 class="text-xl font-600 text-center leading-7 text-gray-900">Đăng nhập</h2>
            <p class="mt-1 text-sm leading-6 text-center text-gray-600">Trang đăng nhập vào trang quản trị</p>
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                        autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Mật khẩu" />
                    <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                        autocomplete="current-password" />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <div class="">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600">Nhớ mật khẩu</span>
                        </label>
                    </div>
                    <Link v-if="canResetPassword" :href="route('password.request')" class="text-sky-600 text-sm font-500 ">
                    Quên mật khẩu?
                    </Link>
                </div>
                <div class="flex items-center justify-end mt-4">

                    <PrimaryButton class="ms-4 w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Đăng nhập
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
