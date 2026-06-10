<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section
        class="bg-[#090f1c]/60 backdrop-blur-sm border border-slate-800 rounded-2xl p-6 sm:p-8 shadow-xl"
    >
        <header class="border-b border-slate-800/80 pb-4">
            <span
                class="text-[10px] font-mono tracking-widest text-cyan-400 uppercase"
                >// sys_sec_auth_02</span
            >
            <h2
                class="text-lg font-bold text-slate-100 font-mono tracking-wide mt-1"
            >
                Actualizar Contraseña
            </h2>
            <p class="mt-1 text-xs text-slate-400">
                Asegúrese de mantener una credencial de acceso robusta para
                resguardar el ecosistema.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-5">
            <div>
                <InputLabel
                    for="current_password"
                    value="Contraseña Actual"
                    class="text-slate-300 font-mono text-xs uppercase tracking-wider mb-2 block"
                />
                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full bg-[#0d1527]/90 border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/20 text-slate-200 rounded-xl"
                    autocomplete="current-password"
                />
                <InputError
                    :message="form.errors.current_password"
                    class="mt-2 text-rose-400 font-mono text-xs"
                />
            </div>

            <div>
                <InputLabel
                    for="password"
                    value="Nueva Frase de Seguridad"
                    class="text-slate-300 font-mono text-xs uppercase tracking-wider mb-2 block"
                />
                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full bg-[#0d1527]/90 border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/20 text-slate-200 rounded-xl"
                    autocomplete="new-password"
                />
                <InputError
                    :message="form.errors.password"
                    class="mt-2 text-rose-400 font-mono text-xs"
                />
            </div>

            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Confirmar Nueva Frase"
                    class="text-slate-300 font-mono text-xs uppercase tracking-wider mb-2 block"
                />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full bg-[#0d1527]/90 border-slate-800 focus:border-cyan-500 focus:ring-cyan-500/20 text-slate-200 rounded-xl"
                    autocomplete="new-password"
                />
                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2 text-rose-400 font-mono text-xs"
                />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <PrimaryButton
                    :disabled="form.processing"
                    class="bg-cyan-600 hover:bg-cyan-500 text-white border border-cyan-400/20 font-mono text-xs uppercase tracking-widest px-5 py-2.5 rounded-xl transition-all duration-200 active:scale-95"
                >
                    🔒 Reconfigurar Credencial
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
                        ✔ Actualizada.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
