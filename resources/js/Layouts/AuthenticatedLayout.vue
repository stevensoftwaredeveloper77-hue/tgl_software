<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div
        class="min-h-screen bg-[#020617] text-slate-300 font-sans selection:bg-blue-500/30"
    >
        <div
            class="fixed inset-0 bg-[linear-gradient(to_right,#1f293708_1px,transparent_1px),linear-gradient(to_bottom,#1f293708_1px,transparent_1px)] bg-[size:4rem_4rem] pointer-events-none"
        ></div>
        <div
            class="fixed top-0 right-0 w-[500px] h-[500px] bg-blue-600/5 rounded-full blur-[120px] pointer-events-none"
        ></div>

        <nav
            class="sticky top-0 z-50 border-b border-slate-800/60 bg-slate-950/80 backdrop-blur-md"
        >
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <div class="flex shrink-0 items-center">
                            <Link
                                :href="route('dashboard')"
                                class="flex items-center gap-2 group"
                            >
                                <div
                                    class="p-1.5 rounded-lg bg-blue-600/10 border border-blue-500/20 group-hover:border-blue-500/50 transition-all"
                                >
                                    <i
                                        class="fa-solid fa-microchip text-blue-500"
                                    ></i>
                                </div>
                                <span
                                    class="hidden md:block font-bold text-white tracking-wider text-sm"
                                    >TGL
                                    <span class="text-blue-500"
                                        >ADMIN</span
                                    ></span
                                >
                            </Link>
                        </div>

                        <div
                            class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex"
                        >
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                                class="flex items-center gap-2 group"
                            >
                                <i
                                    class="fa-solid fa-chart-pie text-[10px] opacity-50 group-hover:opacity-100"
                                ></i>
                                Dashboard
                            </NavLink>
                            <NavLink
                                :href="route('customer.index')"
                                :active="route().current('customer.index')"
                                class="flex items-center gap-2 group"
                            >
                                <i
                                    class="fa-solid fa-users text-[10px] opacity-50 group-hover:opacity-100"
                                ></i>
                                Clientes
                            </NavLink>
                            <NavLink
                                :href="route('appointment.index')"
                                :active="route().current('appointment.index')"
                                class="flex items-center gap-2 group"
                            >
                                <i
                                    class="fa-solid fa-calendar-check text-[10px] opacity-50 group-hover:opacity-100"
                                ></i>
                                Citas
                            </NavLink>
                            <NavLink
                                :href="route('request.index')"
                                :active="route().current('request.index')"
                                class="flex items-center gap-2 group"
                            >
                                <i
                                    class="fa-solid fa-code-pull-request text-[10px] opacity-50 group-hover:opacity-100"
                                ></i>
                                Peticiones
                            </NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <div class="flex items-center gap-4">
                            <div
                                class="hidden lg:flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800"
                            >
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"
                                    ></span>
                                    <span
                                        class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"
                                    ></span>
                                </span>
                                <span
                                    class="text-[10px] font-mono text-slate-500 uppercase tracking-tighter"
                                    >System Live</span
                                >
                            </div>

                            <div class="relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button
                                            type="button"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/50 px-3 py-2 text-xs font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white focus:outline-none"
                                        >
                                            <div
                                                class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center text-[10px] text-white font-bold"
                                            >
                                                {{
                                                    $page.props.auth.user.name.charAt(
                                                        0,
                                                    )
                                                }}
                                            </div>
                                            {{ $page.props.auth.user.name }}
                                            <i
                                                class="fa-solid fa-chevron-down text-[10px] opacity-50"
                                            ></i>
                                        </button>
                                    </template>

                                    <template #content>
                                        <div
                                            class="bg-slate-950 border border-slate-800 rounded-lg overflow-hidden"
                                        >
                                            <DropdownLink
                                                :href="route('profile.edit')"
                                                class="hover:bg-blue-600/10 !text-slate-400 hover:!text-blue-400 font-mono text-[11px]"
                                            >
                                                <i
                                                    class="fa-solid fa-user-gear mr-2"
                                                ></i>
                                                Administrar perfil
                                            </DropdownLink>
                                            <DropdownLink
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                                class="hover:bg-rose-600/10 !text-slate-400 hover:!text-rose-400 font-mono text-[11px]"
                                            >
                                                <i
                                                    class="fa-solid fa-power-off mr-2"
                                                ></i>
                                                Cerrar sesión
                                            </DropdownLink>
                                        </div>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>

                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center rounded-lg p-2 text-slate-400 hover:bg-slate-800 hover:text-white transition"
                        >
                            <i
                                :class="
                                    showingNavigationDropdown
                                        ? 'fa-solid fa-xmark'
                                        : 'fa-solid fa-bars'
                                "
                                class="text-xl"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>

            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden bg-slate-950 border-b border-slate-800"
            >
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                    >
                        Dashboard
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('customer.index')"
                        :active="route().current('customer.index')"
                    >
                        Clientes
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>

        <header
            class="relative bg-[#020617]/50 backdrop-blur-sm border-b border-slate-900"
            v-if="$slots.header"
        >
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4">
                    <div
                        class="h-8 w-1 bg-blue-600 rounded-full shadow-[0_0_15px_rgba(37,99,235,0.5)]"
                    ></div>
                    <slot name="header" />
                </div>
            </div>
        </header>

        <main class="relative py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<style>
nav a[aria-current="page"] {
    color: #fff !important;
    border-bottom: 2px solid #2563eb !important;
    text-shadow: 0 0 10px rgba(37, 99, 235, 0.5);
}
</style>
