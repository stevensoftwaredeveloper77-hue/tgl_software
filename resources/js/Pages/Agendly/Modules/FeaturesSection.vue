<template>
    <section class="py-16 px-4 bg-secondary/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span
                    class="text-xs font-semibold text-primary tracking-widest uppercase"
                    >Beneficios</span
                >
                <h2
                    class="mt-3 text-3xl sm:text-4xl font-extrabold text-foreground tracking-tight text-balance"
                >
                    Todo lo que necesitas para gestionar citas
                </h2>
            </div>

            <div
                class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 max-w-5xl mx-auto"
            >
                <div class="bg-card rounded-2xl p-5 border border-border">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-4"
                    >
                        <svg
                            class="w-5 h-5 text-primary"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect
                                x="3"
                                y="4"
                                width="18"
                                height="18"
                                rx="2"
                                ry="2"
                            />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-foreground mb-1.5">
                        Reservas 24/7
                    </h3>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Tus clientes pueden agendar en cualquier momento, desde
                        cualquier lugar.
                    </p>
                </div>

                <div class="bg-card rounded-2xl p-5 border border-border">
                    <div
                        class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center mb-4"
                    >
                        <svg
                            class="w-5 h-5 text-accent"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-foreground mb-1.5">
                        Disponibilidad en vivo
                    </h3>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Horarios actualizados en tiempo real. Solo se muestran
                        espacios disponibles.
                    </p>
                </div>

                <div class="bg-card rounded-2xl p-5 border border-border">
                    <div
                        class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center mb-4"
                    >
                        <svg
                            class="w-5 h-5 text-primary"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"
                            />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-foreground mb-1.5">
                        Recordatorios
                    </h3>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Notificaciones automaticas para que nadie olvide su cita
                        programada.
                    </p>
                </div>

                <div class="bg-card rounded-2xl p-5 border border-border">
                    <div
                        class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center mb-4"
                    >
                        <svg
                            class="w-5 h-5 text-accent"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"
                            />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-foreground mb-1.5">
                        Datos seguros
                    </h3>
                    <p class="text-xs text-muted-foreground leading-relaxed">
                        Tu Información y la de tus clientes protegida con los
                        mas altos estandares.
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup></script>
