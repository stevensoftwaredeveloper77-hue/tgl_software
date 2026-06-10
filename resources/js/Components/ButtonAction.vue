<script lang="ts" setup>
defineProps({
    text: String,
});
</script>

<template>
    <button
        class="group relative px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl font-semibold text-white shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 hover:scale-105 overflow-hidden"
    >
        <span class="relative z-10 flex items-center gap-2">
            {{ text }}
            <i class="fa-solid fa-arrow-right"></i>
        </span>
        <div
            class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
        ></div>
    </button>
</template>
