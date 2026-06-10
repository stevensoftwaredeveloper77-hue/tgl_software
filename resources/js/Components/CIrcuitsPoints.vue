<template>
    <div class="absolute bottom-0 left-0 right-0 w-full pointer-events-none">
        <div
            class="absolute bottom-0 left-0 right-0 h-px bg-blue-500/20 z-20"
        ></div>

        <svg
            class="w-full h-16 text-cyan-500/20 block"
            viewBox="0 0 1440 64"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            preserveAspectRatio="none"
        >
            <path d="M0 48 H220 L260 20 H500 L520 4" stroke-dasharray="4 4" />
            <circle
                cx="260"
                cy="20"
                r="3"
                fill="currentColor"
                class="animate-pulse"
            />

            <path d="M400 64 L440 32 H800 L820 52 H980" />
            <circle cx="800" cy="32" r="2.5" fill="currentColor" />

            <path d="M1440 36 H1180 L1140 12 H900" />
            <circle cx="1180" cy="36" r="3" fill="currentColor" />
        </svg>
    </div>
</template>
