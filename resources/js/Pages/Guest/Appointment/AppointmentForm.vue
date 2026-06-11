<script setup lang="ts">
import { router } from "@inertiajs/vue3";
import TimePicker from "./TimePicker.vue";
import { ref, computed, watch } from "vue";
import CalendarPicker from "./CalendarPicker.vue";
import { appointmentTypes } from "@/Features/siteTexts.ts";
import AppointmentTypeSelector from "./AppointmentTypeSelector.vue";

interface AppointmentData {
    customer_id: number | null;
    appointment_type_id: number | null;
    message: string;
    date: string;
    hour: string;
    customer: {
        first_name: string;
        last_name: string;
        email: string;
        phone: string;
    };
}

const props = defineProps<{
    customerId?: number;
}>();

const emit = defineEmits<{
    submit: [data: AppointmentData];
}>();

const currentStep = ref(1);
const isSubmitting = ref(false);
const isSuccess = ref(false);

const formData = ref<AppointmentData>({
    customer_id: props.customerId || null,
    appointment_type_id: null,
    message: "",
    date: "",
    hour: "",
    customer: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
    },
});

const isValidEmail = (email: string) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};

const selectedTypeName = computed(() => {
    const type = appointmentTypes.find(
        (t) => t.id === formData.value.appointment_type_id,
    );
    return type?.name || "";
});

const canProceedStep1 = computed(
    () => formData.value.appointment_type_id !== null,
);
const canProceedStep2 = computed(() => {
    const { first_name, last_name, email, phone } = formData.value.customer;
    return (
        first_name.trim() !== "" &&
        last_name.trim() !== "" &&
        email.trim() !== "" &&
        phone.trim() !== "" &&
        isValidEmail(email)
    );
});

const canProceedStep3 = computed(
    () => formData.value.date !== "" && formData.value.hour !== "",
);
const canSubmit = computed(
    () =>
        canProceedStep1.value && canProceedStep2.value && canProceedStep3.value,
);

const formatDate = (dateStr: string) => {
    if (!dateStr) return "";
    const date = new Date(dateStr + "T00:00:00");
    return date.toLocaleDateString("es-ES", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
};

const nextStep = () => {
    if (currentStep.value < 4) currentStep.value++;
};

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const goToStep = (step: number) => {
    if (
        step === 1 ||
        (step === 2 && canProceedStep1.value) ||
        (step === 3 && canProceedStep2.value) ||
        (step === 4 && canProceedStep3.value)
    ) {
        currentStep.value = step;
    }
};

const handleSubmit = async () => {
    if (!canSubmit.value) return;

    isSubmitting.value = true;

    router.post(route("guest.appointment.store"), formData.value, {
        preserveScroll: true,
        onBefore: () => {
            isSubmitting.value = true;
        },
        onFinish: () => {
            isSubmitting.value = false;
        },
        onSuccess: (data) => {
            console.log(data);
            isSuccess.value = true;
            emit("submit", formData.value);
        },
        onError: (errors) => {
            console.error("Errores de validación:", errors);
            // Notification
        },
    });
};
const resetForm = () => {
    formData.value = {
        customer_id: props.customerId || null,
        appointment_type_id: null,
        message: "",
        date: "",
        hour: "",
        customer: {
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
        },
    };
    currentStep.value = 1;
    isSuccess.value = false;
};
</script>

<template>
    <div
        id="appointment_section"
        class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30"
    >
        <div
            class="relative overflow-hidden bg-slate-950 border-t border-slate-900/60 pt-16 pb-12 sm:pt-24 sm:pb-16 lg:pt-32 lg:pb-20"
        >
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-40"
            ></div>

            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-px bg-gradient-to-r from-transparent via-blue-500/30 to-transparent"
            ></div>

            <div
                class="absolute top-6 left-6 hidden md:flex items-center gap-2 font-mono text-[9px] text-slate-600 font-bold tracking-widest uppercase select-none"
            >
                <span>LOC_0x7c // CALENDAR_INIT</span>
            </div>
            <div
                class="absolute top-6 right-6 hidden md:flex items-center gap-2 font-mono text-[9px] text-slate-600 font-bold tracking-widest uppercase select-none"
            >
                <span>SYS_ALIGN // SEC_03</span>
            </div>

            <div class="relative px-4 mx-auto max-w-4xl text-center z-10">
                <div class="inline-flex items-center justify-center mb-6">
                    <div
                        class="flex items-center gap-2 px-3 py-1.5 rounded-md bg-slate-900/80 border border-slate-800 font-mono text-[11px] font-bold tracking-wider text-slate-300 backdrop-blur-sm shadow-inner"
                    >
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"
                            ></span>
                            <span
                                class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"
                            ></span>
                        </span>
                        <span class="text-slate-400">STATUS:</span>
                        <span
                            class="text-emerald-400 font-extrabold uppercase animate-pulse"
                            >Link_Active</span
                        >
                    </div>
                </div>

                <h2
                    class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl text-balance"
                >
                    Agenda tu
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500"
                        >Consulta</span
                    >
                </h2>

                <p
                    class="mt-4 text-sm sm:text-base leading-relaxed text-slate-400 max-w-2xl mx-auto text-pretty"
                >
                    Conversemos sobre tu próximo proyecto. Selecciona el tipo de
                    reunión, fecha y hora que mejor se adapte a tu ecosistema
                    operativo.
                </p>

                <div
                    class="mt-8 flex flex-col items-center justify-center gap-1 opacity-60"
                >
                    <div
                        class="w-[1px] h-8 bg-gradient-to-b from-blue-500/60 to-transparent"
                    ></div>
                    <span
                        class="font-mono text-[9px] text-blue-400/80 font-bold tracking-widest uppercase animate-bounce"
                    >
                        Select_Slot ↓
                    </span>
                </div>
            </div>

            <div
                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-72 h-36 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"
            ></div>
        </div>

        <!-- Main Content -->
        <div class="relative -mt-8 px-4 pb-24">
            <div class="mx-auto max-w-5xl">
                <!-- Success State -->
                <Transition
                    enter-active-class="transition-all duration-500 ease-out"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition-all duration-300 ease-in"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div
                        v-if="isSuccess"
                        class="bg-white rounded-3xl shadow-2xl shadow-blue-900/10 p-8 sm:p-12 text-center"
                    >
                        <div
                            class="mx-auto w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mb-6 shadow-lg shadow-green-500/30"
                        >
                            <svg
                                class="w-10 h-10 text-white"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2.5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">
                            Cita Agendada
                        </h2>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            Tu solicitud ha sido enviada exitosamente. Recibirás
                            un correo de confirmación con los detalles.
                        </p>

                        <div
                            class="bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-2xl p-6 mb-8 max-w-sm mx-auto"
                        >
                            <div class="space-y-4 text-left">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-5 h-5 text-blue-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-gray-500 uppercase tracking-wider"
                                        >
                                            Fecha
                                        </p>
                                        <p
                                            class="font-semibold text-gray-900 capitalize"
                                        >
                                            {{ formatDate(formData.date) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-5 h-5 text-blue-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-gray-500 uppercase tracking-wider"
                                        >
                                            Hora
                                        </p>
                                        <p class="font-semibold text-gray-900">
                                            {{ formData.hour }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center"
                                    >
                                        <svg
                                            class="w-5 h-5 text-blue-600"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-gray-500 uppercase tracking-wider"
                                        >
                                            Tipo
                                        </p>
                                        <p class="font-semibold text-gray-900">
                                            {{ selectedTypeName }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button
                            @click="resetForm"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transition-all duration-200 shadow-lg shadow-gray-900/20"
                        >
                            <svg
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                />
                            </svg>
                            Agendar otra cita
                        </button>
                    </div>
                </Transition>

                <!-- Form -->
                <div
                    v-if="!isSuccess"
                    class="relative bg-slate-900/40 backdrop-blur-md rounded-2xl border border-slate-800 shadow-2xl shadow-slate-950/50 overflow-hidden group/form"
                >
                    <div
                        class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-blue-500/20 to-transparent group-focus-within/form:via-cyan-400/50 transition-all duration-500"
                    ></div>

                    <div
                        class="absolute top-3 right-4 flex gap-1.5 pointer-events-none select-none opacity-40 group-hover/form:opacity-70 transition-opacity duration-300"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-slate-700"
                        ></span>
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-slate-700"
                        ></span>
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-slate-700"
                        ></span>
                    </div>
                    <!-- Progress Steps -->
                    <div class="border-b border-gray-100 px-6 py-6 sm:px-10">
                        <div
                            class="flex items-center justify-between max-w-2xl mx-auto"
                        >
                            <button
                                v-for="(step, index) in [
                                    { num: 1, label: 'Tipo de Cita' },
                                    { num: 2, label: 'Tus Datos' },
                                    { num: 3, label: 'Fecha y Hora' },
                                    { num: 4, label: 'Confirmar' },
                                ]"
                                :key="step.num"
                                @click="goToStep(step.num)"
                                class="flex items-center gap-3 group"
                                :class="{
                                    'cursor-not-allowed opacity-50':
                                        step.num > currentStep &&
                                        !canProceedStep1,
                                }"
                            >
                                <div
                                    class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-300"
                                    :class="{
                                        'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30':
                                            currentStep === step.num,
                                        'bg-green-500 text-white':
                                            currentStep > step.num,
                                        'bg-gray-100 text-gray-400':
                                            currentStep < step.num,
                                    }"
                                >
                                    <svg
                                        v-if="currentStep > step.num"
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                    <span v-else>{{ step.num }}</span>
                                </div>
                                <span
                                    class="hidden sm:block font-medium transition-colors duration-200"
                                    :class="
                                        currentStep >= step.num
                                            ? 'text-gray-900'
                                            : 'text-gray-400'
                                    "
                                >
                                    {{ step.label }}
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Step Content -->
                    <div class="p-6 sm:p-10">
                        <!-- Step 1: Appointment Type -->
                        <Transition
                            enter-active-class="transition-all duration-300 ease-out"
                            enter-from-class="opacity-0 translate-x-4"
                            enter-to-class="opacity-100 translate-x-0"
                            leave-active-class="transition-all duration-200 ease-in absolute inset-0"
                            leave-from-class="opacity-100"
                            leave-to-class="opacity-0"
                            mode="out-in"
                        >
                            <div v-if="currentStep === 1" key="step1">
                                <div class="mb-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-900 mb-2"
                                    >
                                        Selecciona el tipo de cita
                                    </h2>
                                    <p class="text-gray-600">
                                        Elige la modalidad que prefieras para
                                        nuestra reunión
                                    </p>
                                </div>

                                <AppointmentTypeSelector
                                    v-model="formData.appointment_type_id"
                                    :types="appointmentTypes"
                                />

                                <div class="mt-10 flex justify-end">
                                    <button
                                        @click="nextStep"
                                        :disabled="!canProceedStep1"
                                        class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-600/40"
                                    >
                                        Continuar
                                        <svg
                                            class="w-5 h-5 transition-transform group-hover:translate-x-1"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 2: Customer Info -->
                            <div v-else-if="currentStep === 2" key="step2">
                                <div class="mb-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-900 mb-2"
                                    >
                                        Información de contacto
                                    </h2>
                                    <p class="text-gray-600">
                                        Necesitamos tus datos para poder
                                        comunicarnos contigo
                                    </p>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-5">
                                    <!-- First Name -->
                                    <div class="group">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Nombre
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    />
                                                </svg>
                                            </div>
                                            <input
                                                v-model="
                                                    formData.customer.first_name
                                                "
                                                type="text"
                                                placeholder="Tu nombre"
                                                class="w-full pl-12 pr-4 py-1 sm:py-3.5 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-gray-400 text-gray-900"
                                            />
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="group">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Apellidos
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                    />
                                                </svg>
                                            </div>
                                            <input
                                                v-model="
                                                    formData.customer.last_name
                                                "
                                                type="text"
                                                placeholder="Tus apellidos"
                                                class="w-full pl-12 pr-4 py-1 sm:py-3.5 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-gray-400 text-gray-900"
                                            />
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="group">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Correo electronico
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                    />
                                                </svg>
                                            </div>
                                            <input
                                                v-model="
                                                    formData.customer.email
                                                "
                                                type="email"
                                                placeholder="correo@ejemplo.com"
                                                class="w-full pl-12 pr-4 py-1 sm:py-3.5 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-gray-400 text-gray-900"
                                                :class="{
                                                    'border-red-300 focus:border-red-500 focus:ring-red-500/10':
                                                        formData.customer
                                                            .email &&
                                                        !isValidEmail(
                                                            formData.customer
                                                                .email,
                                                        ),
                                                }"
                                            />
                                        </div>
                                        <p
                                            v-if="
                                                formData.customer.email &&
                                                !isValidEmail(
                                                    formData.customer.email,
                                                )
                                            "
                                            class="mt-2 text-sm text-red-500"
                                        >
                                            Por favor ingresa un correo valido
                                        </p>
                                    </div>

                                    <!-- Phone -->
                                    <div class="group">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Telefono
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                                            >
                                                <svg
                                                    class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                    />
                                                </svg>
                                            </div>
                                            <input
                                                v-model="
                                                    formData.customer.phone
                                                "
                                                type="tel"
                                                placeholder="+52 123 456 7890"
                                                class="w-full pl-12 pr-4 py-1 sm:py-3.5 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-gray-400 text-gray-900"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="mt-10 flex items-center justify-between"
                                >
                                    <button
                                        @click="prevStep"
                                        class="inline-flex items-center gap-2 px-6 py-3 text-gray-600 font-medium hover:text-gray-900 transition-colors group"
                                    >
                                        <svg
                                            class="w-5 h-5 transition-transform group-hover:-translate-x-1"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 16l-4-4m0 0l4-4m-4 4h18"
                                            />
                                        </svg>
                                        Atras
                                    </button>
                                    <button
                                        @click="nextStep"
                                        :disabled="!canProceedStep2"
                                        class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-600/40 hover:-translate-y-0.5 disabled:hover:translate-y-0"
                                    >
                                        Continuar
                                        <svg
                                            class="w-5 h-5 transition-transform group-hover:translate-x-1"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Step 3: Date & Time -->
                            <div v-else-if="currentStep === 3" key="step3">
                                <div class="mb-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-900 mb-2"
                                    >
                                        Elige fecha y hora
                                    </h2>
                                    <p class="text-gray-600">
                                        Selecciona el momento que mejor se
                                        adapte a tu agenda
                                    </p>
                                </div>

                                <div class="grid lg:grid-cols-2 gap-8">
                                    <CalendarPicker v-model="formData.date" />
                                    <TimePicker
                                        v-model="formData.hour"
                                        :selected-date="formData.date"
                                    />
                                </div>

                                <div
                                    class="mt-10 flex items-center justify-between"
                                >
                                    <button
                                        @click="prevStep"
                                        class="inline-flex items-center gap-2 px-6 py-3 text-gray-600 font-medium hover:text-gray-900 transition-colors"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 16l-4-4m0 0l4-4m-4 4h18"
                                            />
                                        </svg>
                                        Atrás
                                    </button>
                                    <button
                                        @click="nextStep"
                                        :disabled="!canProceedStep3"
                                        class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-600/40"
                                    >
                                        Continuar
                                        <svg
                                            class="w-5 h-5 transition-transform group-hover:translate-x-1"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 4: Confirm -->
                            <div v-else-if="currentStep === 4" key="step4">
                                <div class="mb-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-900 mb-2"
                                    >
                                        Confirma tu cita
                                    </h2>
                                    <p class="text-gray-600">
                                        Revisa los detalles y añade un mensaje
                                        opcional
                                    </p>
                                </div>

                                <div class="grid lg:grid-cols-2 gap-8">
                                    <!-- Summary Card -->
                                    <div
                                        class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl p-6 text-white"
                                    >
                                        <h3
                                            class="text-lg font-semibold mb-6 flex items-center gap-2"
                                        >
                                            <svg
                                                class="w-5 h-5 text-blue-400"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                                />
                                            </svg>
                                            Resumen de tu cita
                                        </h3>

                                        <div class="space-y-5">
                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shrink-0"
                                                >
                                                    <svg
                                                        class="w-6 h-6 text-blue-400"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-sm text-slate-400 mb-1"
                                                    >
                                                        Tipo de cita
                                                    </p>
                                                    <p
                                                        class="font-semibold text-lg"
                                                    >
                                                        {{ selectedTypeName }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shrink-0"
                                                >
                                                    <svg
                                                        class="w-6 h-6 text-blue-400"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-sm text-slate-400 mb-1"
                                                    >
                                                        Fecha
                                                    </p>
                                                    <p
                                                        class="font-semibold text-lg capitalize"
                                                    >
                                                        {{
                                                            formatDate(
                                                                formData.date,
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-4">
                                                <div
                                                    class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shrink-0"
                                                >
                                                    <svg
                                                        class="w-6 h-6 text-blue-400"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-sm text-slate-400 mb-1"
                                                    >
                                                        Hora
                                                    </p>
                                                    <p
                                                        class="font-semibold text-lg"
                                                    >
                                                        {{ formData.hour }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message Input -->
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Mensaje (opcional)
                                        </label>
                                        <textarea
                                            v-model="formData.message"
                                            rows="6"
                                            placeholder="Cuéntanos brevemente sobre tu proyecto o lo que te gustaría discutir en la reunión..."
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none text-gray-900 placeholder:text-gray-400"
                                        ></textarea>
                                        <p class="mt-2 text-sm text-gray-500">
                                            Esto nos ayudará a prepararnos mejor
                                            para nuestra conversación.
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="mt-10 flex items-center justify-between"
                                >
                                    <button
                                        @click="prevStep"
                                        class="inline-flex items-center gap-2 px-6 py-3 text-gray-600 font-medium hover:text-gray-900 transition-colors"
                                    >
                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 16l-4-4m0 0l4-4m-4 4h18"
                                            />
                                        </svg>
                                        Atrás
                                    </button>
                                    <button
                                        @click="handleSubmit"
                                        :disabled="!canSubmit || isSubmitting"
                                        class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40"
                                    >
                                        <svg
                                            v-if="isSubmitting"
                                            class="animate-spin -ml-1 mr-2 h-5 w-5 text-white"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                        >
                                            <circle
                                                class="opacity-25"
                                                cx="12"
                                                cy="12"
                                                r="10"
                                                stroke="currentColor"
                                                stroke-width="4"
                                            ></circle>
                                            <path
                                                class="opacity-75"
                                                fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            ></path>
                                        </svg>
                                        {{
                                            isSubmitting
                                                ? "Agendando..."
                                                : "Confirmar Cita"
                                        }}
                                        <svg
                                            v-if="!isSubmitting"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </Transition>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div
                    class="mt-12 flex flex-wrap items-center justify-center gap-8 text-gray-500"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-green-500"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="text-sm">Confirmación inmediata</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-green-500"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="text-sm">Sin compromiso</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-green-500"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="text-sm">Reprogramación flexible</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
