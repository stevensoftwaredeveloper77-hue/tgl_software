<template>
  <div class="min-h-screen flex flex-col">
    <AppHeader />
    <main class="flex-1">
      <HeroSection />
      <HowItWorks />
      <FeaturesSection />
      <RegisterCTA />
    </main>
    <AppFooter />
  </div>
</template>

<script setup>
import AppHeader from './Modules/AppHeader.vue'
import AppFooter from './Modules/AppFooter.vue'
import HowItWorks from './Modules/HowItWorks.vue'
import HeroSection from './Modules/HeroSection.vue'
import RegisterCTA from './Modules/RegisterCTA.vue'
import FeaturesSection from './Modules/FeaturesSection.vue'
</script>
