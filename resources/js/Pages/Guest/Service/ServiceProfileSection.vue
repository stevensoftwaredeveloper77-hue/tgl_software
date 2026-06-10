<script setup lang="ts">
import { ref } from "vue";
import ServiceCard from "./ServiceCard.vue";
import ButtonAction from "@/Components/ButtonAction.vue";
import { services, stats } from "@/Features/siteTexts.ts";
import SectionSeparator from "@/Components/SectionSeparator.vue";
import { scrollToAppointmentSection } from "@/Actions/navigation.js";
import ButtonWhatsappMessage from "@/Components/ButtonWhatsappMessage.vue";

const emit = defineEmits<{
    selectService: [id: number];
}>();

const handleServiceSelect = (id: number) => {
    emit("selectService", id);
};
</script>

<template>
    <section
        id="services_section"
        class="relative overflow-hidden bg-slate-950"
    >
        <div
            class="relative pt-20 pb-16 sm:pt-28 sm:pb-24 lg:pt-32 lg:pb-28 border-b border-slate-900/60"
        >
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-60"
            ></div>

            <div
                class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"
            ></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"
            ></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center"
                >
                    <div class="lg:col-span-7 space-y-6 text-left">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full"
                        >
                            <span class="flex h-1.5 w-1.5 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"
                                ></span>
                                <span
                                    class="relative inline-flex rounded-full h-1.5 w-1.5 bg-cyan-400"
                                ></span>
                            </span>
                            <span
                                class="font-mono text-[10px] tracking-widest text-cyan-400 font-bold uppercase"
                                >Expertise_Stack</span
                            >
                        </div>

                        <h1
                            class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-none text-pretty"
                        >
                            Portafolio de
                            <span
                                class="bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent"
                                >Servicios</span
                            >
                        </h1>

                        <p
                            class="text-base sm:text-lg text-slate-400 max-w-2xl text-pretty leading-relaxed"
                        >
                            Como desarrollador Full Stack, diseño y construyo productos digitales autónomos, escalables y de alto rendimiento. Mi enfoque combina una sólida arquitectura backend con interfaces modernas, integrando automatizaciones e inteligencia artificial para resolver necesidades técnicas complejas.
                        </p>
                    </div>

                    <div
                        class="lg:col-span-5 bg-slate-900/40 border border-slate-800/80 rounded-xl p-5 font-mono text-xs text-slate-400 backdrop-blur-md shadow-[0_20px_50px_rgba(0,0,0,0.5)] hidden md:block border-t-cyan-500/30"
                    >
                        <div
                            class="flex items-center justify-between border-b border-slate-800/80 pb-3 mb-4"
                        >
                            <div class="flex items-center gap-1.5">
                                <span
                                    class="w-2.5 h-2.5 rounded-full bg-slate-800 border border-red-500/40"
                                ></span>
                                <span
                                    class="w-2.5 h-2.5 rounded-full bg-slate-800 border border-yellow-500/40"
                                ></span>
                                <span
                                    class="w-2.5 h-2.5 rounded-full bg-slate-800 border border-green-500/40"
                                ></span>
                            </div>
                            <span
                                class="text-[10px] text-slate-500 font-bold tracking-wider"
                                >developer_status.sh</span
                            >
                        </div>
                        <div class="space-y-2">
                            <p class="text-blue-400">
                                <span class="text-slate-600">></span> npm run
                                check:capabilities
                            </p>
                            <p class="text-slate-400">
                                <span class="text-emerald-500">✔</span>
                                Full_Stack_Apps ... [STANDARDS]
                            </p>
                            <p class="text-slate-400">
                                <span class="text-emerald-500">✔</span>
                                Smart_Contracts ... [VERIFIED]
                            </p>
                            <p class="text-slate-400">
                                <span class="text-cyan-400">⚡</span> Status:
                                Listo para nuevos desafíos y proyectos
                            </p>

                            <div
                                class="h-1.5 w-full bg-slate-950 rounded-full overflow-hidden mt-3 border border-slate-800"
                            >
                                <div
                                    class="h-full w-full bg-gradient-to-r from-blue-500 via-cyan-400 to-blue-600 rounded-full opacity-85 animate-pulse"
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="grid grid-cols-2 lg:grid-cols-4 gap-4 max-w-7xl mx-auto mt-16 pt-8 border-t border-slate-900/60"
                >
                    <div
                        v-for="stat in stats"
                        :key="stat.label"
                        class="relative px-6 py-4 rounded-xl bg-slate-900/20 border border-slate-900 backdrop-blur-sm flex items-center gap-4 group hover:border-blue-500/20 transition-all duration-300"
                    >
                        <div
                            class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400"
                        >
                            {{ stat.value }}
                        </div>
                        <div
                            class="text-xs font-mono text-slate-500 tracking-wide font-bold uppercase group-hover:text-slate-400 transition-colors"
                        >
                            {{ stat.label }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-950/40 py-20 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 space-y-2">
                    <span
                        class="inline-block px-3 py-1 font-mono text-[10px] uppercase font-extrabold tracking-widest bg-blue-500/10 text-cyan-400 border border-cyan-500/20 rounded"
                    >
                        Services // 01
                    </span>
                    <h2
                        class="text-3xl sm:text-4xl font-black text-white text-balance"
                    >
                        Soluciones e Ingeniería
                    </h2>
                    <p
                        class="text-slate-400 max-w-xl mx-auto text-sm text-pretty"
                    >
                        Servicios técnicos especializados orientados a crear software escalable, seguro y optimizado bajo las mejores prácticas.
                    </p>
                </div>

                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
                >
                    <ServiceCard
                        v-for="service in services"
                        :key="service.id"
                        :service="service"
                        @select="handleServiceSelect"
                    />
                </div>
            </div>
        </div>

        <!-- <SectionSeparator
            variant="diagonal"
            title="¿Tienes un proyecto en mente o requieres consultoría externa?"
            subtitle="Hablemos sobre los requerimientos técnicos y definamos la arquitectura ideal para llevarlo a cabo."
        />

        <div class="bg-slate-950 py-16 sm:py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative bg-slate-900/40 border border-slate-800/60 rounded-2xl p-8 sm:p-12 lg:p-16 overflow-hidden shadow-2xl"
                >
                    <div
                        class="absolute -top-24 -right-24 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"
                    ></div>
                    <div
                        class="absolute -bottom-24 -left-24 w-72 h-72 bg-cyan-400/10 rounded-full blur-3xl pointer-events-none"
                    ></div>

                    <div class="relative z-10 text-center space-y-6">
                        <h3
                            class="text-2xl sm:text-3xl lg:text-4xl font-black text-white text-balance"
                        >
                            ¿Trabajamos juntos?
                        </h3>
                        <p
                            class="text-slate-400 text-sm sm:text-base max-w-xl mx-auto text-pretty"
                        >
                            Agenda una sesión técnica introductoria para analizar los objetivos de tu aplicación o plataforma.
                        </p>

                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-center pt-2"
                        >
                            <ButtonAction
                                text="Agendar Sesión"
                                @click="scrollToAppointmentSection()"
                            />
                            <ButtonWhatsappMessage />
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </section>
</template>