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
            <RequestForm
                v-if="isVisibleForm"
                @updateList="updateList"
                @showRequestForm="showRequestForm"
                :requestTypes="requestTypes"
                :customers="customers"
                :requestItem="requestItem"
                class="bg-[#0c1322]/80 border border-purple-500/30 rounded-2xl p-6 shadow-xl mb-4"
            />
        </transition>

        <div class="text-center py-2">
            <h1
                class="text-xl font-bold tracking-wider text-slate-200 uppercase font-mono"
            >
                // Listado de Peticiones
            </h1>
            <div
                class="h-0.5 w-16 bg-purple-500/50 mx-auto mt-2 rounded-full"
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
                        <th class="px-6 py-4 font-semibold">
                            Tipo de Petición
                        </th>
                        <th class="px-6 py-4 font-semibold">
                            Mensaje / Requerimiento
                        </th>
                        <th class="px-6 py-4 font-semibold">Fecha</th>
                        <th class="px-6 py-4 font-semibold text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="divide-y divide-slate-800/40 text-slate-300 text-sm"
                >
                    <tr
                        v-for="request in requests"
                        :key="request.id"
                        class="transition-colors duration-200 hover:bg-slate-800/20 hover:text-slate-100"
                    >
                        <td
                            class="px-6 py-4 font-medium whitespace-nowrap text-slate-200"
                        >
                            {{ request.name }} {{ request.last_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2.5 py-1 rounded-md text-xs font-mono bg-purple-500/10 text-purple-400 border border-purple-500/20"
                            >
                                {{ request.requestType }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-4 text-slate-400 max-w-xs truncate"
                            :title="request.message"
                        >
                            {{ request.message }}
                        </td>
                        <td
                            class="px-6 py-4 font-mono text-xs text-slate-400 whitespace-nowrap"
                        >
                            {{ request.date }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-3">
                                <Tooltip content="Editar" width="w-auto">
                                    <button
                                        @click="editRequest(request)"
                                        class="p-2.5 rounded-xl bg-purple-500/5 text-purple-400 border border-purple-500/20 hover:border-purple-400 hover:bg-purple-500/20 hover:text-purple-300 transition-all duration-200 active:scale-95"
                                        title="Editar Petición"
                                    >
                                        <i
                                            class="fa-solid fa-pencil text-xs"
                                        ></i>
                                    </button>
                                </Tooltip>

                                <Tooltip content="Eliminar" width="w-auto">
                                    <button
                                        @click="deleteRequest(request.id)"
                                        class="p-2.5 rounded-xl bg-rose-500/5 text-rose-400 border border-rose-500/20 hover:border-rose-400 hover:bg-rose-500/20 hover:text-rose-300 transition-all duration-200 active:scale-95"
                                        title="Eliminar Petición"
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
import RequestForm from "./RequestForm.vue";
import Tooltip from "@/Components/Tooltip.vue";

const emit = defineEmits(["updateList"]);
const props = defineProps({
    requests: Object,
    requestTypes: Array,
    customers: Array,
});

const form = useForm({});
const requestItem = ref({});
const isVisibleForm = ref(false);

const showRequestForm = () => {
    isVisibleForm.value = !isVisibleForm.value;
};

const editRequest = (request) => {
    requestItem.value = request;
    showRequestForm();
};

const deleteRequest = (requestId) => {
    axios
        .post(route("request.delete"), {
            requestId,
        })
        .then((response) => {
            emit("updateList", response.data);
            toast.success("La petición ha sido eliminada");
        })
        .catch((error) => {
            console.error(error);
        });
};

const updateList = () => {
    emit("updateList");
};
</script>
