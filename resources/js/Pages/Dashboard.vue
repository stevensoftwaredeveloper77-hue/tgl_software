<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const modules = [
    {
        name: "Clientes",
        description: "Gestión de usuarios y perfiles.",
        href: route("customer.index"),
        color: "text-blue-400",
        bgColor:
            "bg-blue-950/40 border border-blue-500/20 group-hover:border-blue-400/50 group-hover:shadow-[0_0_15px_rgba(59,130,246,0.3)]",
        svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />',
    },
    {
        name: "Citas",
        description: "Agendamiento y control de estados.",
        href: route("appointment.index"),
        color: "text-emerald-400",
        bgColor:
            "bg-emerald-950/40 border border-emerald-500/20 group-hover:border-emerald-400/50 group-hover:shadow-[0_0_15px_rgba(16,185,129,0.3)]",
        svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />',
    },
    {
        name: "Peticiones",
        description: "Solicitudes y soporte técnico.",
        href: route("request.index"),
        color: "text-purple-400",
        bgColor:
            "bg-purple-950/40 border border-purple-500/20 group-hover:border-purple-400/50 group-hover:shadow-[0_0_15px_rgba(168,85,247,0.3)]",
        svg: '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-slate-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-[#070b14]/40 backdrop-blur-md border border-slate-800/60 shadow-2xl sm:rounded-2xl"
                >
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
                        <Link
                            v-for="module in modules"
                            :key="module.name"
                            :href="module.href"
                            class="group bg-[#0d1527]/50 backdrop-blur-sm border border-slate-800/80 rounded-2xl p-6 transition-all duration-300 hover:border-slate-700 hover:bg-[#111a30]/70 hover:-translate-y-1 shadow-lg"
                        >
                            <div class="flex flex-col items-center text-center">
                                <div
                                    :class="[
                                        module.bgColor,
                                        module.color,
                                        'p-4 rounded-full mb-4 group-hover:scale-105 transition-all duration-300',
                                    ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-8 h-8"
                                        v-html="module.svg"
                                    ></svg>
                                </div>

                                <h3
                                    class="text-xl font-bold text-slate-200 mb-1.5 transition-colors duration-300 group-hover:text-blue-400"
                                >
                                    {{ module.name }}
                                </h3>

                                <p
                                    class="text-slate-400 text-sm leading-relaxed transition-colors duration-300 group-hover:text-slate-300"
                                >
                                    {{ module.description }}
                                </p>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
