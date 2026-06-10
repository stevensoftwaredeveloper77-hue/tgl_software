<template>
  <section class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-10">
        <span class="text-xs font-semibold text-primary tracking-widest uppercase">Unete</span>
        <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-foreground tracking-tight text-balance">
          Elige como quieres usar Agendly
        </h2>
        <p class="mt-3 text-muted-foreground max-w-md mx-auto leading-relaxed">
          Ya sea que busques agendar citas o que administres un negocio, tenemos la solucion para ti.
        </p>
      </div>

      <div class="grid gap-5 sm:grid-cols-2 max-w-2xl mx-auto">
        <!-- Client card -->
        <Link
          href="/agendly/register"
          class="group bg-card rounded-2xl p-6 border-2 border-border hover:border-primary transition-colors"
        >
          <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary/20 transition-colors">
            <svg class="w-6 h-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-foreground mb-2">Soy cliente</h3>
          <p class="text-sm text-muted-foreground leading-relaxed mb-4">
            Quiero buscar negocios y agendar citas de forma rapida y sencilla.
          </p>
          <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary group-hover:gap-2.5 transition-all">
            Crear cuenta
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12" />
              <polyline points="12 5 19 12 12 19" />
            </svg>
          </span>
        </Link>

        <!-- Business card -->
        <Link
          href="/agendly/register"
          class="group bg-card rounded-2xl p-6 border-2 border-border hover:border-accent transition-colors"
        >
          <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center mb-5 group-hover:bg-accent/20 transition-colors">
            <svg class="w-6 h-6 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
              <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-foreground mb-2">Soy negocio</h3>
          <p class="text-sm text-muted-foreground leading-relaxed mb-4">
            Quiero administrar mi agenda, recibir reservas y hacer crecer mi negocio.
          </p>
          <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-accent group-hover:gap-2.5 transition-all">
            Registrar negocio
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12" />
              <polyline points="12 5 19 12 12 19" />
            </svg>
          </span>
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
