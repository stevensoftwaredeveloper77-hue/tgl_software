<script setup lang="ts">
import { computed } from "vue";

const model = defineModel<string>({ required: true });

const props = defineProps<{
    selectedDate: string;
}>();

const timeSlots = [
    { time: "08:00", period: "Mañana" },
    { time: "08:30", period: "Mañana" },
    { time: "09:00", period: "Mañana" },
    { time: "09:30", period: "Mañana" },
    { time: "10:00", period: "Mañana" },
    { time: "10:30", period: "Mañana" },
    { time: "11:00", period: "Mañana" },
    { time: "11:30", period: "Mañana" },
    { time: "12:00", period: "Mediodía" },
    { time: "12:30", period: "Mediodía" },
    { time: "14:00", period: "Tarde" },
    { time: "14:30", period: "Tarde" },
    { time: "15:00", period: "Tarde" },
    { time: "15:30", period: "Tarde" },
    { time: "16:00", period: "Tarde" },
    { time: "16:30", period: "Tarde" },
    { time: "17:00", period: "Tarde" },
    { time: "17:30", period: "Tarde" },
];

const groupedSlots = computed(() => {
    const groups: Record<string, typeof timeSlots> = {};
    timeSlots.forEach((slot) => {
        if (!groups[slot.period]) {
            groups[slot.period] = [];
        }
        groups[slot.period].push(slot);
    });
    return groups;
});

const isSlotAvailable = (time: string) => {
    // Simulate some unavailable slots
    const unavailable = ["10:30", "14:00", "16:00"];
    return !unavailable.includes(time);
};

const selectTime = (time: string) => {
    if (isSlotAvailable(time)) {
        model.value = time;
    }
};
</script>

<template>
    <div class="bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">
                Selecciona una hora
            </h3>
            <span
                class="text-xs text-gray-500 bg-white px-3 py-1 rounded-full border border-gray-200"
            >
                Zona horaria: GMT-5
            </span>
        </div>

        <!-- No date selected message -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
        >
            <div v-if="!selectedDate" class="text-center py-12">
                <div
                    class="w-16 h-16 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center mb-4"
                >
                    <svg
                        class="w-8 h-8 text-gray-400"
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
                <p class="text-gray-500">Selecciona primero una fecha</p>
            </div>
        </Transition>

        <!-- Time slots -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
        >
            <div v-if="selectedDate" class="space-y-6">
                <div v-for="(slots, period) in groupedSlots" :key="period">
                    <h4
                        class="text-sm font-medium text-gray-500 mb-3 flex items-center gap-2"
                    >
                        <span
                            class="w-2 h-2 rounded-full"
                            :class="{
                                'bg-amber-400': period === 'Mañana',
                                'bg-orange-400': period === 'Mediodía',
                                'bg-blue-400': period === 'Tarde',
                            }"
                        ></span>
                        {{ period }}
                    </h4>
                    <div class="grid grid-cols-4 gap-2">
                        <button
                            v-for="slot in slots"
                            :key="slot.time"
                            @click="selectTime(slot.time)"
                            :disabled="!isSlotAvailable(slot.time)"
                            class="px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200"
                            :class="{
                                'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-105':
                                    model === slot.time,
                                'bg-white border border-gray-200 text-gray-700 hover:border-blue-300 hover:bg-blue-50 hover:shadow-md':
                                    model !== slot.time &&
                                    isSlotAvailable(slot.time),
                                'bg-gray-100 text-gray-300 cursor-not-allowed line-through':
                                    !isSlotAvailable(slot.time),
                            }"
                        >
                            {{ slot.time }}
                        </button>
                    </div>
                </div>

                <!-- Legend -->
                <div
                    class="flex items-center gap-4 pt-4 border-t border-gray-200"
                >
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span
                            class="w-3 h-3 bg-white border border-gray-200 rounded"
                        ></span>
                        Disponible
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-3 h-3 bg-gray-100 rounded"></span>
                        No disponible
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span class="w-3 h-3 bg-blue-500 rounded"></span>
                        Seleccionado
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Selected Time Display -->
        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
        >
            <div
                v-if="model"
                class="mt-6 p-4 bg-white rounded-xl border border-blue-100 shadow-sm"
            >
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
                            Hora seleccionada
                        </p>
                        <p class="font-semibold text-gray-900">{{ model }}</p>
                    </div>
                </div>
            </div>
        </Transition>
    </div>
</template>
