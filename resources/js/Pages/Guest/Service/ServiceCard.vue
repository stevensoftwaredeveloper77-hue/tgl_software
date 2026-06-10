<script setup lang="ts">
import { h } from "vue";
import { colorClassesCard } from "@/Features/siteClass.js";

interface ServiceCard {
    id: number;
    title: string;
    description: string;
    icon: string;
    color: "blue" | "cyan" | "green" | "purple" | "orange" | "slate";
    features: string[];
    popular?: boolean;
}

defineProps<{
    service: ServiceCard;
}>();

const emit = defineEmits<{
    select: [id: number];
}>();

const iconComponents: Record<string, any> = {
    code: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4",
                }),
            ],
        ),
    lightbulb: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z",
                }),
            ],
        ),
    support: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z",
                }),
            ],
        ),
    robot: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z",
                }),
                h("circle", { cx: "9", cy: "9", r: "1", fill: "currentColor" }),
                h("circle", {
                    cx: "15",
                    cy: "9",
                    r: "1",
                    fill: "currentColor",
                }),
            ],
        ),
    mobile: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z",
                }),
            ],
        ),
    database: () =>
        h(
            "svg",
            {
                fill: "none",
                stroke: "currentColor",
                "stroke-width": "2",
                viewBox: "0 0 24 24",
                class: "w-6 h-6",
            },
            [
                h("path", {
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    d: "M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4",
                }),
            ],
        ),
};

const getIconComponent = (iconName: string) => {
    const normalized = iconName.toLowerCase().trim();
    return iconComponents[normalized] || iconComponents["database"];
};

const contactWhatsApp = (serviceTitle: string) => {
    const phoneNumber = "573145970404";
    const baseMessage = `¡Hola! Me interesa el servicio de "${serviceTitle}" para mi negocio. ¿Me podrías brindar más información?`;
    window.open(
        `https://wa.me/${phoneNumber}?text=${encodeURIComponent(baseMessage)}`,
        "_blank",
    );
};
</script>

<template>
    <div
        class="group relative bg-slate-950/40 backdrop-blur-md rounded-xl border transition-all duration-500 cursor-pointer overflow-hidden flex flex-col justify-between shadow-xl hover:-translate-y-2"
        :class="[
            colorClassesCard[service.color]?.border || 'border-slate-800',
            colorClassesCard[service.color]?.glow || '',
        ]"
        @click="emit('select', service.id)"
    >
        <div
            class="absolute top-0 left-0 right-0 h-[2px] bg-slate-950 overflow-hidden"
        >
            <div
                class="h-full w-0 group-hover:w-full transition-all duration-700 bg-gradient-to-r from-transparent via-current to-transparent"
                :class="
                    colorClassesCard[service.color]?.text || 'text-cyan-400'
                "
            ></div>
        </div>

        <div class="p-6 sm:p-8 relative">
            <div class="absolute top-6 right-6 flex items-center gap-2">
                <span
                    class="font-mono text-[9px] text-slate-500 font-bold uppercase tracking-wider group-hover:text-slate-400 transition-colors"
                >
                    SYS_MOD_0{{ service.id }}
                </span>
                <span
                    v-if="service.popular"
                    class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[9px] font-mono font-extrabold uppercase rounded border animate-pulse"
                    :class="colorClassesCard[service.color]?.badge || ''"
                >
                    ● Pop
                </span>
            </div>

            <div
                class="w-12 h-12 rounded-lg flex items-center justify-center mb-6 border transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 shadow-md"
                :class="[
                    colorClassesCard[service.color]?.iconBg ||
                        'bg-slate-900 border-slate-800',
                    colorClassesCard[service.color]?.iconText ||
                        'text-cyan-400',
                ]"
            >
                <component :is="getIconComponent(service.icon)" />
            </div>

            <h3
                class="text-lg font-bold text-slate-100 mb-2 group-hover:text-cyan-400 transition-colors duration-300"
            >
                {{ service.title }}
            </h3>

            <p
                class="text-slate-300 text-xs sm:text-sm mb-6 leading-relaxed font-normal"
            >
                {{ service.description }}
            </p>

            <ul class="space-y-2.5">
                <li
                    v-for="(feature, index) in service.features"
                    :key="index"
                    class="flex items-start gap-2.5 text-xs text-slate-300 font-medium"
                >
                    <span
                        class="font-mono font-bold text-[10px] mt-0.5"
                        :class="
                            colorClassesCard[service.color]?.text ||
                            'text-cyan-400'
                        "
                    >
                        //
                    </span>
                    <span
                        class="hover:text-white transition-colors duration-200"
                    >
                        {{ feature }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="p-6 pt-0">
            <button
                @click.stop="contactWhatsApp(service.title)"
                class="w-full py-2.5 px-4 rounded-xl text-xs font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:scale-[1.02]"
                :class="
                    colorClassesCard[service.color]?.btn ||
                    'bg-cyan-600 text-slate-950'
                "
            >
                <span>Solicitar Servicio</span>
                <svg
                    class="w-4 h-4 transform transition-transform group-hover:translate-x-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                        d="M17 8l4 4m0 0l-4 4m4-4H3"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
