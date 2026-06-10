<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section
        class="bg-[#090f1c]/60 backdrop-blur-sm border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl"
    >
        <header class="border-b border-slate-800/80 pb-4">
            <span
                class="text-[10px] font-mono tracking-widest text-cyan-400 uppercase"
                >// sys_sec_auth_01</span
            >
            <h2
                class="text-lg font-bold text-slate-100 font-mono tracking-wide mt-1"
            >
                Información de Perfil
            </h2>
            <p class="mt-1 text-xs text-slate-400">
                Actualice la información de perfil y la dirección de correo
                electrónico de su cuenta.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-5"
        >
            <div>
                <InputLabel
                    for="name"
                    value="Nombre del Operador"
                    class="text-slate-300 font-mono text-xs uppercase tracking-wider mb-2 block"
                />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full bg-[#0d1527]/90 border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/20 text-slate-200 rounded-xl"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError
                    class="mt-2 text-rose-400 font-mono text-xs"
                    :message="form.errors.name"
                />
            </div>

            <div>
                <InputLabel
                    for="email"
                    value="Correo Electrónico"
                    class="text-slate-300 font-mono text-xs uppercase tracking-wider mb-2 block"
                />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full bg-[#0d1527]/90 border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/20 text-slate-200 rounded-xl"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError
                    class="mt-2 text-rose-400 font-mono text-xs"
                    :message="form.errors.email"
                />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-xs mt-2 text-slate-400">
                    Su dirección de correo electrónico no está verificada.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-xs text-cyan-400 hover:text-cyan-300 rounded-md focus:outline-none font-mono"
                    >
                        Haga clic aquí para reenviar el correo de verificación.
                    </Link>
                </p>
                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-mono text-xs text-emerald-400"
                >
                    Se ha enviado un nuevo enlace de verificación a su dirección
                    de correo electrónico.
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <PrimaryButton
                    :disabled="form.processing"
                    class="bg-cyan-600 hover:bg-cyan-500 text-white border border-cyan-400/20 font-mono text-xs uppercase tracking-widest px-5 py-2.5 rounded-xl transition-all duration-200 active:scale-95"
                >
                    ⚡ Guardar Cambios
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out duration-300"
                    enter-from-class="opacity-0 translate-x-2"
                    leave-active-class="transition ease-in-out duration-200"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-xs font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-md"
                    >
                        ✔ Sincronizado.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
