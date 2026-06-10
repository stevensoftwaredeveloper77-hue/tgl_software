<script setup lang="ts">
import { ref, onMounted } from "vue";
import VirtualChat from "@/AI/VirtualChat.vue";
import ButtonAction from "@/Components/ButtonAction.vue";
import ButtonExplorer from "@/Components/ButtonExplorer.vue";
import {
    scrollToAppointmentSection,
    scrollToServicesSection,
} from "@/Actions/navigation.js";

const typedText = ref("");
const currentIndex = ref(0);
const isVisible = ref(false);
const fullText = "Nosotros lo desarrollamos.";

onMounted(() => {
    isVisible.value = true;
    typeWriter();
});

const typeWriter = () => {
    if (currentIndex.value < fullText.length) {
        typedText.value += fullText.charAt(currentIndex.value);
        currentIndex.value++;
        setTimeout(typeWriter, 100);
    }
};
</script>

<template>
    <section
        id="home"
        class="w-full min-h-screen bg-cover bg-center bg-no-repeat relative flex items-center"
        style="background-image: url(&quot;/img/bg_software.png&quot;)"
    >
        <!-- Code brackets decoration -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-32 right-20 text-blue-500/10 text-9xl font-mono hidden lg:block select-none"
            >
                &lt;/&gt;
            </div>
            <div
                class="absolute bottom-32 left-20 text-cyan-500/10 text-8xl font-mono hidden lg:block select-none"
            >
                { }
            </div>
            <div
                class="absolute top-32 right-20 text-cyan-500/10 text-8xl font-mono hidden lg:block select-none"
            >
                { }
            </div>
        </div>

        <!-- Main content -->
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="min-h-screen flex flex-col justify-center py-20">
                <!-- Top badge -->
                <div
                    class="flex justify-center mb-8 transition-all duration-1000"
                    :class="
                        isVisible
                            ? 'opacity-100 translate-y-0'
                            : 'opacity-0 -translate-y-10'
                    "
                ></div>

                <!-- Main heading -->
                <div class="text-center max-w-4xl mx-auto">
                    <h1
                        class="text-2xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight transition-all duration-1000 delay-200"
                        :class="
                            isVisible
                                ? 'opacity-100 translate-y-0'
                                : 'opacity-0 translate-y-10'
                        "
                    >
                        <span class="text-white">Tú lo imaginas,</span>
                        <br />
                        <span class="relative">
                            <span
                                class="bg-gradient-to-r from-blue-300 via-cyan-400 to-blue-600 bg-clip-text text-transparent"
                            >
                                {{ typedText }}
                            </span>
                            <span class="animate-pulse text-blue-400">|</span>
                        </span>
                    </h1>

                    <p
                        class="mt-6 text-lg sm:text-xl text-slate-400 max-w-4xl mx-auto text-center bg-slate-950/40 backdrop-blur-md p-6 rounded-2xl border border-white/5"
                        :class="
                            isVisible
                                ? 'opacity-100 translate-y-0'
                                : 'opacity-0 translate-y-10'
                        "
                    >
                        Soluciones digitales a la medida diseñadas para impulsar
                        el crecimiento de tu negocio, integrando plataformas web
                        robustas y soluciones avanzadas con Inteligencia
                        Artificial. Convertimos tus desafíos en ventajas
                        tecnológicas.
                    </p>

                    <!-- Button Actions -->
                    <div
                        class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4 transition-all duration-1000 delay-500"
                        :class="
                            isVisible
                                ? 'opacity-100 translate-y-0'
                                : 'opacity-0 translate-y-10'
                        "
                    >
                        <ButtonAction
                            text="Iniciar Proyecto"
                            @click="scrollToAppointmentSection()"
                        />

                        <ButtonExplorer
                            text="Ver Servicios"
                            @click="scrollToServicesSection()"
                        />
                    </div>
                </div>
            </div>
        </div>
        <VirtualChat />
    </section>
</template>

<style scoped>
@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}
</style>
