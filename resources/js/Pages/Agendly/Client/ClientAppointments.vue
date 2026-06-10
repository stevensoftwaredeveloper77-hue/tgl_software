<template>
  <AgendlyClientLayout>
  <div class="px-4 py-5">
    <div class="mb-5">
      <p class="text-sm text-muted-foreground">Tus reservas</p>
      <h1 class="text-2xl font-extrabold text-foreground">Mis citas</h1>
    </div>

    <!-- Filter tabs -->
    <div class="flex gap-2 mb-5 overflow-x-auto pb-1 -mx-4 px-4">
      <button
        v-for="tab in tabs"
        :key="tab.value"
        @click="activeTab = tab.value"
        :class="[
          'px-4 py-2 text-xs font-semibold rounded-full whitespace-nowrap transition-all flex-shrink-0',
          activeTab === tab.value
            ? 'bg-primary text-primary-foreground'
            : 'bg-muted text-muted-foreground'
        ]"
      >
        {{ tab.label }}
        <span
          v-if="tab.count > 0"
          class="ml-1 px-1.5 py-0.5 text-[10px] rounded-full"
          :class="activeTab === tab.value ? 'bg-primary-foreground/20 text-primary-foreground' : 'bg-border text-muted-foreground'"
        >
          {{ tab.count }}
        </span>
      </button>
    </div>

    <!-- Appointments list -->
    <div class="flex flex-col gap-3">
      <div
        v-for="apt in clientAppointments"
        :key="apt.id"
        class="bg-card rounded-xl border border-border p-4"
      >
        <div class="flex items-start justify-between mb-2">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" :class="statusIconBg(apt.state_name)">
              <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" v-html="statusIcon(apt.state_name)"></svg>
            </div>
            <div>
              <p class="text-sm font-bold text-foreground">{{ apt.business_info.name }}</p>
              <p class="text-xs text-muted-foreground">{{ apt.reason }}</p>
            </div>
          </div>
          <span class="px-2.5 py-1 text-[10px] font-semibold rounded-full flex-shrink-0" :class="statusBadge(apt.state_name)">
            {{ statusLabel(apt.state_name) }}
          </span>
        </div>

        <div class="flex items-center gap-4 text-xs text-muted-foreground mt-3">
          <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
            </svg>
            {{ formatDate(apt.date) }}
          </span>
          <span class="flex items-center gap-1">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
            </svg>
            {{ apt.hour }}
          </span>
        </div>

        <!-- Cancel button for pending/confirmed -->
        <button
          v-if="apt.state_name === 'Pendiente' || apt.state_name === 'Confirmada'"
          @click="cancelMyAppointment(apt.id)"
          class="mt-3 w-full py-2 text-xs font-semibold border border-border text-muted-foreground rounded-lg hover:bg-muted hover:text-foreground transition-colors"
        >
          Cancelar cita
        </button>
      </div>
    </div>

    <!-- Empty state -->
    <div
      v-if="clientAppointments.length === 0"
      class="flex flex-col items-center justify-center py-16 text-center"
    >
      <div class="w-16 h-16 rounded-full bg-muted flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />
        </svg>
      </div>
      <p class="text-sm font-semibold text-foreground">Sin citas</p>
      <p class="text-xs text-muted-foreground mt-1 mb-4">Aun no has agendado ninguna cita</p>
      <router-link
        to="/cliente"
        class="px-5 py-2.5 bg-primary text-primary-foreground text-xs font-semibold rounded-xl hover:opacity-90 transition-opacity"
      >
        Explorar negocios
      </router-link>
    </div>
  </div>
  </AgendlyClientLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useStore } from '@/stores/mockData.js'
import AgendlyClientLayout from '@/Layouts/AgendlyClientLayout.vue'

const { state, getAppointmentsForClient, getBusinessById, updateAppointmentStatus } = useStore()

const props = defineProps({
  clientAppointments: Array
})

console.log(props.clientAppointments)
const activeTab = ref('todas')

const clientEmail = computed(() => state.currentUser?.email || 'maria@correo.com')

const allAppointments = computed(() => {
  return getAppointmentsForClient(clientEmail.value).sort((a, b) => {
    const dateA = new Date(a.date + 'T' + a.time)
    const dateB = new Date(b.date + 'T' + b.time)
    return dateB - dateA
  })
})

const pendingCount = computed(() => allAppointments.value.filter((a) => a.status === 'pendiente').length)
const confirmedCount = computed(() => allAppointments.value.filter((a) => a.status === 'confirmada').length)

const tabs = computed(() => [
  { label: 'Todas', value: 'todas', count: allAppointments.value.length },
  { label: 'Pendientes', value: 'pendiente', count: pendingCount.value },
  { label: 'Confirmadas', value: 'confirmada', count: confirmedCount.value },
  { label: 'Pasadas', value: 'pasada', count: 0 },
])

const filteredAppointments = computed(() => {
  if (activeTab.value === 'todas') return allAppointments.value
  if (activeTab.value === 'pasada') {
    return allAppointments.value.filter((a) => a.status === 'completada' || a.status === 'cancelada')
  }
  return allAppointments.value.filter((a) => a.status === activeTab.value)
})

const getBusinessName = (bizId) => {
  const biz = getBusinessById(bizId)
  return biz?.name || 'Negocio'
}

const cancelMyAppointment = (id) => {
  updateAppointmentStatus(id, 'cancelada')
}

const formatDate = (dateStr) => {
  const date = new Date(dateStr + 'T12:00:00')
  return date.toLocaleDateString('es-CO', { weekday: 'short', day: 'numeric', month: 'short' })
}

const statusBadge = (status) => {
  if (status === 'Pendiente') return 'bg-amber-100 text-amber-700'
  if (status === 'Confirmada') return 'bg-primary/10 text-primary'
  if (status === 'completada') return 'bg-muted text-muted-foreground'
  return 'bg-red-50 text-red-500'
}

const statusLabel = (status) => {
  if (status === 'pendiente') return 'Pendiente'
  if (status === 'confirmada') return 'Confirmada'
  if (status === 'completada') return 'Completada'
  return 'Cancelada'
}

const statusIconBg = (status) => {
  if (status === 'Pendiente') return 'bg-amber-100 text-amber-600'
  if (status === 'Confirmada') return 'bg-primary/10 text-primary'
  if (status === 'completada') return 'bg-muted text-muted-foreground'
  return 'bg-red-50 text-red-400'
}

const statusIcon = (status) => {
  if (status === 'Pendiente') return '<circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />'
  if (status === 'Confirmada') return '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" /><polyline points="22 4 12 14.01 9 11.01" />'
  if (status === 'completada') return '<polyline points="20 6 9 17 4 12" />'
  return '<circle cx="12" cy="12" r="10" /><line x1="15" y1="9" x2="9" y2="15" /><line x1="9" y1="9" x2="15" y2="15" />'
}
</script>
