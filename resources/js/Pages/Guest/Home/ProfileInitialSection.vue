<script setup lang="ts">
import { ref } from "vue";
import ButtonWhatsappMessage from "@/Components/ButtonWhatsappMessage.vue";

const coreMetrics = ref([
    { value: "+7", label: "Años de Trayectoria" },
    { value: "100%", label: "Mentalidad Autodidacta" },
    { value: "+15", label: "Sistemas Desplegados" },
    { value: "01", label: "Pasión: Crear código" },
]);

const softSkills = ref([
    {
        title: "Comunicación Asertiva",
        desc: "Capacidad para traducir requerimientos de negocio complejos en especificaciones técnicas claras y fluidas.",
    },
    {
        title: "Sinergia y Colaboración",
        desc: "Integración natural en equipos multidisciplinarios bajo metodologías ágiles, impulsando objetivos comunes.",
    },
    {
        title: "Asimilación Veloz",
        desc: "Mentalidad autodidacta con una curva de aprendizaje acelerada para dominar nuevos entornos técnicos de manera eficiente.",
    },
    {
        title: "Resolución Autónoma",
        desc: "Enfoque analítico orientado a identificar cuellos de botella y diseñar soluciones lógicas óptimas.",
    },
    {
        title: "Trabajo en Equipo",
        desc: "Coordinación y apoyo constante dentro del flujo de desarrollo, priorizando la cohesión y el éxito del proyecto colectivamente.",
    },
    {
        title: "Aprendizaje Rápido",
        desc: "Flexibilidad cognitiva para absorber metodologías, estándares y arquitecturas dinámicas con mínima fricción.",
    },
]);

const projectSectors = ref([
    {
        name: "Gestión Empresarial y Administrativa",
        details:
            "Arquitectura de plataformas robustas orientadas a optimizar flujos internos, control operacional y administración de recursos.",
    },
    {
        name: "Reclutamiento y Selección",
        details:
            "Sistemas especializados para la gestión, filtrado, seguimiento y contratación automatizada de talento humano.",
    },
    {
        name: "Agencias de Envíos y Logística",
        details:
            "Desarrollo de módulos de rastreo, despacho de mercancía y control logístico de alta precisión.",
    },
    {
        name: "Sector Gastronómico / Restaurantes",
        details:
            "Soluciones a la medida para la automatización de pedidos, control de inventarios y comandas operacionales.",
    },
]);
</script>

<template>
    <section
        id="profile_information"
        class="relative overflow-hidden bg-slate-950 border-b border-slate-900/60"
    >
        <div class="relative py-12 sm:py-16 lg:py-20">
            <div
                class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-40"
            ></div>

            <div
                class="absolute top-1/3 right-10 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"
            ></div>
            <div
                class="absolute bottom-1/3 left-10 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"
            ></div>

            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start"
                >
                    <div class="lg:col-span-12 space-y-8 text-left">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 bg-cyan-500/10 border border-cyan-500/20 rounded-full"
                        >
                            <span class="flex h-1.5 w-1.5 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"
                                ></span>
                                <span
                                    class="relative inline-flex rounded-full h-1.5 w-1.5 bg-blue-400"
                                ></span>
                            </span>
                            <span
                                class="font-mono text-[10px] tracking-widest text-blue-400 font-bold uppercase"
                                >Profile_Overview</span
                            >
                        </div>

                        <div
                            class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
                        >
                            <div class="lg:col-span-7 space-y-6">
                                <div class="space-y-4">
                                    <h2
                                        class="text-xs font-mono font-bold tracking-widest text-slate-500 uppercase"
                                    >
                                        // INTRODUCCIÓN PROFESIONAL
                                    </h2>
                                    <h1
                                        class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-none text-pretty"
                                    >
                                        Steven Manyoma R.
                                        <span
                                            class="block text-2xl sm:text-3xl lg:text-4xl mt-3 font-bold bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent"
                                        >
                                            Full Stack Developer
                                        </span>
                                    </h1>
                                </div>

                                <div
                                    class="space-y-6 text-sm sm:text-base text-slate-400 text-pretty leading-relaxed font-normal"
                                >
                                    <p>
                                        Para mí, el desarrollo de software va
                                        más allá de escribir código; es la
                                        habilidad de transformar ideas complejas
                                        en ecosistemas digitales robustos y
                                        escalables. Me especializo en desglosar
                                        conceptos abstractos y estructurar
                                        soluciones a medida desde cero,
                                        garantizando que cada línea de código se
                                        traduzca en un software eficiente,
                                        lógico y alineado con los objetivos del
                                        mundo real.
                                    </p>
                                    <p>
                                        Con más de 7 años de trayectoria en la
                                        industria, me he especializado en la
                                        ingeniería de software a la medida. Mi
                                        enfoque técnico me permite equilibrar
                                        con precisión la construcción de
                                        arquitecturas backend estables, seguras
                                        y escalables con el despliegue de
                                        interfaces frontend fluidas, intuitivas
                                        y de alto rendimiento. Mi objetivo es
                                        asegurar que cada línea de código
                                        contribuya directamente al rendimiento
                                        global y la estabilidad de la
                                        plataforma.
                                    </p>
                                    <p>
                                        Mi formación combina tres niveles clave:
                                        Técnico en Sistemas, Técnico en
                                        Programación y Tecnólogo en Análisis y
                                        Desarrollo de Software. Esta trayectoria
                                        me permite entender la tecnología desde
                                        su infraestructura física hasta la
                                        arquitectura de soluciones web robustas,
                                        escalables y a la medida.
                                    </p>
                                </div>
                            </div>

                            <div class="lg:col-span-5 space-y-6">
                                <div
                                    class="bg-slate-900/40 border border-slate-800/80 rounded-xl p-5 font-mono text-xs text-slate-400 backdrop-blur-md shadow-[0_20px_50px_rgba(0,0,0,0.5)] border-t-blue-500/30"
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
                                            >identity_manifest.json</span
                                        >
                                    </div>

                                    <div class="space-y-4">
                                        <div class="space-y-1">
                                            <p class="text-cyan-400">
                                                <span class="text-slate-600"
                                                    >{</span
                                                >
                                            </p>
                                            <p class="pl-4">
                                                <span class="text-blue-400"
                                                    >"developer"</span
                                                >:
                                                <span class="text-amber-300"
                                                    >"Steven Manyoma
                                                    Rosero"</span
                                                >,
                                            </p>
                                            <p class="pl-4">
                                                <span class="text-blue-400"
                                                    >"specialty"</span
                                                >:
                                                <span class="text-amber-300"
                                                    >"Custom Software
                                                    Engineering"</span
                                                >,
                                            </p>
                                            <p class="pl-4">
                                                <span class="text-blue-400"
                                                    >"learning_mode"</span
                                                >:
                                                <span class="text-amber-300"
                                                    >"Autodidact /
                                                    Continuous"</span
                                                >,
                                            </p>
                                            <p class="pl-4">
                                                <span class="text-blue-400"
                                                    >"core_philosophy"</span
                                                >:
                                                <span class="text-amber-300"
                                                    >"Convert ideas into
                                                    production-ready
                                                    platforms"</span
                                                >
                                            </p>
                                            <p class="text-cyan-400">
                                                <span class="text-slate-600"
                                                    >}</span
                                                >
                                            </p>
                                        </div>

                                        <div
                                            class="pt-2 border-t border-slate-800/60 space-y-1"
                                        >
                                            <p class="text-slate-500">
                                                // Estado y adaptabilidad:
                                            </p>
                                            <p class="text-emerald-400">
                                                <span class="text-slate-600"
                                                    >></span
                                                >
                                                High adaptability rate detected
                                            </p>
                                            <p class="text-emerald-400">
                                                <span class="text-slate-600"
                                                    >></span
                                                >
                                                Multi-framework compilation
                                                stable
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div
                                        v-for="metric in coreMetrics"
                                        :key="metric.label"
                                        class="relative px-6 py-5 rounded-xl bg-slate-900/20 border border-slate-900/80 backdrop-blur-sm flex flex-col justify-center gap-1 group hover:border-cyan-500/20 transition-all duration-300"
                                    >
                                        <div
                                            class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400 group-hover:from-white group-hover:to-cyan-400 transition-all duration-300 font-mono"
                                        >
                                            {{ metric.value }}
                                        </div>
                                        <div
                                            class="text-[10px] font-mono text-slate-500 tracking-wider font-bold uppercase group-hover:text-slate-300 transition-colors"
                                        >
                                            {{ metric.label }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-8 border-t border-slate-900/60"
                        >
                            <div class="space-y-4">
                                <h3
                                    class="text-xs font-mono font-bold tracking-wider text-slate-500 uppercase"
                                >
                                    // HABILIDADES BLANDAS
                                </h3>
                                <div class="space-y-4">
                                    <div
                                        v-for="skill in softSkills"
                                        :key="skill.title"
                                        class="p-4 bg-slate-900/30 border border-slate-900 rounded-xl backdrop-blur-sm hover:border-slate-800 transition-colors duration-300"
                                    >
                                        <h4
                                            class="text-sm font-bold text-slate-200 font-mono mb-1 flex items-center gap-2"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 bg-cyan-400 rounded-full"
                                            ></span>
                                            {{ skill.title }}
                                        </h4>
                                        <p
                                            class="text-xs text-slate-400 leading-relaxed"
                                        >
                                            {{ skill.desc }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3
                                    class="text-xs font-mono font-bold tracking-wider text-slate-500 uppercase"
                                >
                                    // EXPERIENCIA EN PROYECTOS
                                </h3>
                                <div class="space-y-4">
                                    <div
                                        v-for="project in projectSectors"
                                        :key="project.name"
                                        class="p-4 bg-slate-900/30 border border-slate-900 rounded-xl backdrop-blur-sm hover:border-slate-800 transition-colors duration-300"
                                    >
                                        <h4
                                            class="text-sm font-bold text-slate-200 font-mono mb-1 flex items-center gap-2"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 bg-blue-500 rounded-full"
                                            ></span>
                                            {{ project.name }}
                                        </h4>
                                        <p
                                            class="text-xs text-slate-400 leading-relaxed"
                                        >
                                            {{ project.details }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <h3
                                    class="text-xs font-mono font-bold tracking-wider text-slate-500 uppercase"
                                >
                                    // FILOSOFÍA DE TRABAJO
                                </h3>
                                <div class="space-y-4">
                                    <div
                                        class="p-4 bg-slate-900/30 border border-slate-900 rounded-xl backdrop-blur-sm hover:border-slate-800 transition-colors duration-300"
                                    >
                                        <h4
                                            class="text-sm font-bold text-slate-200 font-mono mb-1 flex items-center gap-2"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 bg-emerald-500 rounded-full"
                                            ></span>
                                            Código Escalable
                                        </h4>
                                        <p
                                            class="text-xs text-slate-400 leading-relaxed"
                                        >
                                            Planificación estructural orientada
                                            al crecimiento modular del sistema,
                                            minimizando la deuda técnica a largo
                                            plazo.
                                        </p>
                                    </div>
                                    <div
                                        class="p-4 bg-slate-900/30 border border-slate-900 rounded-xl backdrop-blur-sm hover:border-slate-800 transition-colors duration-300"
                                    >
                                        <h4
                                            class="text-sm font-bold text-slate-200 font-mono mb-1 flex items-center gap-2"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 bg-emerald-500 rounded-full"
                                            ></span>
                                            Optimización de Procesos
                                        </h4>
                                        <p
                                            class="text-xs text-slate-400 leading-relaxed"
                                        >
                                            Reducción drástica de cuellos de
                                            botella operativos automatizando
                                            flujos de trabajo críticos de la
                                            empresa.
                                        </p>
                                    </div>
                                    <div
                                        class="p-4 bg-slate-900/30 border border-slate-900 rounded-xl backdrop-blur-sm hover:border-slate-800 transition-colors duration-300"
                                    >
                                        <h4
                                            class="text-sm font-bold text-slate-200 font-mono mb-1 flex items-center gap-2"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 bg-emerald-500 rounded-full"
                                            ></span>
                                            Seguridad Aplicada
                                        </h4>
                                        <p
                                            class="text-xs text-slate-400 leading-relaxed"
                                        >
                                            Implementación rigurosa de
                                            estándares de protección de datos y
                                            control estricto de accesos a nivel
                                            de arquitectura.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <ButtonWhatsappMessage class="w-full sm:w-auto" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
