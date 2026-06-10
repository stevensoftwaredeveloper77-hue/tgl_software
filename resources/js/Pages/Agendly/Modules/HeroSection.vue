<template>
  <section class="relative pt-24 pb-12 px-4 overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 -z-10">
      <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-primary/5 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col lg:flex-row lg:items-center lg:gap-16">
        <!-- Text content -->
        <div class="flex-1 text-center lg:text-left">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-secondary text-secondary-foreground text-xs font-semibold tracking-wide mb-6">
            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
            Disponible ahora
          </span>

          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-foreground leading-tight tracking-tight text-balance">
            Agenda tu cita
            <span class="text-primary"> en segundos</span>
          </h1>

          <p class="mt-5 text-base sm:text-lg text-muted-foreground leading-relaxed max-w-lg mx-auto lg:mx-0">
            Conecta con los negocios que amas y reserva citas al instante. Sin llamadas, sin esperas.
          </p>

          <div class="mt-8 flex flex-col sm:flex-row gap-3 sm:justify-center lg:justify-start">
            <router-link
              to="/registro"
              class="flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-primary-foreground font-semibold rounded-xl text-base hover:opacity-90 transition-opacity shadow-lg shadow-primary/20"
            >
              Comenzar gratis
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </router-link>
            <a
              href="#como-funciona"
              class="flex items-center justify-center gap-2 px-6 py-3.5 bg-secondary text-secondary-foreground font-semibold rounded-xl text-base hover:bg-secondary/80 transition-colors"
            >
              Ver como funciona
            </a>
          </div>
        </div>

        <!-- Phone mockup -->
        <div class="flex-1 mt-12 lg:mt-0 flex justify-center">
          <div class="relative w-64 sm:w-72">
            <!-- Phone frame -->
            <div class="relative bg-card rounded-[2.5rem] border-[3px] border-foreground/10 shadow-2xl p-3 overflow-hidden">
              <!-- Notch -->
              <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-6 bg-foreground/10 rounded-b-2xl z-10"></div>
              <!-- Screen -->
              <div class="bg-secondary rounded-[2rem] pt-8 pb-4 px-4 min-h-[420px] flex flex-col">
                <!-- Mock header -->
                <div class="flex items-center justify-between mb-6">
                  <div>
                    <p class="text-xs text-muted-foreground">Hola, Maria</p>
                    <p class="text-sm font-bold text-foreground">Tus proximas citas</p>
                  </div>
                  <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="text-xs font-bold text-primary">M</span>
                  </div>
                </div>

                <!-- Mock appointment cards -->
                <div class="flex flex-col gap-3 flex-1">
                  <div class="bg-card rounded-xl p-3 shadow-sm border border-border">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M20 7h-3a2 2 0 0 1-2-2V2" /><path d="M9 18a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h7l4 4v10a2 2 0 0 1-2 2Z" /><path d="M3 7.6v12.8A1.6 1.6 0 0 0 4.6 22h9.8" />
                        </svg>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-foreground truncate">Corte de cabello</p>
                        <p class="text-[10px] text-muted-foreground">Hoy, 3:00 PM</p>
                      </div>
                      <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-semibold rounded-full flex-shrink-0">Confirmada</span>
                    </div>
                  </div>

                  <div class="bg-card rounded-xl p-3 shadow-sm border border-border">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M22 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-foreground truncate">Consulta dental</p>
                        <p class="text-[10px] text-muted-foreground">Mar 14, 10:00 AM</p>
                      </div>
                      <span class="px-2 py-0.5 bg-accent/10 text-accent text-[10px] font-semibold rounded-full flex-shrink-0">Pendiente</span>
                    </div>
                  </div>

                  <div class="bg-card rounded-xl p-3 shadow-sm border border-border">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M18 20V10" /><path d="M12 20V4" /><path d="M6 20v-6" />
                        </svg>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-foreground truncate">Masaje relajante</p>
                        <p class="text-[10px] text-muted-foreground">Mar 16, 5:00 PM</p>
                      </div>
                      <span class="px-2 py-0.5 bg-primary/10 text-primary text-[10px] font-semibold rounded-full flex-shrink-0">Confirmada</span>
                    </div>
                  </div>
                </div>

                <!-- Mock bottom nav -->
                <div class="mt-4 pt-3 border-t border-border flex items-center justify-around">
                  <div class="flex flex-col items-center gap-0.5">
                    <svg class="w-4 h-4 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" /><polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span class="text-[8px] font-semibold text-primary">Inicio</span>
                  </div>
                  <div class="flex flex-col items-center gap-0.5">
                    <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <span class="text-[8px] text-muted-foreground">Buscar</span>
                  </div>
                  <div class="flex flex-col items-center gap-0.5">
                    <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <span class="text-[8px] text-muted-foreground">Citas</span>
                  </div>
                  <div class="flex flex-col items-center gap-0.5">
                    <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />
                    </svg>
                    <span class="text-[8px] text-muted-foreground">Perfil</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
