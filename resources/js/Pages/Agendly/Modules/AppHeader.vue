<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <header class="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-lg border-b border-border">
    <div class="flex items-center justify-between px-4 py-3 max-w-7xl mx-auto">
      <Link href="/agendly" class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
          <svg class="w-5 h-5 text-primary-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
        </div>
        <span class="text-lg font-bold text-foreground tracking-tight">Agendly</span>
      </Link>

      <nav class="flex items-center gap-2">
        <Link
          href="agendly/login"
          class="px-4 py-2 text-sm font-medium text-foreground hover:text-primary transition-colors"
        >
          Iniciar sesion
        </Link>
        
        <Link
          href="agendly/register"
          class="px-4 py-2 text-sm font-semibold bg-primary text-primary-foreground rounded-lg hover:opacity-90 transition-opacity"
        >
          Registrarse
        </Link>
      </nav>
    </div>
  </header>
</template>