<template>
    <Head title="TGL SOFT" />
    <VirtualProfileChat />
    <div class="transparent text-black/50">
        <div
            class="relative flex min-h-screen flex-col items-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full">
                <header class="flex justify-end items-center">
                    <NavBarAnimated :navLinks="navLinksProfile" />
                </header>

                <main>
                    <ProfileInitalSection />

                    <SectionSeparator />

                    <TecnologiesStack />

                    <SectionSeparator />

                    <ServiceProfileSection />

                    <SectionSeparator />

                    <ProjectSection />

                    <SectionSeparator />

                    <AppointmentForm />

                    <SectionSeparator />
                </main>
            </div>
        </div>
    </div>
    <FooterProfileSection />
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Tooltip from "@/Components/Tooltip.vue";
import { navLinksProfile } from "@/Features/siteTexts.ts";
import VirtualProfileChat from "@/AI/VIrtualProfileChat.vue";
import NavBarAnimated from "@/Components/NavBarAnimated.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import RequestForm from "@/Pages/Guest/Request/RequestForm.vue";
import SectionSeparator from "@/Components/SectionSeparator.vue";
import ProjectSection from "@/Pages/Guest/Home/ProjectSection.vue";
import InitialSection from "@/Pages/Guest/Home/InitialSection.vue";
import TecnologiesStack from "@/Pages/Guest/Home/TecnologiesStack.vue";
import FooterProfileSection from "@/Components/FooterProfileSection.vue";
import CompanyInformation from "@/Pages/Guest/Home/CompanyInformation.vue";
import AppointmentForm from "@/Pages/Guest/Appointment/AppointmentForm.vue";
import ProfileInitalSection from "@/Pages/Guest/Home/ProfileInitialSection.vue";
import ServiceProfileSection from "@/Pages/Guest/Service/ServiceProfileSection.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>
