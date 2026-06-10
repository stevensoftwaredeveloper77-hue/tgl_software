<template>
  <footer class="py-10 px-4 border-t border-border bg-muted/30">
    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col items-center gap-6">
        <!-- Logo -->
        <div class="flex items-center gap-2">
          <div class="w-7 h-7 rounded-lg bg-primary flex items-center justify-center">
            <svg class="w-4 h-4 text-primary-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
          </div>
          <span class="text-base font-bold text-foreground">Agendly</span>
        </div>

        <!-- Links -->
        <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2">
          <a href="#como-funciona" class="text-sm text-muted-foreground hover:text-foreground transition-colors">Como funciona</a>
          <Link href="/agendly/login" class="text-sm text-muted-foreground hover:text-foreground transition-colors">Iniciar sesion</Link>
          <Link href="/agendly/register" class="text-sm text-muted-foreground hover:text-foreground transition-colors">Registrarse</Link>
        </nav>

        <!-- Copyright -->
        <p class="text-xs text-muted-foreground">
          {{ currentYear }} TGL SOFTWARE. Todos los derechos reservados.
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup>
const currentYear = new Date().getFullYear()
import { Link } from '@inertiajs/vue3';
</script>
