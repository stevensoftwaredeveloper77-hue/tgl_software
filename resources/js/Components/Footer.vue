<script setup lang="ts">
import { navigateToSection } from "@/Actions/navigation.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const currentYear = new Date().getFullYear();

const footerLinks = [
    { id: "company_information", label: "Sobre TGL" },
    { id: "services_section", label: "Servicios" },
    { id: "technologies_stack", label: "Stack Tecnológico" },
    { id: "appointment_section", label: "Agendar Consulta" },
];
</script>

<template>
    <footer
        class="relative bg-slate-950 border-t border-slate-900 pt-12 pb-6 overflow-hidden"
    >
        <div
            class="absolute inset-0 bg-[radial-gradient(#0f172a_1px,transparent_1px)] [background-size:16px_16px] opacity-20 pointer-events-none"
        ></div>
        <div
            class="absolute bottom-0 right-0 w-80 h-40 bg-blue-500/[0.03] rounded-full blur-3xl pointer-events-none"
        ></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="grid grid-cols-1 lg:grid-cols-12 border border-slate-900/80 rounded-xl bg-slate-900/10 backdrop-blur-sm overflow-hidden shadow-xl"
            >
                <div
                    class="lg:col-span-7 p-6 sm:p-8 border-b lg:border-b-0 lg:border-r border-slate-900/80 flex flex-col justify-between gap-6"
                >
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <ApplicationLogo class="h-6 w-auto text-white" />
                            <span
                                class="font-mono text-[9px] bg-blue-500/10 border border-blue-500/20 text-blue-400 px-2 py-0.5 rounded font-bold tracking-widest uppercase"
                            >
                                v2.0 // LIVE
                            </span>
                        </div>
                        <p
                            class="text-slate-400 font-sans text-xs sm:text-sm leading-relaxed max-w-xl"
                        >
                            Transformamos ideas en soluciones digitales
                            innovadoras. Desarrollo de software a medida,
                            consultoría tecnológica y agentes de IA para
                            impulsar tu negocio.
                        </p>
                    </div>

                    <div
                        class="flex items-center gap-2 font-mono text-[10px] text-slate-500 select-none"
                    >
                        <span
                            class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"
                        ></span>
                        <span class="text-slate-600">SYSTEM_STATUS:</span>
                        <span class="text-slate-400 font-semibold uppercase"
                            >Operational</span
                        >
                    </div>
                </div>

                <div
                    class="lg:col-span-5 p-6 sm:p-8 bg-slate-950/20 flex flex-col justify-center"
                >
                    <div class="w-full">
                        <span
                            class="block font-mono text-[10px] font-bold text-slate-600 tracking-widest uppercase mb-4"
                        >
                            [ SERVICIOS ]
                        </span>

                        <ul
                            role="list"
                            class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3 font-mono text-xs"
                        >
                            <li v-for="link in footerLinks" :key="link.label">
                                <button
                                    @click="navigateToSection(link.id)"
                                    class="text-slate-400 hover:text-cyan-400 flex items-center gap-1.5 transition-all duration-300 ease-out transform hover:translate-x-1 group/link"
                                >
                                    <span
                                        class="text-slate-800 group-hover/link:text-cyan-400 transition-colors duration-300 transform scale-x-0 origin-left group-hover/link:scale-x-100 transition-transform duration-200"
                                    >
                                        &gt;
                                    </span>

                                    <span
                                        class="font-sans text-sm relative after:absolute after:bottom-0 after:left-0 after:h-[1px] after:w-0 after:bg-cyan-500/30 after:transition-all after:duration-300 group-hover/link:after:w-full"
                                    >
                                        {{ link.label }}
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-[10px] text-slate-600 font-medium"
            >
                <div class="tracking-wide uppercase text-center sm:text-left">
                    &copy; {{ currentYear }} TGL SOFTWARE. All rights reserved.
                </div>

                <div
                    class="flex items-center gap-2 px-2.5 py-0.5 rounded border border-slate-900 bg-slate-900/40 backdrop-blur-sm select-none"
                >
                    <span class="text-slate-600 font-bold">POWERED_BY:</span>
                    <a
                        href="#"
                        class="text-slate-400 hover:text-rose-400 flex items-center gap-1 transition-colors duration-200 group/agendly font-bold"
                    >
                        <span>Agendly</span>
                        <svg
                            class="h-2.5 w-2.5 text-rose-500/80 fill-current animate-pulse group-hover/agendly:text-rose-400"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>
