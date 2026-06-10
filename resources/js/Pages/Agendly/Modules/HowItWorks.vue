<template>
  <section id="como-funciona" class="py-16 px-4">
    <div class="max-w-7xl mx-auto">
      <div class="text-center mb-12">
        <span class="text-xs font-semibold text-primary tracking-widest uppercase">Como funciona</span>
        <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-foreground tracking-tight text-balance">
          Reservar nunca fue tan facil
        </h2>
        <p class="mt-3 text-muted-foreground max-w-md mx-auto leading-relaxed">
          En tres simples pasos tendras tu cita confirmada.
        </p>
      </div>

      <div class="grid gap-6 sm:grid-cols-3 max-w-3xl mx-auto">
        <div
          v-for="(step, index) in steps"
          :key="index"
          class="relative bg-card rounded-2xl p-6 border border-border hover:border-primary/30 transition-colors group"
        >
          <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors">
            <span class="text-sm font-bold text-primary">{{ index + 1 }}</span>
          </div>
          <h3 class="text-base font-bold text-foreground mb-2">{{ step.title }}</h3>
          <p class="text-sm text-muted-foreground leading-relaxed">{{ step.description }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const steps = [
  {
    title: 'Elige un negocio',
    description: 'Busca entre cientos de negocios disponibles cerca de ti y elige el que necesites.',
  },
  {
    title: 'Selecciona horario',
    description: 'Consulta la disponibilidad en tiempo real y elige la fecha y hora que prefieras.',
  },
  {
    title: 'Confirma tu cita',
    description: 'Recibe la confirmacion al instante y un recordatorio antes de tu cita.',
  },
]
</script>
