<script setup lang="ts">
interface Props {
    variant?: "default" | "circuit" | "diagonal" | "dots";
}

withDefaults(defineProps<Props>(), {
    variant: "default",
});
</script>

<template>
    <div
        class="relative h-16 sm:h-24 overflow-visible bg-slate-950 w-full select-none pointer-events-none"
    >
        <div
            class="absolute bottom-0 left-0 right-0 h-[30px] sm:h-[45px] bg-slate-900/40 border-t border-blue-500/30 backdrop-blur-md z-20"
            style="
                clip-path: polygon(
                    0 0,
                    35% 0,
                    38% 100%,
                    62% 100%,
                    65% 0,
                    100% 0,
                    100% 100%,
                    0 100%
                );
            "
        >
            <div
                class="absolute inset-0 w-full h-[1px] bg-gradient-to-r from-transparent via-cyan-400/60 to-transparent"
            ></div>
        </div>

        <div
            class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-blue-500 to-transparent z-10 shadow-[0_0_15px_rgba(59,130,246,0.6)]"
        ></div>

        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[250px] sm:w-[500px] h-[40px] sm:h-[60px] bg-blue-500/[0.06] rounded-full blur-2xl z-0"
        ></div>
        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[180px] sm:w-[350px] h-[20px] bg-cyan-500/[0.04] rounded-full blur-xl z-0"
        ></div>

        <div
            class="absolute bottom-0 left-1/2 -translate-x-1/2 flex items-center justify-center z-30 mb-[2px] sm:mb-[6px]"
        >
            <div
                class="h-[1px] w-8 sm:w-16 bg-gradient-to-r from-transparent to-cyan-500/50 hidden xs:block"
            ></div>

            <div
                class="flex items-center gap-2 px-3 py-1 bg-slate-950 border border-cyan-400/40 rounded-md shadow-[0_0_15px_rgba(34,211,238,0.25)]"
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
                    class="text-[8px] sm:text-[9px] font-mono tracking-widest text-slate-400 font-extrabold uppercase"
                    >TGL_LINK //</span
                >
                <div class="w-1 h-2 bg-blue-500/80 rounded-sm"></div>
            </div>

            <div
                class="h-[1px] w-8 sm:w-16 bg-gradient-to-l from-transparent to-cyan-500/50 hidden xs:block"
            ></div>
        </div>

        <div
            class="absolute top-2 left-8 font-mono text-[9px] text-slate-500/30 tracking-wider hidden lg:block"
        >
            LOC_0x71 // GRID_ACTIVE
        </div>
        <div
            class="absolute top-2 right-8 font-mono text-[9px] text-slate-500/30 tracking-wider hidden lg:block"
        >
            SYS_ALIGN // SEC_02
        </div>
    </div>
</template>
