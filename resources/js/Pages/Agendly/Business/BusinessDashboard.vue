<template>
    <AgendlyBusinessLayout>
        <div class="px-4 py-5">
            <div class="mb-6">
                <p class="text-sm text-muted-foreground">Panel de negocio</p>
                <h1 class="text-2xl font-extrabold text-foreground">
                    Tus citas
                </h1>
            </div>

            <div class="grid grid-cols-3 gap-3 mb-6">
                <div
                    class="bg-card rounded-xl border border-border p-3 text-center"
                >
                    <p class="text-2xl font-bold text-primary">
                        {{ pendingCount }}
                    </p>
                    <p
                        class="text-[10px] text-muted-foreground font-medium mt-0.5"
                    >
                        Pendientes
                    </p>
                </div>
                <div
                    class="bg-card rounded-xl border border-border p-3 text-center"
                >
                    <p class="text-2xl font-bold text-foreground">
                        {{ confirmedCount }}
                    </p>
                    <p
                        class="text-[10px] text-muted-foreground font-medium mt-0.5"
                    >
                        Confirmadas
                    </p>
                </div>
                <div
                    class="bg-card rounded-xl border border-border p-3 text-center"
                >
                    <p class="text-2xl font-bold text-muted-foreground">
                        {{ completedCount }}
                    </p>
                    <p
                        class="text-[10px] text-muted-foreground font-medium mt-0.5"
                    >
                        Completadas
                    </p>
                </div>
            </div>

            <!-- Filter tabs -->
            <div class="flex gap-2 mb-4 overflow-x-auto pb-1 -mx-4 px-4">
                <button
                    v-for="tab in tabs"
                    :key="tab.value"
                    @click="activeTab = tab.value"
                    :class="[
                        'px-4 py-2 text-xs font-semibold rounded-full whitespace-nowrap transition-all flex-shrink-0',
                        activeTab === tab.value
                            ? 'bg-primary text-primary-foreground'
                            : 'bg-muted text-muted-foreground',
                    ]"
                >
                    {{ tab.label }}
                </button>
            </div>

            <!-- Appointments list -->
            <div class="flex flex-col gap-3">
                <div
                    v-for="apt in businessAppointments"
                    :key="apt.id"
                    class="bg-card rounded-xl border border-border p-4"
                >
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0"
                                :class="getInitialsBg(apt.state_name)"
                            >
                                {{ getInitials(apt.customer_info.name) }}
                            </div>
                            <div>
                                <p
                                    class="text-sm font-semibold text-foreground"
                                >
                                    {{ apt.customer_info.name }}
                                </p>
                                <p class="text-xs text-muted-foreground">
                                    {{ apt.reason }}
                                </p>
                            </div>
                        </div>
                        <span
                            class="px-2.5 py-1 text-[10px] font-semibold rounded-full flex-shrink-0"
                            :class="statusBadge(apt.state_name)"
                        >
                            {{ statusLabel(apt.state_name) }}
                        </span>
                    </div>

                    <div
                        class="flex items-center gap-4 text-xs text-muted-foreground mb-3"
                    >
                        <span class="flex items-center gap-1">
                            <svg
                                class="w-3.5 h-3.5"
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
                            {{ formatDate(apt.date) }}
                        </span>
                        <span class="flex items-center gap-1">
                            <svg
                                class="w-3.5 h-3.5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                            {{ apt.hour }}
                        </span>
                    </div>

                    <!-- Actions for pending -->
                    <div
                        v-if="apt.state_name === 'Pendiente'"
                        class="flex gap-2"
                    >
                        <button
                            @click="updateAppointmentStatusId(apt.id, 2)"
                            class="flex-1 py-2 text-xs font-semibold bg-primary text-primary-foreground rounded-lg hover:opacity-90 transition-opacity"
                        >
                            Confirmar
                        </button>
                        <button
                            @click="updateAppointmentStatusId(apt.id, 3)"
                            class="flex-1 py-2 text-xs font-semibold border border-border text-foreground rounded-lg hover:bg-muted transition-colors"
                        >
                            Rechazar
                        </button>
                    </div>
                    <!-- Action for confirmed -->
                    <div
                        v-else-if="apt.state_name === 'Confirmada'"
                        class="flex gap-2"
                    >
                        <button
                            @click="completeAppointment(apt.id)"
                            class="flex-1 py-2 text-xs font-semibold bg-primary/10 text-primary rounded-lg hover:bg-primary/20 transition-colors"
                        >
                            Marcar completada
                        </button>
                        <button
                            @click="cancelAppointment(apt.id)"
                            class="py-2 px-4 text-xs font-semibold border border-border text-muted-foreground rounded-lg hover:bg-muted transition-colors"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>

                <!-- Empty state -->
                <div
                    v-if="businessAppointments.length === 0"
                    class="flex flex-col items-center justify-center py-16 text-center"
                >
                    <div
                        class="w-16 h-16 rounded-full bg-muted flex items-center justify-center mb-4"
                    >
                        <svg
                            class="w-8 h-8 text-muted-foreground"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.5"
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
                    <p class="text-sm font-semibold text-foreground">
                        Sin citas
                    </p>
                    <p class="text-xs text-muted-foreground mt-1">
                        No hay citas
                        {{ activeTab === "todas" ? "" : activeTab + "s" }} por
                        ahora
                    </p>
                </div>
            </div>
        </div>
    </AgendlyBusinessLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import { toast } from "vue3-toastify";
import { router } from "@inertiajs/vue3";
import { useStore } from "@/stores/mockData.js";
import AgendlyBusinessLayout from "@/Layouts/AgendlyBusinessLayout.vue";

const props = defineProps({
    businessAppointments: Array,
});

console.log(props.businessAppointments);

const { state, getAppointmentsForBusiness, updateAppointmentStatus } =
    useStore();

const activeTab = ref("todas");

const tabs = [
    { label: "Todas", value: "todas" },
    { label: "Pendientes", value: "Pendiente" },
    { label: "Confirmadas", value: "Confirmada" },
    { label: "Completadas", value: "completada" },
    { label: "Canceladas", value: "cancelada" },
];

const businessId = computed(() => state.currentUser?.businessId || 1);

const allAppointments = computed(() => {
    return getAppointmentsForBusiness(businessId.value).sort((a, b) => {
        const dateA = new Date(a.date + "T" + a.time);
        const dateB = new Date(b.date + "T" + b.time);
        return dateA - dateB;
    });
});

const filteredAppointments = computed(() => {
    if (activeTab.value === "todas") return allAppointments.value;
    return allAppointments.value.filter((a) => a.status === activeTab.value);
});

const pendingCount = computed(
    () =>
        props.businessAppointments.filter((a) => a.status_name === "Pendiente")
            .length,
);
const confirmedCount = computed(
    () =>
        props.businessAppointments.filter((a) => a.status_name === "Confirmada")
            .length,
);
const completedCount = computed(
    () =>
        props.businessAppointments.filter((a) => a.status_name === "completada")
            .length,
);

const confirmAppointment = (id) => updateAppointmentStatus(id, "Confirmada");
const cancelAppointment = (id) => updateAppointmentStatus(id, "cancelada");
const completeAppointment = (id) => updateAppointmentStatus(id, "completada");

const updateAppointmentStatusId = (appointmentId, stateId) => {
    const action = stateId == 2 ? "Confirmar" : "Cancelar";

    router.post(
        route("agendly.client.appointment.state.update"),
        {
            appointmentId: appointmentId,
            stateId: stateId,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                toast.success(action);
            },
            onError: (errors) => {
                console.error("Error al actualizar:", errors);
            },
        },
    );
};

const formatDate = (dateStr) => {
    const date = new Date(dateStr + "T12:00:00");
    return date.toLocaleDateString("es-CO", {
        weekday: "short",
        day: "numeric",
        month: "short",
    });
};

const getInitials = (name) => {
    return name
        .split(" ")
        .map((w) => w[0])
        .join("")
        .substring(0, 2)
        .toUpperCase();
};

const getInitialsBg = (status) => {
    if (status === "Pendiente") return "bg-amber-100 text-amber-700";
    if (status === "Confirmada") return "bg-primary/10 text-primary";
    if (status === "completada") return "bg-muted text-muted-foreground";
    return "bg-red-50 text-red-500";
};

const statusBadge = (status) => {
    if (status === "Pendiente") return "bg-amber-100 text-amber-700";
    if (status === "Confirmada") return "bg-primary/10 text-primary";
    if (status === "completada") return "bg-muted text-muted-foreground";
    return "bg-red-50 text-red-500";
};

const statusLabel = (status) => {
    if (status === "Pendiente") return "Pendiente";
    if (status === "Confirmada") return "Confirmada";
    if (status === "completada") return "Completada";
    return "Cancelada";
};
</script>
