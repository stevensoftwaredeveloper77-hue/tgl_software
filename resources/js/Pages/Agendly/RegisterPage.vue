<script setup>
import { ref, computed, onMounted } from "vue";
import { Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    tipo: String,
    businessCategories: Array,
});

const form = useForm({
    role: "cliente",
    name: "",
    email: "",
    password: "",
    business_name: "",
    business_description: "",
    business_phone: "",
    business_address: "",
    business_category_id: "",
    phone: "",
    terms: false,
});

const showPassword = ref(false);

const passwordStrength = computed(() => {
    const val = form.password;
    if (!val) return 0;
    let strength = 0;
    if (val.length >= 8) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[0-9]/.test(val)) strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;
    return strength;
});

const strengthColor = computed(() => {
    const s = passwordStrength.value;
    if (s <= 1) return "bg-red-400";
    if (s === 2) return "bg-amber-400";
    if (s === 3) return "bg-primary/60";
    return "bg-primary";
});

const strengthLabel = computed(() => {
    const s = passwordStrength.value;
    if (s === 0) return "";
    if (s === 1) return "Debil";
    if (s === 2) return "Regular";
    if (s === 3) return "Buena";
    return "Fuerte";
});

const handleRegister = () => {
    form.post(route("agendly.register.store"), {
        onFinish: () => form.reset("password"),
    });
};

onMounted(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const tipoUrl = urlParams.get("tipo");

    if (tipoUrl === "negocio" || tipoUrl === "cliente") {
        form.role = tipoUrl;
    } else if (props.tipo) {
        form.role = props.tipo;
    }
});
</script>

<template>
    <div class="min-h-screen flex flex-col bg-background">
        <header class="px-4 py-4">
            <Link
                href="/agendly"
                class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground transition-colors"
            >
                <svg
                    class="w-4 h-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <line x1="19" y1="12" x2="5" y2="12" />
                    <polyline points="12 19 5 12 12 5" />
                </svg>
                Volver
            </Link>
        </header>

        <main class="flex-1 flex items-center justify-center px-4 pb-8">
            <div class="w-full max-w-sm">
                <div class="flex flex-col items-center mb-8">
                    <div
                        class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center mb-3"
                    >
                        <svg
                            class="w-7 h-7 text-primary-foreground"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold text-foreground">
                        Crea tu cuenta
                    </h1>
                    <p class="text-sm text-muted-foreground mt-1">
                        Unete a Agendly en pocos pasos
                    </p>
                </div>

                <div class="flex bg-muted rounded-xl p-1 mb-6">
                    <button
                        type="button"
                        @click="form.role = 'cliente'"
                        :class="[
                            'flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all',
                            form.role === 'cliente'
                                ? 'bg-card text-foreground shadow-sm'
                                : 'text-muted-foreground hover:text-foreground',
                        ]"
                    >
                        Cliente
                    </button>
                    <button
                        type="button"
                        @click="form.role = 'negocio'"
                        :class="[
                            'flex-1 py-2.5 text-sm font-semibold rounded-lg transition-all',
                            form.role === 'negocio'
                                ? 'bg-card text-foreground shadow-sm'
                                : 'text-muted-foreground hover:text-foreground',
                        ]"
                    >
                        Negocio
                    </button>
                </div>

                <form
                    @submit.prevent="handleRegister"
                    class="flex flex-col gap-4"
                >
                    <div v-if="form.errors.role" class="text-red-500 text-xs">
                        {{ form.errors.role }}
                    </div>

                    <div
                        v-if="form.role === 'negocio'"
                        class="flex flex-col gap-4"
                    >
                        <div>
                            <label
                                for="businessName"
                                class="block text-sm font-medium text-foreground mb-1.5"
                                >Nombre del negocio</label
                            >
                            <input
                                id="businessName"
                                v-model="form.business_name"
                                type="text"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none transition-colors"
                                :class="{
                                    'border-red-500': form.errors.business_name,
                                }"
                            />
                            <div
                                v-if="form.errors.business_name"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.business_name }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="business_category_id"
                                class="block text-sm font-medium text-foreground mb-1.5"
                            >
                                Categoría del negocio
                            </label>

                            <select
                                id="business_category_id"
                                v-model="form.business_category_id"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none transition-colors appearance-none"
                                :class="{
                                    'border-red-500':
                                        form.errors.business_category_id,
                                }"
                            >
                                <option value="" disabled selected>
                                    Selecciona una categoría
                                </option>
                                <option
                                    v-for="category in businessCategories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.description }}
                                </option>
                            </select>

                            <div
                                v-if="form.errors.business_category_id"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.business_category_id }}
                            </div>
                        </div>
                        <div>
                            <label
                                for="businessDescription"
                                class="block text-sm font-medium text-foreground mb-1.5"
                                >Descripción del negocio</label
                            >
                            <input
                                id="businessDescription"
                                v-model="form.business_description"
                                type="text"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none transition-colors"
                                :class="{
                                    'border-red-500':
                                        form.errors.business_description,
                                }"
                            />
                            <div
                                v-if="form.errors.business_description"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.business_description }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="businessPhone"
                                class="block text-sm font-medium text-foreground mb-1.5"
                                >Teléfono del negocio</label
                            >
                            <input
                                id="businessPhone"
                                v-model="form.business_phone"
                                type="text"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none transition-colors"
                                :class="{
                                    'border-red-500':
                                        form.errors.business_phone,
                                }"
                            />
                            <div
                                v-if="form.errors.business_phone"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.business_phone }}
                            </div>
                        </div>

                        <div>
                            <label
                                for="businessAddress"
                                class="block text-sm font-medium text-foreground mb-1.5"
                                >Dirección del negocio</label
                            >
                            <input
                                id="businessAddress"
                                v-model="form.business_address"
                                type="text"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none transition-colors"
                                :class="{
                                    'border-red-500':
                                        form.errors.business_address,
                                }"
                            />
                            <div
                                v-if="form.errors.business_address"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.business_address }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-foreground mb-1.5"
                            >Nombre completo</label
                        >
                        <input
                            id="name"
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none"
                        />
                    </div>

                    <div>
                        <label
                            for="registerEmail"
                            class="block text-sm font-medium text-foreground mb-1.5"
                            >Correo electronico</label
                        >
                        <input
                            id="registerEmail"
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none"
                        />
                        <div
                            v-if="form.errors.email"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ form.errors.email }}
                        </div>
                    </div>

                    <div>
                        <label
                            for="registerPassword"
                            class="block text-sm font-medium text-foreground mb-1.5"
                            >Contrasena</label
                        >
                        <div class="relative">
                            <input
                                id="registerPassword"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground text-sm focus:ring-2 focus:ring-primary/30 outline-none pr-12"
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground"
                            >
                                <svg
                                    v-if="!showPassword"
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                                    />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                                <svg
                                    v-else
                                    class="w-5 h-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"
                                    />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 flex gap-1">
                            <div
                                v-for="i in 4"
                                :key="i"
                                class="h-1 flex-1 rounded-full transition-colors"
                                :class="
                                    i <= passwordStrength
                                        ? strengthColor
                                        : 'bg-border'
                                "
                            ></div>
                        </div>
                    </div>

                    <label class="flex items-start gap-2.5 mt-1 cursor-pointer">
                        <input
                            type="checkbox"
                            v-model="form.terms"
                            required
                            class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30 mt-0.5"
                        />
                        <span
                            class="text-xs text-muted-foreground leading-relaxed"
                        >
                            Acepto los
                            <a
                                href="#"
                                class="font-medium text-primary hover:underline"
                                >Terminos de servicio</a
                            >
                        </span>
                    </label>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full py-3.5 bg-primary text-primary-foreground font-semibold rounded-xl text-sm hover:opacity-90 transition-opacity mt-2 disabled:opacity-50"
                    >
                        {{
                            form.processing
                                ? "Registrando..."
                                : form.role === "cliente"
                                  ? "Crear cuenta"
                                  : "Registrar negocio"
                        }}
                    </button>
                </form>

                <!-- <div class="flex items-center gap-3 my-6">
          <div class="flex-1 h-px bg-border"></div>
          <span class="text-xs text-muted-foreground">o registrate con</span>
          <div class="flex-1 h-px bg-border"></div>
        </div>

        <button type="button" class="w-full flex items-center justify-center gap-2 py-3 border border-border rounded-xl text-sm font-medium hover:bg-muted/50 transition-colors">
          Google
        </button> -->

                <p class="text-center text-sm text-muted-foreground mt-6">
                    Ya tienes cuenta?
                    <Link
                        :href="route('agendly.login.index')"
                        class="font-semibold text-primary hover:underline"
                        >Inicia sesion</Link
                    >
                </p>
            </div>
        </main>
    </div>
</template>
