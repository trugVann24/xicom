<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('customer.register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="max-w-sm mx-auto border p-5 rounded-md mt-10">
                <h2 class="text-xl font-600 text-center leading-7 text-gray-900">Đăng ký</h2>
                <p class="mt-1 text-sm leading-6 text-center text-gray-600">Tạo tài khoản với Xicomex</p>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                            autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="name" value="Tên" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                            autocomplete="current-name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="password" value="Mật khẩu" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Xác nhận mật khẩu" />
                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ms-4 w-full" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Đăng ký
                        </PrimaryButton>
                    </div>
                    <div class="">
                        <p class="text-sm text-center mt-4">
                            Bạn đã có tài khoản ?
                            <Link :href="route('customer.get.login')" class="text-sky-600">Đăng nhập</Link>
                        </p>
                    </div>
                </form>
            </div>
        </form>
    </GuestLayout>
</template>
