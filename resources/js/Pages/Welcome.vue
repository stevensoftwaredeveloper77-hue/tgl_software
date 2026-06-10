<template>
    <Head title="TGL SOFT" />
    <div class="transparent text-black/50">
        <div
            class="relative flex min-h-screen flex-col items-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full">
                <header class="flex justify-end items-center">
                    <NavBarAnimated
                        :navLinks="navLinksTgl"
                        :isTglSection="true"
                    />
                </header>

                <main>
                    <InitialSection />

                    <SectionSeparator />

                    <ServiceSection />

                    <SectionSeparator />

                    <CompanyInformation />

                    <SectionSeparator />

                    <TecnologiesStack />

                    <SectionSeparator />

                    <AppointmentForm />

                    <SectionSeparator />

                    <RequestForm />
                </main>
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>

<script setup>
import Footer from "@/Components/Footer.vue";
import { Head, Link } from "@inertiajs/vue3";
import Tooltip from "@/Components/Tooltip.vue";
import { navLinksTgl } from "@/Features/siteTexts.ts";
import NavBarAnimated from "@/Components/NavBarAnimated.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import RequestForm from "@/Pages/Guest/Request/RequestForm.vue";
import SectionSeparator from "@/Components/SectionSeparator.vue";
import InitialSection from "@/Pages/Guest/Home/InitialSection.vue";
import ServiceSection from "@/Pages/Guest/Service/ServiceSection.vue";
import TecnologiesStack from "@/Pages/Guest/Home/TecnologiesStack.vue";
import CompanyInformation from "@/Pages/Guest/Home/CompanyInformation.vue";
import AppointmentForm from "@/Pages/Guest/Appointment/AppointmentForm.vue";

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
