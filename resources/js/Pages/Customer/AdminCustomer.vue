<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-slate-200 leading-tight">
                Clientes
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
                                    class="text-xs font-mono tracking-widest text-blue-500 uppercase"
                                    >// sys_mod_01</span
                                >
                                <h3
                                    class="text-lg font-bold text-slate-200 tracking-wide mt-0.5"
                                >
                                    Administrativo de Clientes
                                </h3>
                            </div>

                            <div>
                                <PrimaryButton
                                    @click="showCustomerForm()"
                                    class="bg-blue-600/10 hover:bg-blue-600/20 text-blue-400 border border-blue-500/30 hover:border-blue-400/60 font-mono text-xs uppercase tracking-wider px-5 py-2.5 rounded-xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(59,130,246,0.2)] active:scale-95"
                                >
                                    {{
                                        isVisibleForm
                                            ? "✕ Cerrar Formulario"
                                            : "＋ Agregar cliente"
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
                            <CustomerForm
                                @updateList="updateList"
                                v-if="isVisibleForm"
                                @showCustomerForm="showCustomerForm"
                                class="bg-[#0c1322]/60 border border-slate-800/80 rounded-2xl p-6 shadow-inner"
                            />
                        </transition>

                        <CustomerList
                            @updateList="updateList"
                            :customers="customersList"
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
import CustomerForm from "./Modules/CustomerForm.vue";
import CustomerList from "./Modules/CustomerList.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    customers: Object,
});

const isVisibleForm = ref(false);
const customersList = ref(props.customers);

const showCustomerForm = () => {
    isVisibleForm.value = !isVisibleForm.value;
};

const updateList = (customers) => {
    if (customers) {
        customersList.value = customers;
    } else {
        customersList.value = props.customers;
    }
};
</script>
