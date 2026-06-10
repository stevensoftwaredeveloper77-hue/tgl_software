<script lang="ts" setup>
defineProps({
    text: String,
});
</script>

<template>
    <button
        class="group px-8 py-4 border-2 border-slate-600 hover:border-blue-500 rounded-xl font-semibold text-white hover:text-blue-400 transition-all duration-300 hover:scale-105 backdrop-blur-sm"
    >
        <span class="flex items-center gap-2">
            {{ text }}
            <i class="fa-solid fa-arrow-down"></i>
        </span>
    </button>
</template>
