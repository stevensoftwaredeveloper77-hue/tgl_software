<template>
    <div class="flex flex-col gap-6">
        <transition
            enter-active-class="transition ease-out duration-300"
            enter-from-class="transform opacity-0 -translate-y-4"
            enter-to-class="transform opacity-100 translate-y-0"
            leave-active-class="transition ease-in duration-200"
            leave-from-class="transform opacity-100 translate-y-0"
            leave-to-class="transform opacity-0 -translate-y-4"
        >
            <AppointmentForm
                v-if="isVisibleForm"
                @updateList="updateList"
                @showAppointmentForm="showAppointmentForm"
                :appointmentTypes="appointmentTypes"
                :customers="customers"
                :appointmentItem="appointmentItem"
                class="bg-[#0c1322]/80 border border-emerald-500/30 rounded-2xl p-6 shadow-xl mb-4"
            />
        </transition>

        <div class="text-center py-2">
            <h1
                class="text-xl font-bold tracking-wider text-slate-200 uppercase font-mono"
            >
                // Listado de Citas
            </h1>
            <div
                class="h-0.5 w-16 bg-emerald-500/50 mx-auto mt-2 rounded-full"
            ></div>
        </div>

        <div
            class="overflow-x-auto rounded-xl border border-slate-800/60 bg-[#090f1c]/40 backdrop-blur-sm"
        >
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="border-b border-slate-800/80 bg-[#0d1527]/60 text-slate-400 font-mono text-xs uppercase tracking-wider"
                    >
                        <th class="px-6 py-4 font-semibold">Cliente</th>
                        <th class="px-6 py-4 font-semibold">Tipo de Cita</th>
                        <th class="px-6 py-4 font-semibold">
                            Mensaje / Motivo
                        </th>
                        <th class="px-6 py-4 font-semibold">Fecha</th>
                        <th class="px-6 py-4 font-semibold">Hora</th>
                        <th class="px-6 py-4 font-semibold text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-slate-800/40 text-slate-300 text-sm"
                >
                    <tr
                        v-for="appointment in appointments"
                        :key="appointment.id"
                        class="transition-colors duration-200 hover:bg-slate-800/20 hover:text-slate-100"
                    >
                        <td
                            class="px-6 py-4 font-medium whitespace-nowrap text-slate-200"
                        >
                            {{ appointment.name }} {{ appointment.last_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2.5 py-1 rounded-md text-xs font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"
                            >
                                {{ appointment.appointmentType }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 text-slate-400 max-w-xs truncate"
                            :title="appointment.message"
                        >
                            {{ appointment.message }}
                        </td>
                        <td
                            class="px-6 py-4 font-mono text-xs text-slate-400 whitespace-nowrap"
                        >
                            {{ appointment.date }}
                        </td>
                        <td
                            class="px-6 py-4 font-mono text-xs text-slate-400 whitespace-nowrap"
                        >
                            {{ appointment.hour }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-3">
                                <Tooltip content="Editar" width="w-auto">
                                    <button
                                        @click="editAppointment(appointment)"
                                        class="p-2.5 rounded-xl bg-emerald-500/5 text-emerald-400 border border-emerald-500/20 hover:border-emerald-400 hover:bg-emerald-500/20 hover:text-emerald-300 transition-all duration-200 active:scale-95"
                                        title="Editar Cita"
                                    >
                                        <i
                                            class="fa-solid fa-pencil text-xs"
                                        ></i>
                                    </button>
                                </Tooltip>

                                <Tooltip content="Eliminar" width="w-auto">
                                    <button
                                        @click="
                                            deleteAppointment(appointment.id)
                                        "
                                        class="p-2.5 rounded-xl bg-rose-500/5 text-rose-400 border border-rose-500/20 hover:border-rose-400 hover:bg-rose-500/20 hover:text-rose-300 transition-all duration-200 active:scale-95"
                                        title="Eliminar Cita"
                                    >
                                        <i
                                            class="fa-solid fa-trash-can text-xs"
                                        ></i>
                                    </button>
                                </Tooltip>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import { toast } from "vue3-toastify";
import { useForm } from "@inertiajs/vue3";
import AppointmentForm from "./AppointmentForm.vue";
import Tooltip from "@/Components/Tooltip.vue";

const emit = defineEmits(["updateList"]);
const props = defineProps({
    appointments: Object,
    appointmentTypes: Array,
    customers: Array,
});

const form = useForm({});
const appointmentItem = ref({});
const isVisibleForm = ref(false);

const showAppointmentForm = () => {
    isVisibleForm.value = !isVisibleForm.value;
};

const editAppointment = (appointment) => {
    appointmentItem.value = appointment;
    showAppointmentForm();
};

const deleteAppointment = (appointmentId) => {
    axios
        .post(route("appointment.delete"), {
            appointmentId,
        })
        .then((response) => {
            emit("updateList", response.data);
            toast.success("La cita ha sido eliminada");
        })
        .catch((error) => {
            console.error(error);
        });
};

const updateList = () => {
    emit("updateList");
};
</script>
