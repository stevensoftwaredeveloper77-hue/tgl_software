<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <div
        class="min-h-screen bg-[#030712] flex flex-col justify-center items-center px-4 relative overflow-hidden selection:bg-blue-500/30"
    >
        <div
            class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-blue-600/10 rounded-full blur-[150px] pointer-events-none"
        ></div>
        <div
            class="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-blue-500/5 rounded-full blur-[130px] pointer-events-none"
        ></div>

        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#1f293708_1px,transparent_1px),linear-gradient(to_bottom,#1f293708_1px,transparent_1px)] bg-[size:3rem_3rem] pointer-events-none"
        ></div>

        <Head title="Iniciar sesión" />

        <div class="w-full max-w-md relative z-10">
            <div class="text-center mb-8 group">
                <div
                    class="inline-flex items-center justify-center p-3 rounded-2xl bg-slate-900/60 border border-slate-800 mb-4 shadow-xl shadow-blue-500/5 group-hover:border-blue-500/30 transition-all duration-500"
                >
                    <i
                        class="fa-solid fa-microchip text-2xl text-blue-500 group-hover:rotate-90 transition-transform duration-700"
                    ></i>
                    <span
                        class="ml-3 font-sans tracking-wider text-xl font-extrabold text-white"
                        >TGL <span class="text-blue-500">SOFT</span></span
                    >
                </div>
            </div>

            <div
                class="rounded-2xl border border-slate-800/90 bg-slate-900/40 p-8 backdrop-blur-md shadow-2xl shadow-blue-950/20 relative overflow-hidden"
            >
                <div
                    class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-blue-500/40 to-transparent"
                ></div>

                <div class="mb-6">
                    <p
                        class="text-blue-500 font-mono text-[10px] uppercase tracking-widest mb-1 font-semibold"
                    >
                        // GATEWAY_AUTH_REQUIRED
                    </p>
                    <h1 class="text-xl font-bold text-white tracking-tight">
                        Ecosistema Operacional
                    </h1>
                </div>

                <div
                    v-if="status"
                    class="mb-5 font-mono text-xs text-emerald-400 bg-emerald-950/30 border border-emerald-900/40 p-3 rounded-xl"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <InputLabel
                                for="email"
                                value="Usuario corporativo"
                                class="text-slate-400 font-medium text-[11px] font-mono uppercase tracking-wider"
                            />
                            <span class="text-[10px] font-mono text-slate-600"
                                >SYS_ADMIN</span
                            >
                        </div>

                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors"
                            >
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </div>
                            <TextInput
                                id="email"
                                type="email"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-950/60 border-slate-800/80 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-white rounded-xl placeholder-slate-600 transition-all duration-300 text-sm"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@tglsoft.com"
                            />
                        </div>

                        <InputError
                            class="mt-1.5 text-xs text-rose-400 font-mono"
                            :message="form.errors.email"
                        />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <InputLabel
                                for="password"
                                value="Clave de acceso"
                                class="text-slate-400 font-medium text-[11px] font-mono uppercase tracking-wider"
                            />
                            <span class="text-[10px] font-mono text-slate-600"
                                >ENCRYPTED</span
                            >
                        </div>

                        <div class="relative group">
                            <div
                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors"
                            >
                                <i class="fa-solid fa-lock text-xs"></i>
                            </div>
                            <TextInput
                                id="password"
                                type="password"
                                class="block w-full pl-10 pr-4 py-2.5 bg-slate-950/60 border-slate-800/80 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-white rounded-xl placeholder-slate-600 transition-all duration-300 text-sm"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                        </div>

                        <InputError
                            class="mt-1.5 text-xs text-rose-400 font-mono"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label
                            class="flex items-center cursor-pointer group select-none"
                        >
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                                class="rounded-md bg-slate-950 border-slate-800 text-blue-600 focus:ring-blue-500/20 focus:ring-offset-slate-900 w-4 h-4"
                            />
                            <span
                                class="ms-2 text-xs text-slate-400 group-hover:text-slate-300 transition-colors font-mono"
                                >Recordarme</span
                            >
                        </label>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-xs text-slate-500 hover:text-blue-400 transition-colors font-mono tracking-tight"
                        >
                            ¿Olvidaste tu contraseña?
                        </Link>
                    </div>

                    <div class="pt-3">
                        <PrimaryButton
                            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold text-sm rounded-xl transition-all duration-300 shadow-xl shadow-blue-600/15 active:scale-[0.98] border border-blue-500/20"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            <span>Autenticar Sistema</span>
                            <i
                                class="fa-solid fa-shield-halved text-xs opacity-80"
                            ></i>
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <div
                class="text-center mt-6 text-[10px] font-mono text-slate-600 tracking-wide"
            >
                SYSTEM_VERSION: 2.0.0 // SECURITY_LEVEL: HIGH
            </div>
        </div>
    </div>
</template>
