<template>
    <AgendlyBusinessLayout>
        <div class="px-4 py-5">
            <div class="mb-6">
                <p class="text-sm text-muted-foreground">Configuracion</p>
                <h1 class="text-2xl font-extrabold text-foreground">
                    Disponibilidad
                </h1>
            </div>

            <!-- Slot duration selector -->
            <div class="bg-card rounded-xl border border-border p-4 mb-5">
                <h2 class="text-sm font-semibold text-foreground mb-1">
                    Duracion de cada cita
                </h2>
                <p class="text-xs text-muted-foreground mb-3">
                    Elige cuanto dura cada turno de atencion
                </p>
                <div class="flex gap-2">
                    <button
                        v-for="opt in durationOptions"
                        :key="opt.value"
                        @click="slotDuration = opt.value"
                        :class="[
                            'flex-1 py-2.5 text-xs font-semibold rounded-xl transition-all text-center',
                            slotDuration === opt.value
                                ? 'bg-primary text-primary-foreground shadow-md shadow-primary/20'
                                : 'bg-muted text-muted-foreground hover:text-foreground',
                        ]"
                    >
                        {{ opt.label }}
                    </button>
                </div>
            </div>

            <!-- Days schedule -->
            <div class="flex flex-col gap-3 mb-6">
                <div
                    v-for="(config, day) in localAvailability"
                    :key="day"
                    class="bg-card rounded-xl border border-border overflow-hidden"
                >
                    <!-- Day header -->
                    <div class="flex items-center justify-between px-4 py-3">
                        <div class="flex items-center gap-3">
                            <button
                                @click="toggleDay(day)"
                                class="relative w-11 h-6 rounded-full transition-colors"
                                :class="
                                    config.active ? 'bg-primary' : 'bg-muted'
                                "
                                :aria-label="
                                    config.active
                                        ? 'Desactivar ' + dayLabel(day)
                                        : 'Activar ' + dayLabel(day)
                                "
                                role="switch"
                                :aria-checked="config.active"
                            >
                                <span
                                    class="absolute top-0.5 w-5 h-5 bg-card rounded-full shadow-sm transition-transform"
                                    :class="
                                        config.active
                                            ? 'left-[22px]'
                                            : 'left-0.5'
                                    "
                                ></span>
                            </button>
                            <span
                                class="text-sm font-semibold text-foreground capitalize"
                                >{{ dayLabel(day) }}</span
                            >
                        </div>
                        <span
                            v-if="config.active"
                            class="text-xs text-muted-foreground"
                        >
                            {{ config.start }} - {{ config.end }}
                        </span>
                        <span v-else class="text-xs text-muted-foreground"
                            >Cerrado</span
                        >
                    </div>

                    <!-- Time inputs (shown when active) -->
                    <div v-if="config.active" class="px-4 pb-4 flex gap-3">
                        <div class="flex-1">
                            <label
                                class="block text-[10px] font-medium text-muted-foreground mb-1 uppercase tracking-wider"
                                >Apertura</label
                            >
                            <input
                                type="time"
                                v-model="config.start"
                                class="w-full px-3 py-2.5 rounded-lg border border-border bg-background text-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                            />
                        </div>
                        <div class="flex-1">
                            <label
                                class="block text-[10px] font-medium text-muted-foreground mb-1 uppercase tracking-wider"
                                >Cierre</label
                            >
                            <input
                                type="time"
                                v-model="config.end"
                                class="w-full px-3 py-2.5 rounded-lg border border-border bg-background text-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            <div class="bg-card rounded-xl border border-border p-4 mb-5">
                <h2 class="text-sm font-semibold text-foreground mb-3">
                    Vista previa de horarios
                </h2>
                <div class="flex flex-col gap-2">
                    <div
                        v-for="(config, day) in localAvailability"
                        :key="'preview-' + day"
                        class="flex items-center justify-between text-xs"
                    >
                        <span
                            class="font-medium capitalize"
                            :class="
                                config.active
                                    ? 'text-foreground'
                                    : 'text-muted-foreground line-through'
                            "
                        >
                            {{ dayLabel(day) }}
                        </span>
                        <span
                            v-if="config.active"
                            class="text-muted-foreground"
                        >
                            {{ config.start }} - {{ config.end }} ({{
                                slotsCount(config)
                            }}
                            turnos de {{ slotDuration }}min)
                        </span>
                        <span v-else class="text-muted-foreground"
                            >Cerrado</span
                        >
                    </div>
                </div>
            </div>

            <!-- Save button -->
            <button
                @click="saveChanges"
                class="w-full py-3.5 bg-primary text-primary-foreground font-semibold rounded-xl text-sm hover:opacity-90 transition-opacity"
                :class="{ 'opacity-50 pointer-events-none': !hasChanges }"
            >
                {{ saved ? "Guardado" : "Guardar cambios" }}
            </button>
            <p
                v-if="saved"
                class="text-xs text-primary text-center mt-2 font-medium"
            >
                Cambios guardados correctamente
            </p>
        </div>
    </AgendlyBusinessLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, reactive, computed, onMounted } from "vue";
import AgendlyBusinessLayout from "@/Layouts/AgendlyBusinessLayout.vue";

// 1. DEFINICIÓN DE PROPS (Datos desde el Controlador)
const props = defineProps({
    businessSettings: Object,
    businessId: [Number, String], // Por si lo pasas desde el controlador
});

// 2. ESTADO REACTIVO
const slotDuration = ref(30);
const saved = ref(false);
const originalData = ref(null);

// Valores por defecto para la disponibilidad
const localAvailability = reactive({
    lunes: { active: true, start: "08:00", end: "18:00" },
    martes: { active: true, start: "08:00", end: "18:00" },
    miercoles: { active: true, start: "08:00", end: "18:00" },
    jueves: { active: true, start: "08:00", end: "18:00" },
    viernes: { active: true, start: "08:00", end: "17:00" },
    sabado: { active: true, start: "09:00", end: "14:00" },
    domingo: { active: false, start: "09:00", end: "13:00" },
});

const durationOptions = [
    { label: "15 min", value: 15 },
    { label: "30 min", value: 30 },
    { label: "45 min", value: 45 },
    { label: "1 hora", value: 60 },
    { label: "2 horas", value: 120 },
];

const dayLabels = {
    lunes: "Lunes",
    martes: "Martes",
    miercoles: "Miércoles",
    jueves: "Jueves",
    viernes: "Viernes",
    sabado: "Sábado",
    domingo: "Domingo",
};

const form = useForm({
    availability: {},
    duration: 30,
});

const dayLabel = (key) => dayLabels[key] || key;

const toggleDay = (day) => {
    localAvailability[day].active = !localAvailability[day].active;
};

const slotsCount = (config) => {
    if (!config.start || !config.end) return 0;
    const [startH, startM] = config.start.split(":").map(Number);
    const [endH, endM] = config.end.split(":").map(Number);
    const totalMinutes = endH * 60 + endM - (startH * 60 + startM);
    return totalMinutes > 0 ? Math.floor(totalMinutes / slotDuration.value) : 0;
};

const hasChanges = computed(() => {
    if (!originalData.value) return false;
    const current = JSON.stringify({
        availability: localAvailability,
        duration: slotDuration.value,
    });
    return current !== originalData.value;
});

const saveChanges = () => {
    form.availability = localAvailability;
    form.duration = slotDuration.value;

    form.post(route("agendly.business.settings.store"), {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Guardado con éxito");
            originalData.value = JSON.stringify({
                availability: localAvailability,
                duration: slotDuration.value,
            });
            saved.value = true;
            setTimeout(() => {
                saved.value = false;
            }, 2500);
        },
        onError: (errors) => {
            console.error("Errores recibidos:", errors);
        },
    });
};

onMounted(() => {
    if (props.businessSettings) {
        const av = props.businessSettings.availability;

        if (av) {
            Object.keys(av).forEach((day) => {
                if (localAvailability[day]) {
                    localAvailability[day].active = av[day].active;
                    localAvailability[day].start = av[day].start;
                    localAvailability[day].end = av[day].end;
                }
            });
        }
        slotDuration.value = props.businessSettings.duration || 30;
    }

    originalData.value = JSON.stringify({
        availability: localAvailability,
        duration: slotDuration.value,
    });
});
</script>
