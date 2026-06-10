<template>
    <nav
        class="flex fixed z-10 mt-20 gap-6 bg-tgl-blue opacity-90 border-b-[2px] border-tgl-white shadow-tgl-black h-16 w-[100%] sm:w-[80%] justify-end rounded-none sm:rounded-l-full items-center text-sm sm:text-lg text-tgl-white font-semibold p-4 shadow-md"
    >
        <!-- Logo -->
        <Link href="/">
            <ApplicationLogo class="w-20 h-12 fill-current text-gray-500" />
        </Link>

        <!-- Contact Us -->
        <Link href="/contact">
            <h1 :class="navLinkClass">Contactanos</h1>
        </Link>

        <!-- Whatsapp contac -->
        <Tooltip content="Comunicate con nosotros">
            <a
                href="https://wa.me/573145970404?text=Estoy%20interesado%20en%20comunicarme%20con%20el%20TGL%20SOFT."
                class="bg-[#25d366] text-[22px] rounded-full text-white items-center px-1"
                target="_blank"
            >
                <i class="fa fa-whatsapp"></i
            ></a>
        </Tooltip>
        <!-- Dashboard route -->
        <Link
            v-if="$page.props.auth.user"
            :href="route('dashboard')"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            <Tooltip content="Sesión iniciada">
                <i class="fa-solid fa-right-to-bracket"></i>
            </Tooltip>
        </Link>

        <template v-else>
            <div class="flex justify-end">
                <!-- Log In -->
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    <Tooltip content="Iniciar sesión">
                        <i class="fa-solid fa-right-to-bracket text-xl"></i>
                    </Tooltip>
                </Link>
            </div>
        </template>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Tooltip from "@/Components/Tooltip.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const navLinkClass = "hover:scale-110 hover:text-cnvc-greenLight";
</script>
