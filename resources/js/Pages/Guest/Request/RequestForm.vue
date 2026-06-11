<script setup lang="ts">
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import RequestTypeSelector from "./RequestTypeSelector.vue";

interface RequestData {
    request_type_id: number | null;
    message: string;
    customer: {
        first_name: string;
        last_name: string;
        email: string;
        phone: string;
    };
}

const emit = defineEmits<{
    submit: [data: RequestData];
}>();

const currentStep = ref(1);
const isSubmitting = ref(false);
const isSuccess = ref(false);

const formData = ref<RequestData>({
    request_type_id: null,
    message: "",
    customer: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
    },
});

const requestTypes = [
    {
        id: 1,
        name: "Desarrollo Web",
        description: "Sitios web, aplicaciones y sistemas a medida",
        icon: "code",
        color: "blue",
    },
    {
        id: 2,
        name: "Reporte de Error",
        description: "Notificar bugs o problemas en proyectos existentes",
        icon: "bug",
        color: "red",
    },
    {
        id: 3,
        name: "Nuevo Proyecto",
        description: "Iniciar un proyecto desde cero",
        icon: "rocket",
        color: "green",
    },
    {
        id: 4,
        name: "Soporte Tecnico",
        description: "Asistencia con sistemas o aplicaciones",
        icon: "support",
        color: "purple",
    },
    {
        id: 5,
        name: "Consultoria",
        description: "Asesoramiento tecnico y estrategico",
        icon: "lightbulb",
        color: "yellow",
    },
    {
        id: 6,
        name: "Integraciones",
        description: "APIs, bases de datos y servicios externos",
        icon: "database",
        color: "cyan",
    },
];

const selectedTypeName = computed(() => {
    const type = requestTypes.find(
        (t) => t.id === formData.value.request_type_id,
    );
    return type?.name || "";
});

const canProceedStep1 = computed(() => formData.value.request_type_id !== null);
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
const canSubmit = computed(
    () =>
        canProceedStep1.value &&
        canProceedStep2.value &&
        formData.value.message.trim() !== "",
);

const isValidEmail = (email: string) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};

const nextStep = () => {
    if (currentStep.value < 3) currentStep.value++;
};

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const goToStep = (step: number) => {
    if (
        step === 1 ||
        (step === 2 && canProceedStep1.value) ||
        (step === 3 && canProceedStep2.value)
    ) {
        currentStep.value = step;
    }
};

const handleSubmit = async () => {
    if (!canSubmit.value) return;

    isSubmitting.value = true;

    router.post(route("guest.request.store"), formData.value, {
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
        request_type_id: null,
        message: "",
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
        class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50/30"
    >
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900"
            ></div>
            <div
                class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg%20width%3D%2240%22%20height%3D%2240%22%20viewBox%3D%220%200%2040%2040%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cg%20fill%3D%22%23ffffff%22%20fill-opacity%3D%220.03%22%3E%3Cpath%20d%3D%22M0%200h20v20H0V0zm20%2020h20v20H20V20z%22%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E')]"
            ></div>

            <!-- Decorative Circles -->
            <div
                class="absolute top-20 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl"
            ></div>
            <div
                class="absolute bottom-10 right-10 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"
            ></div>

            <div class="relative px-4 py-16 sm:py-24 lg:py-28">
                <div class="mx-auto max-w-4xl text-center">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-blue-500/10 border border-blue-400/20 px-4 py-1.5 text-sm font-medium text-blue-300 backdrop-blur-sm mb-6"
                    >
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            />
                        </svg>
                        Respuesta en menos de 24 horas
                    </span>
                    <h1
                        class="text-2xl sm:text-4xl font-bold tracking-tight text-white lg:text-6xl text-balance"
                    >
                        Enviar Solicitud
                    </h1>
                    <p
                        class="mt-6 text-base sm:text-lg leading-8 text-slate-300 max-w-2xl mx-auto text-pretty"
                    >
                        Cuéntanos sobre tu proyecto o requerimiento. Completa el
                        formulario y nos pondremos en contacto contigo a la
                        brevedad.
                    </p>
                </div>
            </div>

            <!-- Diagonal Divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg
                    viewBox="0 0 1440 100"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-full h-auto"
                    preserveAspectRatio="none"
                >
                    <path
                        d="M0 100L1440 100L1440 0L0 100Z"
                        class="fill-slate-50"
                    />
                </svg>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative -mt-16 sm:-mt-24 px-4 pb-24 z-20">
            <div
                class="mx-auto max-w-4xl drop-shadow-[0_0_50px_rgba(8,47,73,0.3)]"
            >
                <!-- Success State -->
                <Transition
                    enter-active-class="transition-all duration-500 ease-out"
                    enter-from-class="opacity-0 scale-95 translate-y-4"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    leave-active-class="transition-all duration-300 ease-in"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div
                        v-if="isSuccess"
                        class="bg-white rounded-3xl shadow-2xl shadow-slate-900/10 p-8 sm:p-12 text-center border border-gray-100"
                    >
                        <div
                            class="mx-auto w-24 h-24 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mb-8 shadow-2xl shadow-green-500/30 animate-bounce"
                        >
                            <svg
                                class="w-12 h-12 text-white"
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
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            Solicitud Enviada
                        </h2>
                        <p class="text-gray-600 mb-10 max-w-md mx-auto text-lg">
                            Hemos recibido tu solicitud exitosamente. Te
                            contactaremos pronto al correo
                            <span class="font-semibold text-blue-600">{{
                                formData.customer.email
                            }}</span>
                        </p>

                        <!-- Summary Card -->
                        <div
                            class="bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-2xl p-6 mb-10 max-w-md mx-auto border border-slate-200/50"
                        >
                            <div class="space-y-4 text-left">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center shrink-0"
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
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-gray-500 uppercase tracking-wider font-medium"
                                        >
                                            Cliente
                                        </p>
                                        <p class="font-semibold text-gray-900">
                                            {{ formData.customer.first_name }}
                                            {{ formData.customer.last_name }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center shrink-0"
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
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                            />
                                        </svg>
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs text-gray-500 uppercase tracking-wider font-medium"
                                        >
                                            Tipo de Solicitud
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
                            class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-slate-900 to-slate-800 text-white font-semibold rounded-xl hover:from-slate-800 hover:to-slate-700 transition-all duration-200 shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:shadow-slate-900/30 hover:-translate-y-0.5"
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
                            Enviar otra solicitud
                        </button>
                    </div>
                </Transition>

                <!-- Form -->
                <div
                    v-if="!isSuccess"
                    class="bg-white rounded-3xl shadow-2xl shadow-slate-900/10 overflow-hidden border border-gray-100"
                >
                    <!-- Progress Steps -->
                    <div
                        class="border-b border-gray-100 px-6 py-6 sm:px-10 bg-gradient-to-r from-slate-50/50 to-white"
                    >
                        <div
                            class="flex items-center justify-between max-w-xl mx-auto"
                        >
                            <template
                                v-for="(step, index) in [
                                    {
                                        num: 1,
                                        label: 'Tipo de Solicitud',
                                        icon: 'document',
                                    },
                                    {
                                        num: 2,
                                        label: 'Tus Datos',
                                        icon: 'user',
                                    },
                                    { num: 3, label: 'Mensaje', icon: 'chat' },
                                ]"
                                :key="step.num"
                            >
                                <!-- Step Button -->
                                <button
                                    @click="goToStep(step.num)"
                                    class="flex flex-col sm:flex-row items-center gap-2 sm:gap-3 group"
                                    :class="{
                                        'cursor-not-allowed opacity-40':
                                            step.num > currentStep &&
                                            !(
                                                step.num === 2 &&
                                                canProceedStep1
                                            ) &&
                                            !(
                                                step.num === 3 &&
                                                canProceedStep2
                                            ),
                                    }"
                                >
                                    <div
                                        class="w-11 h-11 rounded-xl flex items-center justify-center font-bold text-sm transition-all duration-300 shadow-sm"
                                        :class="{
                                            'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-110':
                                                currentStep === step.num,
                                            'bg-gradient-to-br from-green-400 to-green-500 text-white shadow-md shadow-green-500/20':
                                                currentStep > step.num,
                                            'bg-gray-100 text-gray-400 group-hover:bg-gray-200':
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
                                        class="hidden sm:block text-sm font-medium transition-colors duration-200"
                                        :class="
                                            currentStep >= step.num
                                                ? 'text-gray-900'
                                                : 'text-gray-400'
                                        "
                                    >
                                        {{ step.label }}
                                    </span>
                                </button>

                                <!-- Connector Line -->
                                <div
                                    v-if="index < 2"
                                    class="hidden sm:block flex-1 h-0.5 mx-4 rounded-full transition-all duration-500"
                                    :class="
                                        currentStep > step.num
                                            ? 'bg-gradient-to-r from-green-400 to-green-500'
                                            : 'bg-gray-200'
                                    "
                                ></div>
                            </template>
                        </div>
                    </div>

                    <!-- Step Content -->
                    <div class="p-6 sm:p-10">
                        <!-- Step 1: Request Type -->
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
                                        Qué tipo de solicitud deseas realizar?
                                    </h2>
                                    <p class="text-gray-600">
                                        Selecciona la categoría que mejor
                                        describa tu requerimiento
                                    </p>
                                </div>

                                <RequestTypeSelector
                                    v-model="formData.request_type_id"
                                    :types="requestTypes"
                                />

                                <div class="mt-10 flex justify-end">
                                    <button
                                        @click="nextStep"
                                        :disabled="!canProceedStep1"
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

                            <!-- Step 3: Message -->
                            <div v-else-if="currentStep === 3" key="step3">
                                <div class="mb-8">
                                    <h2
                                        class="text-2xl font-bold text-gray-900 mb-2"
                                    >
                                        Describe tu solicitud
                                    </h2>
                                    <p class="text-gray-600">
                                        Cuentanos los detalles de tu proyecto o
                                        requerimiento
                                    </p>
                                </div>

                                <div class="grid lg:grid-cols-5 gap-8">
                                    <!-- Summary Card -->
                                    <div
                                        class="lg:col-span-2 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-6 text-white h-fit"
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
                                            Resumen
                                        </h3>

                                        <div class="space-y-5">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0"
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
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-xs text-slate-400 mb-0.5"
                                                    >
                                                        Tipo
                                                    </p>
                                                    <p class="font-medium">
                                                        {{ selectedTypeName }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0"
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
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-xs text-slate-400 mb-0.5"
                                                    >
                                                        Cliente
                                                    </p>
                                                    <p class="font-medium">
                                                        {{
                                                            formData.customer
                                                                .first_name
                                                        }}
                                                        {{
                                                            formData.customer
                                                                .last_name
                                                        }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0"
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
                                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-xs text-slate-400 mb-0.5"
                                                    >
                                                        Correo
                                                    </p>
                                                    <p
                                                        class="font-medium text-sm break-all"
                                                    >
                                                        {{
                                                            formData.customer
                                                                .email
                                                        }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center shrink-0"
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
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p
                                                        class="text-xs text-slate-400 mb-0.5"
                                                    >
                                                        Telefono
                                                    </p>
                                                    <p class="font-medium">
                                                        {{
                                                            formData.customer
                                                                .phone
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Message Input -->
                                    <div class="lg:col-span-3">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-2"
                                        >
                                            Tu mensaje
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <textarea
                                            v-model="formData.message"
                                            rows="8"
                                            placeholder="Describe detalladamente tu proyecto, los objetivos que deseas alcanzar, tecnologias preferidas, plazos estimados, o cualquier otra Información relevante..."
                                            class="w-full px-5 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 placeholder:text-gray-400 text-gray-900 resize-none"
                                        ></textarea>
                                        <p
                                            class="mt-2 text-sm text-gray-500 flex items-center gap-1.5"
                                        >
                                            <svg
                                                class="w-4 h-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                            Mientras mas detalles proporciones,
                                            mejor podremos ayudarte
                                        </p>
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
                                        @click="handleSubmit"
                                        :disabled="!canSubmit || isSubmitting"
                                        class="group inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-lg shadow-green-600/30 hover:shadow-xl hover:shadow-green-600/40 hover:-translate-y-0.5 disabled:hover:translate-y-0"
                                    >
                                        <svg
                                            v-if="isSubmitting"
                                            class="w-5 h-5 animate-spin"
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
                                        <svg
                                            v-else
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                                            />
                                        </svg>
                                        {{
                                            isSubmitting
                                                ? "Enviando..."
                                                : "Enviar Solicitud"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </Transition>
                    </div>
                </div>

                <!-- Trust Indicators -->
                <div
                    class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-500"
                >
                    <span class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-green-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                            />
                        </svg>
                        Datos protegidos
                    </span>
                    <span class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-blue-500"
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
                        Respuesta en 24h
                    </span>
                    <span class="flex items-center gap-2">
                        <svg
                            class="w-5 h-5 text-yellow-500"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"
                            />
                        </svg>
                        Sin compromiso
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
