<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Perfil" />

    <AuthenticatedLayout>
        <template #header>
            <div
                class="flex items-center pl-4 border-l-4 border-cyan-500 py-1 transition-all duration-300"
            >
                <h2
                    class="font-bold text-xl text-slate-100 tracking-wide font-mono uppercase"
                >
                    Perfil de usuario
                </h2>
            </div>
        </template>

        <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="h-full"
                />

                <UpdatePasswordForm class="h-full" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
