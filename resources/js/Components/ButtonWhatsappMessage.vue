<script setup>
defineProps({
    text: {
        type: String,
        default: "Enviar Mensaje",
    },
});

const whatsappUrl = "https://wa.me/573145970404";
</script>

<template>
    <a
        :href="whatsappUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-transparent text-slate-300 hover:text-white font-bold text-sm rounded-xl border border-slate-800 hover:border-slate-700 transition-all duration-300 backdrop-blur-sm bg-slate-900/40 group decoration-transparent"
    >
        <i
            class="fa-brands fa-whatsapp text-base transition-colors group-hover:text-[#25D366]"
        ></i>
        <span>{{ text }}</span>
    </a>
</template>
