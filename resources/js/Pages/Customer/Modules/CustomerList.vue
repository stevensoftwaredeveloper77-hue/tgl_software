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
            <CustomerForm
                v-if="isVisibleForm"
                @updateList="updateList"
                @showCustomerForm="showCustomerForm"
                :customerItem="customerItem"
                class="bg-[#0c1322]/80 border border-blue-500/30 rounded-2xl p-6 shadow-xl mb-4"
            />
        </transition>

        <div class="text-center py-2">
            <h1
                class="text-xl font-bold tracking-wider text-slate-200 uppercase font-mono"
            >
                // Listado de Clientes
            </h1>
            <div
                class="h-0.5 w-16 bg-blue-500/50 mx-auto mt-2 rounded-full"
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
                        <th class="px-6 py-4 font-semibold">Nombre</th>
                        <th class="px-6 py-4 font-semibold">Apellido</th>
                        <th class="px-6 py-4 font-semibold">Teléfono</th>
                        <th class="px-6 py-4 font-semibold">Correo</th>
                        <th class="px-6 py-4 font-semibold text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-slate-800/40 text-slate-300 text-sm"
                >
                    <tr
                        v-for="customer in customers"
                        :key="customer.id"
                        class="transition-colors duration-200 hover:bg-slate-800/20 hover:text-slate-100"
                    >
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ customer.name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                            {{ customer.last_name }}
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">
                            {{ customer.phone }}
                        </td>
                        <td class="px-6 py-4 text-slate-400">
                            {{ customer.email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-3">
                                <Tooltip content="Editar" width="w-auto">
                                    <button
                                        @click="editCustomer(customer)"
                                        class="p-2.5 rounded-xl bg-blue-500/5 text-blue-400 border border-blue-500/20 hover:border-blue-400 hover:bg-blue-500/20 hover:text-blue-300 transition-all duration-200 active:scale-95"
                                        title="Editar Cliente"
                                    >
                                        <i
                                            class="fa-solid fa-pencil text-xs"
                                        ></i>
                                    </button>
                                </Tooltip>

                                <Tooltip content="Eliminar" width="w-auto">
                                    <button
                                        @click="deleteCustomer(customer.id)"
                                        class="p-2.5 rounded-xl bg-rose-500/5 text-rose-400 border border-rose-500/20 hover:border-rose-400 hover:bg-rose-500/20 hover:text-rose-300 transition-all duration-200 active:scale-95"
                                        title="Eliminar Cliente"
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
import CustomerForm from "./CustomerForm.vue";
import Tooltip from "@/Components/Tooltip.vue";

const emit = defineEmits(["updateList"]);
const props = defineProps({
    customers: Object,
    documentTypes: Array,
});

const form = useForm({});
const customerItem = ref({});
const isVisibleForm = ref(false);

const showCustomerForm = () => {
    isVisibleForm.value = !isVisibleForm.value;
};

const editCustomer = (customer) => {
    customerItem.value = customer;
    showCustomerForm();
};

const deleteCustomer = (customerId) => {
    axios
        .post(route("customer.delete"), {
            customerId,
        })
        .then((response) => {
            emit("updateList", response.data);
            toast.success("El cliente ha sido eliminado");
        })
        .catch((error) => {
            console.error(error);
        });
};

const updateList = () => {
    emit("updateList");
};
</script>
