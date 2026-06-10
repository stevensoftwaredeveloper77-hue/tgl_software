<template>
  <AgendlyClientLayout>
  <div class="px-4 py-5">
    <div class="mb-6">
      <p class="text-sm text-muted-foreground">Tu cuenta</p>
      <h1 class="text-2xl font-extrabold text-foreground">Perfil</h1>
    </div>

    <div class="py-12">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                  <UpdateProfileInformationForm
                      :must-verify-email="mustVerifyEmail"
                      :status="status"
                      class="w-auto"
                  />
              </div>

              <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                  <UpdatePasswordForm class="w-auto" />
              </div>

          </div>
      </div>

    <!-- <div class="flex flex-col items-center mb-8">
      <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center mb-3">
        <span class="text-2xl font-extrabold text-primary">{{ initials }}</span>
      </div>
      <h2 class="text-lg font-bold text-foreground">{{ state.currentUser?.name }}</h2>
      <p class="text-sm text-muted-foreground">{{ state.currentUser?.email }}</p>
      <span class="mt-2 px-3 py-1 text-xs font-semibold bg-primary/10 text-primary rounded-full capitalize">{{ state.currentUser?.role }}</span>
    </div>

    <div class="flex flex-col gap-2">
      <button class="flex items-center gap-3 w-full bg-card rounded-xl border border-border p-4 text-left hover:border-primary/30 transition-colors">
        <svg class="w-5 h-5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />
        </svg>
        <div class="flex-1">
          <p class="text-sm font-semibold text-foreground">Editar perfil</p>
          <p class="text-xs text-muted-foreground">Nombre, correo, telefono</p>
        </div>
        <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button>

      <!-- <button class="flex items-center gap-3 w-full bg-card rounded-xl border border-border p-4 text-left hover:border-primary/30 transition-colors">
        <svg class="w-5 h-5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />
        </svg>
        <div class="flex-1">
          <p class="text-sm font-semibold text-foreground">Notificaciones</p>
          <p class="text-xs text-muted-foreground">Recordatorios de citas</p>
        </div>
        <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button>

      <button class="flex items-center gap-3 w-full bg-card rounded-xl border border-border p-4 text-left hover:border-primary/30 transition-colors">
        <svg class="w-5 h-5 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="3" /><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
        </svg>
        <div class="flex-1">
          <p class="text-sm font-semibold text-foreground">Preferencias</p>
          <p class="text-xs text-muted-foreground">Idioma, tema, privacidad</p>
        </div>
        <svg class="w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </button> -->
    <!-- </div> --> 

    <p class="text-xs text-center text-muted-foreground mt-8">Agendly v0.1.0</p>
  </div>
  </AgendlyClientLayout>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from '@/stores/mockData.js'
import AgendlyClientLayout from '@/Layouts/AgendlyClientLayout.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

const { state } = useStore()

const initials = computed(() => {
  const name = state.currentUser?.name || ''
  return name.split(' ').map((w) => w[0]).join('').substring(0, 2).toUpperCase()
})
</script>
