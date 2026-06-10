<script setup lang="ts">
import { projects } from "@/Features/siteTexts.ts";
import { colorClassesProj } from "@/Features/siteClass.js";

const openProject = (url?: string) => {
    if (url) {
        window.open(url, "_blank");
    }
};
</script>

<template>
    <section
        id="projects"
        class="relative py-16 bg-slate-950 w-full overflow-hidden border-t border-slate-900"
    >
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#0f172a_1px,transparent_1px),linear-gradient(to_bottom,#0f172a_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_60%,transparent_100%)] opacity-40 pointer-events-none z-0"
        ></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-14">
                <div class="flex items-center gap-2 mb-3">
                    <span
                        class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"
                    ></span>
                    <span
                        class="font-mono text-xs text-cyan-400 font-bold uppercase tracking-widest"
                        >// CORE_PORTFOLIO_OUTPUT</span
                    >
                </div>
                <h2
                    class="text-3xl font-extrabold text-slate-100 tracking-tight sm:text-4xl"
                >
                    Proyectos Desarrollados
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500"
                        >a la Medida</span
                    >
                </h2>
                <p
                    class="mt-4 max-w-2xl text-sm text-slate-300 leading-relaxed"
                >
                    Explora una selección de sistemas web estables, aplicaciones
                    SaaS de alta complejidad y arquitecturas desplegadas con
                    total precisión de rendimiento.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="project in projects"
                    :key="project.id"
                    class="group relative bg-slate-900/60 backdrop-blur-md rounded-xl border border-slate-800/80 transition-all duration-500 flex flex-col justify-between overflow-hidden shadow-2xl p-6 sm:p-7 hover:-translate-y-1.5"
                    :class="[
                        colorClassesProj[project.color]?.border ||
                            'hover:border-slate-750',
                        colorClassesProj[project.color]?.glow || '',
                    ]"
                >
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <span
                                class="font-mono text-[9px] text-slate-500 font-bold tracking-wider group-hover:text-slate-400 transition-colors"
                            >
                                SYS_PROJ_0{{ project.id }}
                            </span>

                            <div class="flex items-center gap-1.5">
                                <span
                                    v-if="project.status === 'LIVE'"
                                    class="inline-flex items-center gap-1 px-2 py-0.5 text-[9px] font-mono font-extrabold uppercase rounded-md border border-emerald-500/30 bg-emerald-500/10 text-emerald-400"
                                >
                                    ● Live
                                </span>
                                <span
                                    v-else
                                    class="inline-flex items-center gap-1 px-2 py-0.5 text-[9px] font-mono font-extrabold uppercase rounded-md border border-purple-500/30 bg-purple-500/10 text-purple-400/90 tracking-wide"
                                >
                                    ○ Alpha_Next
                                </span>
                            </div>
                        </div>

                        <span
                            class="text-[11px] font-mono font-medium text-slate-400 uppercase tracking-wide block mb-1"
                        >
                            {{ project.category }}
                        </span>
                        <h3
                            class="text-lg font-bold text-slate-100 group-hover:text-cyan-400 transition-colors duration-300 mb-3"
                        >
                            {{ project.title }}
                        </h3>

                        <p
                            class="text-slate-300 text-xs sm:text-sm leading-relaxed font-normal mb-6"
                        >
                            {{ project.description }}
                        </p>
                    </div>

                    <div>
                        <div class="flex flex-wrap gap-1.5 mb-5">
                            <span
                                v-for="(tag, index) in project.tags"
                                :key="index"
                                class="text-[10px] font-mono font-semibold px-2 py-0.5 rounded bg-slate-950 border border-slate-800 text-slate-300 group-hover:border-slate-700 group-hover:text-slate-200 transition-all"
                            >
                                {{ tag }}
                            </span>
                        </div>

                        <div v-if="project.status === 'LIVE' && project.url">
                            <button
                                @click="openProject(project.url)"
                                class="w-full py-2 px-4 rounded-xl text-xs font-bold transition-all duration-300 flex items-center justify-center gap-2 border border-slate-800 bg-slate-950/40 text-slate-200 hover:bg-slate-950 hover:text-white hover:border-cyan-500/40 shadow-inner"
                            >
                                <span>Explorar Despliegue</span>
                                <svg
                                    class="w-3.5 h-3.5 transform transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div v-else>
                            <div
                                class="w-full py-2 px-4 rounded-xl text-xs font-mono font-bold text-center border border-slate-900/60 bg-slate-950/40 text-slate-600 select-none cursor-not-allowed"
                            >
                                [ STAGE_COMPILING_LOG ]
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
