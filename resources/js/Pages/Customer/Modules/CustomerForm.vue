<template>
    <div>
        <form @submit.prevent="" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <InputLabel
                        for="name"
                        value="Nombre"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="name"
                        type="text"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-blue-500 focus:ring-blue-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner"
                        placeholder="Ej. Darío"
                        v-model="form.name"
                        required
                        autocomplete="name"
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.name"
                    />
                </div>

                <div>
                    <InputLabel
                        for="last_name"
                        value="Apellidos"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="last_name"
                        type="text"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-blue-500 focus:ring-blue-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner"
                        placeholder="Ej. Martínez"
                        v-model="form.last_name"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.last_name"
                    />
                </div>

                <div>
                    <InputLabel
                        for="phone"
                        value="Teléfono"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="phone"
                        type="number"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-blue-500 focus:ring-blue-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                        placeholder="Ej. 3215648965"
                        v-model="form.phone"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.phone"
                    />
                </div>

                <div>
                    <InputLabel
                        for="email"
                        value="Correo"
                        class="text-slate-400 font-mono text-xs uppercase tracking-wider mb-2 block"
                    />

                    <TextInput
                        id="email"
                        type="email"
                        class="w-full bg-[#0d1527]/80 border-slate-800 focus:border-blue-500 focus:ring-blue-500/20 text-slate-200 placeholder-slate-600 rounded-xl shadow-inner"
                        placeholder="correo@ejemplo.com"
                        v-model="form.email"
                        required
                    />

                    <InputError
                        class="mt-2 text-rose-400 font-mono text-xs"
                        :message="form.errors.email"
                    />
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <PrimaryButton
                    @click="storeCustomer()"
                    :disabled="form.processing"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-500 text-white border border-blue-400/30 font-mono text-xs uppercase tracking-widest px-6 py-3 rounded-xl transition-all duration-300 hover:shadow-[0_0_20px_rgba(59,130,246,0.4)] disabled:opacity-50 disabled:pointer-events-none active:scale-95"
                >
                    {{
                        customerItem
                            ? "⚡ Actualizar Parámetros"
                            : "💾 Guardar Registro"
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
    customerItem: Object,
    documentTypes: Array,
});

const emit = defineEmits(["showCustomerForm", "updateList"]);

const form = useForm({
    name: props.customerItem ? props.customerItem.name : "",
    last_name: props.customerItem ? props.customerItem.last_name : "",
    phone: props.customerItem ? props.customerItem.phone : "",
    email: props.customerItem ? props.customerItem.email : "",
});

const storeCustomer = () => {
    if (props.customerItem) {
        form.post(route("customer.update", props.customerItem.id), {
            preserveScroll: true,
            onSuccess: () => {
                emit("updateList");
                toast.success("Has actualizado el cliente");
                emit("showCustomerForm");
            },
        });
    } else {
        form.post(route("customer.store"), {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                emit("updateList");
                toast.success("Has agregado un nuevo cliente");
                emit("showCustomerForm");
            },
        });
    }
};
</script>
