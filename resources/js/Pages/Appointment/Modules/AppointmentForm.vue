<template>
    <div>
        <form @submit.prevent="" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-3">
                    <InputLabel
                        for="message"
                        value="Mensaje / Requerimiento"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="message"
                        type="text"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner"
                        placeholder="Detalles o descripción corta de la solicitud..."
                        v-model="form.message"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.message"
                    />
                </div>

                <div>
                    <InputLabel
                        for="date"
                        value="Fecha"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="date"
                        type="date"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 text-slate-200 rounded-xl shadow-inner scheme-dark"
                        v-model="form.date"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.date"
                    />
                </div>

                <div>
                    <InputLabel
                        for="hour"
                        value="Hora"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="hour"
                        type="time"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 text-slate-200 rounded-xl shadow-inner scheme-dark"
                        v-model="form.hour"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.hour"
                    />
                </div>

                <div>
                    <InputLabel
                        for="appointment_type"
                        value="Tipo de Cita"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <BaseSelect
                        id="appointment_type"
                        v-model="form.appointment_type_id"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 text-slate-200 rounded-xl shadow-inner"
                        :options-select="appointmentTypes"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.appointment_type_id"
                    />
                </div>

                <div class="sm:col-span-3 grid grid-cols-1">
                    <InputLabel
                        for="customer"
                        value="Cliente Asignado"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <BaseSelect
                        id="customer"
                        v-model="form.customer_id"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-emerald-500 focus:ring-emerald-500/20 text-slate-200 rounded-xl shadow-inner"
                        :options-select="customers"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.customer_id"
                    />
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <PrimaryButton
                    @click="storeAppointment()"
                    :disabled="form.processing"
                    class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white border border-emerald-400/30 font-mono text-xs uppercase tracking-widest px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] disabled:opacity-50 disabled:pointer-events-none active:scale-95"
                >
                    {{
                        appointmentItem
                            ? "⚡ Actualizar Parámetros"
                            : "💾 Reservar Cita"
                    }}
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<script setup>
import { toast } from "vue3-toastify";
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import BaseSelect from "@/Components/BaseSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    appointmentItem: Object,
    appointmentTypes: Array,
    customers: Array,
});

const emit = defineEmits(["showAppointmentForm", "updateList"]);

const form = useForm({
    message: props.appointmentItem ? props.appointmentItem.message : "",
    date: props.appointmentItem ? props.appointmentItem.date : "",
    hour: props.appointmentItem ? props.appointmentItem.hour : "",
    appointment_type_id: props.appointmentItem
        ? props.appointmentItem.appointment_type_id
        : "",
    customer_id: props.appointmentItem ? props.appointmentItem.customer_id : "",
});

const storeAppointment = () => {
    if (props.appointmentItem) {
        form.post(route("appointment.update", props.appointmentItem.id), {
            preserveScroll: true,
            onSuccess: () => {
                emit("updateList");
                toast.success("Has actualizado la cita");
                emit("showAppointmentForm");
            },
        });
    } else {
        form.post(route("appointment.store"), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                emit("updateList");
                toast.success("Has agregado una nueva cita");
                emit("showAppointmentForm");
            },
        });
    }
};
</script>
