<script setup lang="ts">
import { router, Link } from "@inertiajs/vue3";
import Tooltip from "@/Components/Tooltip.vue";
import { ref, onMounted, onUnmounted } from "vue";
import { navigateToSection } from "@/Actions/navigation.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const emit = defineEmits<{
    navigate: [section: string];
}>();

defineProps({
    navLinks: Array,
    isTglSection: Boolean,
});

const isScrolled = ref(false);
const isMobileMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
    <nav
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
        :class="[
            isScrolled
                ? 'bg-white/90 backdrop-blur-lg shadow-lg shadow-slate-900/5 py-3'
                : 'bg-slate-900 opacity-75 border-b-black py-2 ',
        ]"
    >
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <button
                    @click="navigateToSection('home')"
                    class="flex items-center gap-3 group"
                >
                    <div
                        class="relative w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300"
                        :class="
                            isScrolled
                                ? 'bg-gradient-to-br from-blue-500 to-cyan-500'
                                : 'bg-white/10 backdrop-blur-sm border border-white/20'
                        "
                    >
                        <svg
                            class="w-6 h-6 text-white"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"
                            />
                        </svg>
                        <div
                            class="absolute inset-0 rounded-xl bg-gradient-to-br from-blue-400 to-cyan-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10 blur-lg"
                        ></div>
                    </div>
                    <span
                        v-if="isTglSection"
                        class="text-xl font-bold transition-colors duration-300"
                        :class="isScrolled ? 'text-slate-900' : 'text-white'"
                    >
                        <ApplicationLogo class="w-32"></ApplicationLogo>
                    </span>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-1">
                    <button
                        v-for="link in navLinks"
                        :key="link.id"
                        @click="navigateToSection(link.id)"
                        class="relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-300 group"
                        :class="
                            isScrolled
                                ? 'text-slate-600 hover:text-blue-600 hover:bg-blue-50'
                                : 'text-slate-300 hover:text-white hover:bg-white/10'
                        "
                    >
                        {{ link.label }}
                        <span
                            class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-blue-500 group-hover:w-1/2 transition-all duration-300"
                        ></span>
                    </button>

                    <!-- Whatsapp contac -->
                    <Tooltip
                        v-if="isTglSection"
                        content="Comunicate con nosotros"
                    >
                        <a
                            href="https://wa.me/573145970404?text=Estoy%20interesado%20en%20comunicarme%20con%20el%20TGL%20SOFT."
                            class="bg-[#25d366] text-[22px] rounded-full text-white items-center px-1"
                            target="_blank"
                        >
                            <i class="fa fa-whatsapp"></i
                        ></a>
                    </Tooltip>
                </div>

                <!-- Dashboard route -->
                <!-- <Link
          :href="route('dashboard')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
      >
          <Tooltip content="Sesión iniciada">
              <i class="fa-solid fa-right-to-bracket"></i>
          </Tooltip>
      </Link> -->

                <!-- Log In -->
                <Link
                    v-if="isTglSection"
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    <Tooltip content="Iniciar sesión">
                        <i class="fa-solid fa-right-to-bracket text-xl"></i>
                    </Tooltip>
                </Link>

                <!-- Mobile Menu Button -->
                <button
                    @click="isMobileMenuOpen = !isMobileMenuOpen"
                    class="md:hidden p-2 rounded-lg transition-colors"
                    :class="
                        isScrolled
                            ? 'text-slate-700 hover:bg-slate-100'
                            : 'text-white hover:bg-white/10'
                    "
                >
                    <svg
                        v-if="!isMobileMenuOpen"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                    <svg
                        v-else
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 -translate-y-4"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-4"
        >
            <div
                v-if="isMobileMenuOpen"
                class="md:hidden absolute top-full left-0 right-0 bg-white shadow-xl border-t border-slate-100"
            >
                <div class="container mx-auto px-4 py-4 space-y-1">
                    <button
                        v-for="link in navLinks"
                        :key="link.id"
                        @click="navigateToSection(link.id)"
                        class="w-full text-left px-4 py-3 text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition-colors"
                    >
                        {{ link.label }}
                    </button>
                </div>
            </div>
        </transition>
    </nav>
</template>
