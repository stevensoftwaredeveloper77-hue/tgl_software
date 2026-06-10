<template>
    <Head title="Peticiones" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">
                Peticiones
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-[#070b14]/40 backdrop-blur-md border border-slate-800/60 shadow-2xl sm:rounded-2xl"
                >
                    <div class="p-8 flex flex-col gap-8">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-800/60 pb-5"
                        >
                            <div>
                                <span
                                    class="text-xs font-mono tracking-widest text-purple-500 uppercase"
                                    >// sys_mod_03</span
                                >
                                <h3
                                    class="text-lg font-bold text-slate-200 tracking-wide mt-0.5"
                                >
                                    Administrativo de Peticiones
                                </h3>
                            </div>

                            <div>
                                <PrimaryButton
                                    @click="showRequestForm()"
                                    class="bg-purple-600/10 hover:bg-purple-600/20 text-purple-400 border border-purple-500/30 hover:border-purple-400/60 font-mono text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(168,85,247,0.2)] active:scale-95"
                                >
                                    {{
                                        isVisibleForm
                                            ? "✕ Cerrar Formulario"
                                            : "＋ Agregar Petición"
                                    }}
                                </PrimaryButton>
                            </div>
                        </div>

                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="transform opacity-0 -translate-y-4"
                            enter-to-class="transform opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-200"
                            leave-from-class="transform opacity-100 translate-y-0"
                            leave-to-class="transform opacity-0 -translate-y-4"
                        >
                            <RequestForm
                                @updateList="updateList"
                                v-if="isVisibleForm"
                                @showRequestForm="showRequestForm"
                                :requestTypes="requestTypes"
                                :customers="customers"
                                class="bg-[#0c1322]/60 border border-slate-800/80 rounded-2xl p-6 shadow-inner"
                            />
                        </transition>

                        <RequestList
                            @updateList="updateList"
                            :requests="requestsList"
                            :requestTypes="requestTypes"
                            :customers="customers"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import RequestForm from "./Modules/RequestForm.vue";
import RequestList from "./Modules/RequestList.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    requests: Object,
    requestTypes: Array,
    customers: Array,
});

const isVisibleForm = ref(false);
const requestsList = ref(props.requests);

const showRequestForm = () => {
    isVisibleForm.value = !isVisibleForm.value;
};

const updateList = (requests) => {
    if (requests) {
        requestsList.value = requests;
    } else {
        requestsList.value = props.requests;
    }
};
</script>
