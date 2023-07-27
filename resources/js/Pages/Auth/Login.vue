<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputForm from "@/Components/Form/InputForm.vue"

defineProps({
    status: String,
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
    <Head title="Log in" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <InputForm text="Correo" name="email" v-model="form.email" required autofocus type="email" class="mb-1" />
            <InputForm text="Contraseña" name="password" v-model="form.password" required type="password" class="mt-4" />

            <div class="block mt-4">
                <Checkbox v-model:checked="form.remember" text="Recordarme" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-4 btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                   Entrar
                </button>
            </div>
        </form>
    </AuthenticationCard>
</template>
