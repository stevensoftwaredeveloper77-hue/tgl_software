<template>
    <div>
        <form @submit.prevent="" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="sm:col-span-3">
                    <InputLabel
                        for="message"
                        value="Mensaje / Detalle de la Petición"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="message"
                        type="text"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-purple-500 focus:ring-purple-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner"
                        placeholder="Describe los detalles de la solicitud o soporte..."
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
                        value="Fecha de Registro"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="date"
                        type="date"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-purple-500 focus:ring-purple-500/20 text-slate-200 rounded-xl shadow-inner scheme-dark"
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
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-purple-500 focus:ring-purple-500/20 text-slate-200 rounded-xl shadow-inner scheme-dark"
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
                        for="request_type"
                        value="Tipo de Petición"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <BaseSelect
                        id="request_type"
                        v-model="form.request_type_id"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-purple-500 focus:ring-purple-500/20 text-slate-200 rounded-xl shadow-inner"
                        :options-select="requestTypes"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.request_type_id"
                    />
                </div>

                <div class="sm:col-span-3 grid grid-cols-1">
                    <InputLabel
                        for="customer"
                        value="Cliente Solicitante"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <BaseSelect
                        id="customer"
                        v-model="form.customer_id"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-purple-500 focus:ring-purple-500/20 text-slate-200 rounded-xl shadow-inner"
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
                    @click="storeRequest()"
                    :disabled="form.processing"
                    class="w-full sm:w-auto bg-purple-600 hover:bg-purple-500 text-white border border-purple-400/30 font-mono text-xs uppercase tracking-widest px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-[0_0_20px_rgba(168,85,247,0.4)] disabled:opacity-50 disabled:pointer-events-none active:scale-95"
                >
                    {{
                        requestItem
                            ? "⚡ Actualizar Parámetros"
                            : "💾 Desplegar Petición"
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
    requestItem: Object,
    requestTypes: Array,
    customers: Array,
});

const emit = defineEmits(["showRequestForm", "updateList"]);

const form = useForm({
    message: props.requestItem ? props.requestItem.message : "",
    date: props.requestItem ? props.requestItem.date : "",
    hour: props.requestItem ? props.requestItem.hour : "",
    request_type_id: props.requestItem ? props.requestItem.request_type_id : "",
    customer_id: props.requestItem ? props.requestItem.customer_id : "",
});

const storeRequest = () => {
    if (props.requestItem) {
        form.post(route("request.update", props.requestItem.id), {
            preserveScroll: true,
            onSuccess: () => {
                emit("updateList");
                toast.success("Has actualizado la petición");
                emit("showRequestForm");
            },
        });
    } else {
        form.post(route("request.store"), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                emit("updateList");
                toast.success("Has agregado una nueva petición");
                emit("showRequestForm");
            },
        });
    }
};
</script>
