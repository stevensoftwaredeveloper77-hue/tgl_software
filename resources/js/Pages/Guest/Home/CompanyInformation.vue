<script lang="ts" setup>
import { ref } from "vue";

const isVisible = ref(true);
</script>

<template>
    <section
        id="company_information"
        class="relative overflow-hidden bg-[#030712] py-24 px-6 font-sans text-slate-300"
        :class="isVisible ? 'opacity-100' : 'opacity-0'"
    >
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#1f293710_1px,transparent_1px),linear-gradient(to_bottom,#1f293710_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"
        ></div>

        <div class="relative max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <p
                    class="text-blue-500 font-mono text-xs uppercase tracking-widest mb-2 font-semibold"
                >
                    // [ NUESTRA IDENTIDAD ]
                </p>
                <h2
                    class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl"
                >
                    Sobre TGL Soft
                </h2>
                <div
                    class="h-1 w-12 bg-blue-600 mx-auto mt-4 rounded-full"
                ></div>
            </div>

            <div
                class="grid md:grid-cols-3 gap-8 mb-20 border-b border-slate-900 pb-16 text-sm sm:text-base"
            >
                <div class="space-y-3">
                    <div class="text-blue-400 font-mono text-xs font-bold">
                        // 01 . INGENIERÍA DIGITAL
                    </div>
                    <h4 class="text-lg font-bold text-white tracking-tight">
                        Soluciones de Raíz
                    </h4>
                    <p class="text-slate-400 leading-relaxed">
                        En
                        <span class="text-white font-medium">TGL Soft</span> no
                        entendemos el desarrollo como líneas de código aisladas,
                        sino como la arquitectura de infraestructuras digitales
                        escalables. Nacimos con el propósito de diseñar
                        plataformas robustas y a medida que eliminen cuellos de
                        botella operativos y habiliten el crecimiento
                        tecnológico real de empresas y emprendimientos.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="text-blue-400 font-mono text-xs font-bold">
                        // 02 . INNOVACIÓN INTERNA
                    </div>
                    <h4 class="text-lg font-bold text-white tracking-tight">
                        Ecosistema Integrado
                    </h4>
                    <p class="text-slate-400 leading-relaxed">
                        Nuestra experiencia se respalda tanto en la consultoría
                        externa como en la creación de productos propios de alto
                        impacto. Al ser los desarrolladores y creadores de
                        plataformas como
                        <span class="text-white font-medium">Agendly</span> —un
                        ecosistema enfocado en la automatización y gestión
                        inteligente de citas—, demostramos nuestra capacidad
                        para conceptualizar, desplegar y mantener soluciones
                        listas para el mercado competitivo.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="text-blue-400 font-mono text-xs font-bold">
                        // 03 . PRÓXIMA GENERACIÓN
                    </div>
                    <h4 class="text-lg font-bold text-white tracking-tight">
                        IA y Automatización
                    </h4>
                    <p class="text-slate-400 leading-relaxed">
                        Nos mantenemos a la vanguardia tecnológica fusionando
                        arquitecturas de backend altamente eficientes con las
                        últimas tendencias de diseño de interfaz, optimización
                        SEO y automatización avanzada mediante agentes de
                        Inteligencia Artificial. Construimos el software del
                        presente asegurando que sea compatible con las demandas
                        y tecnologías del futuro.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 items-stretch">
                <div
                    class="group relative rounded-2xl border border-slate-800/80 bg-slate-900/40 p-8 backdrop-blur-sm transition-all duration-300 hover:border-blue-500/30 hover:shadow-lg hover:shadow-blue-500/5"
                >
                    <div
                        class="absolute inset-0 -z-10 rounded-2xl bg-gradient-to-br from-blue-600/0 via-blue-600/0 to-blue-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    ></div>

                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="p-3 rounded-xl bg-blue-950/50 border border-blue-900/50 text-blue-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 2.25c-3.356 0-6.23 2.191-7.23 5.253a15.11 15.11 0 0 0 6.039 12.162L9.63 19.5"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 9.75M12 12m3-2.25M9 15.75m3-2.25m3 2.25"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-tight">
                            Nuestra Misión
                        </h3>
                    </div>

                    <p
                        class="text-slate-400 leading-relaxed text-sm sm:text-base"
                    >
                        Diseñar y desarrollar soluciones de software de alta
                        calidad y rendimiento, aportando herramientas
                        tecnológicas innovadoras que optimicen los procesos
                        operativos, resuelvan cuellos de botella estructurales y
                        potencien la competitividad de nuestros clientes en el
                        ecosistema digital.
                    </p>
                </div>

                <div
                    class="group relative rounded-2xl border border-slate-800/80 bg-slate-900/40 p-8 backdrop-blur-sm transition-all duration-300 hover:border-emerald-500/30 hover:shadow-lg hover:shadow-emerald-500/5"
                >
                    <div
                        class="absolute inset-0 -z-10 rounded-2xl bg-gradient-to-br from-emerald-600/0 via-emerald-600/0 to-emerald-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                    ></div>

                    <div class="flex items-center gap-4 mb-4">
                        <div
                            class="p-3 rounded-xl bg-emerald-950/50 border border-emerald-900/50 text-emerald-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white tracking-tight">
                            Nuestra Visión
                        </h3>
                    </div>

                    <p
                        class="text-slate-400 leading-relaxed text-sm sm:text-base"
                    >
                        Consolidarnos como un referente líder en desarrollo de
                        software y consultoría tecnológica avanzada. Nos
                        proyectamos expandiendo nuestro ecosistema a través del
                        despliegue de productos propios de alto impacto y la
                        integración de inteligencia artificial, impulsando la
                        transformación digital a nivel global.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
