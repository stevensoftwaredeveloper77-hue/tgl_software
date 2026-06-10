<template>
  <AgendlyClientLayout>
  <div class="min-h-screen bg-background pb-24">
    <!-- Back header -->
    <header class="sticky top-0 z-40 bg-background/80 border-b border-border">
      <div class="flex items-center gap-3 px-4 py-3">
        <Link href="/agendly" class="w-9 h-9 rounded-lg bg-muted flex items-center justify-center text-foreground hover:bg-muted/70 transition-colors">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12" /><polyline points="12 19 5 12 12 5" />
          </svg>
        </Link>
        <h1 class="text-base font-bold text-foreground truncate">{{ business?.name }}</h1>
      </div>
    </header>

    <div v-if="business" class="px-4 py-5">
      <!-- Business info card -->
      <div class="bg-card rounded-xl border border-border p-5 mb-5">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 bg-primary/10">
            <span class="text-xl font-extrabold text-primary">{{ business.name.substring(0, 2).toUpperCase() }}</span>
          </div>
          <div class="flex-1 min-w-0">
            <h2 class="text-lg font-bold text-foreground">{{ business.name }}</h2>
            <p class="text-xs text-primary font-medium mt-0.5">{{ business.category.name }}</p>
          </div>
        </div>

        <p class="text-sm text-muted-foreground leading-relaxed mb-4">{{ business.description }}</p>

        <div class="flex flex-col gap-2.5">
          <div class="flex items-center gap-2.5 text-xs text-muted-foreground">
            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" />
            </svg>
            <span>{{ business.address }}</span>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-muted-foreground">
            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" />
            </svg>
            <span>{{ business.phone }}</span>
          </div>
          <div class="flex items-center gap-2.5 text-xs text-muted-foreground">
            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
            </svg>
            <span>Citas de {{ business.settings_info.duration }} min</span>
          </div>
        </div>
      </div>

      <!-- Date selection -->
      <div class="mb-5">
        <h3 class="text-sm font-bold text-foreground mb-3">Selecciona una fecha</h3>
        <div class="flex gap-2 overflow-x-auto pb-1 -mx-4 px-4 scrollbar-hide">
          <button
            v-for="d in availableDates"
            :key="d.dateStr"
            @click="selectedDate = d.dateStr"
            :class="[
              'flex flex-col items-center px-4 py-3 rounded-xl border transition-all flex-shrink-0 min-w-[70px]',
              selectedDate === d.dateStr
                ? 'bg-primary text-primary-foreground border-primary shadow-md shadow-primary/20'
                : 'bg-card text-foreground border-border hover:border-primary/30'
            ]"
          >
            <span class="text-[10px] font-medium uppercase" :class="selectedDate === d.dateStr ? 'text-primary-foreground/80' : 'text-muted-foreground'">{{ d.dayShort }}</span>
            <span class="text-lg font-bold leading-tight mt-0.5">{{ d.dayNum }}</span>
            <span class="text-[10px] font-medium" :class="selectedDate === d.dateStr ? 'text-primary-foreground/80' : 'text-muted-foreground'">{{ d.monthShort }}</span>
          </button>
        </div>
      </div>

      <!-- Time slots -->
      <div class="mb-5">
        <h3 class="text-sm font-bold text-foreground mb-3">
          Horarios disponibles
          <span v-if="selectedDate" class="font-normal text-muted-foreground"> - {{ formatDateFull(selectedDate) }}</span>
        </h3>

        <div v-if="availableSlots.length > 0" class="grid grid-cols-3 gap-2">
          <button
            v-for="slot in availableSlots"
            :key="slot"
            @click="selectedTime = slot"
            :class="[
              'py-2.5 text-sm font-semibold rounded-xl border transition-all text-center',
              selectedTime === slot
                ? 'bg-primary text-primary-foreground border-primary shadow-md shadow-primary/20'
                : 'bg-card text-foreground border-border hover:border-primary/30'
            ]"
          >
            {{ slot }}
          </button>
        </div>

        <div v-else-if="selectedDate" class="bg-muted rounded-xl p-6 text-center">
          <p class="text-sm text-muted-foreground">No hay horarios disponibles para esta fecha</p>
        </div>

        <div v-else class="bg-muted rounded-xl p-6 text-center">
          <p class="text-sm text-muted-foreground">Selecciona una fecha para ver los horarios</p>
        </div>
      </div>

      <!-- Service input -->
      <div v-if="selectedTime" class="mb-5">
        <h3 class="text-sm font-bold text-foreground mb-3">Motivo de la cita</h3>
        <input
          v-model="service"
          type="text"
          placeholder="Ej: Corte de cabello, Consulta general..."
          class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
        />
      </div>

      <!-- Booking summary & button -->
      <div v-if="selectedDate && selectedTime" class="bg-secondary rounded-xl p-4 mb-5">
        <h3 class="text-sm font-bold text-foreground mb-2">Resumen de tu cita</h3>
        <div class="flex flex-col gap-1.5 text-xs text-muted-foreground">
          <p><span class="font-medium text-foreground">Negocio:</span> {{ business.name }}</p>
          <p><span class="font-medium text-foreground">Fecha:</span> {{ formatDateFull(selectedDate) }}</p>
          <p><span class="font-medium text-foreground">Hora:</span> {{ selectedTime }}</p>
          <p><span class="font-medium text-foreground">Duracion:</span> {{ business.settings_info.duration }} min</p>
          <p v-if="service"><span class="font-medium text-foreground">Servicio:</span> {{ service }}</p>
        </div>
      </div>
    </div>

    <!-- Sticky bottom button -->
    <div v-if="selectedDate && selectedTime" class="z-50 bg-background border-t border-border p-4 safe-area-bottom">
      <button
        @click="bookNow"
        :disabled="booked"
        :class="[
          'w-full py-3.5 font-semibold rounded-xl text-sm transition-all',
          booked
            ? 'bg-primary/20 text-primary'
            : 'bg-primary text-primary-foreground hover:opacity-90 shadow-lg shadow-primary/20'
        ]"
      >
        {{ booked ? 'Cita solicitada' : 'Solicitar cita' }}
      </button>
    </div>
  </div>
  </AgendlyClientLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useForm } from '@inertiajs/vue3';
import { useStore } from '@/stores/mockData.js'
import AgendlyClientLayout from '@/Layouts/AgendlyClientLayout.vue'

const props = defineProps({
  business: Array,
  businessSettings: Array
})

const form = useForm({
    businessId: props.business.user_id,
    date: '',      
    hour: '',      
    reason: '',   
});

console.log(props.business.settings_info)

const { state, getBusinessById, getAvailableSlots, bookAppointment } = useStore()

const businessId = computed(() => props.business.id)
// const business = computed(() => getBusinessById(businessId.value))

const selectedDate = ref(null)
const selectedTime = ref(null)
const service = ref('')
const booked = ref(false)

const availableDates = computed(() => {
  const dates = []
  const today = new Date()
  for (let i = 0; i < 14; i++) {
    const d = new Date(today)
    d.setDate(today.getDate() + i)
    const year = d.getFullYear()
    const month = String(d.getMonth() + 1).padStart(2, '0')
    const day = String(d.getDate()).padStart(2, '0')
    const dateStr = `${year}-${month}-${day}`
    const dayShort = d.toLocaleDateString('es-CO', { weekday: 'short' }).replace('.', '')
    const monthShort = d.toLocaleDateString('es-CO', { month: 'short' }).replace('.', '')
    dates.push({
      dateStr,
      dayShort,
      dayNum: d.getDate(),
      monthShort,
    })
  }
  return dates
})

const availableSlots = computed(() => {
  if (!selectedDate.value || !businessId.value) return []
  return getAvailableSlots(props.business.settings_info, selectedDate.value)
})

const formatDateFull = (dateStr) => {
  const d = new Date(dateStr + 'T12:00:00')
  return d.toLocaleDateString('es-CO', { weekday: 'long', day: 'numeric', month: 'long' })
}

const bookNow = () => {
  if (!selectedDate.value || !selectedTime.value) return
  // bookAppointment({
  //   businessId: props.business.id,
  //   date: selectedDate.value,
  //   hour: selectedTime.value,
  //   reason: service.value || 'Cita general',
  // })

    form.date = selectedDate.value;
    form.hour = selectedTime.value;
    form.reason = service.value; 

    form.post(route('agendly.client.appointment.store'), {
        preserveScroll: true,
        onSuccess: () => {
          console.log('Great!!, SUCCESS')
          booked.value = true;
        },
        onError: (errors) => {
            console.error("Error al guardar la cita:", errors);
        }
    });

  // booked.value = true
}

watch(selectedDate, () => {
  selectedTime.value = null
  booked.value = false
})
</script>

<style scoped>
.safe-area-bottom {
  padding-bottom: env(safe-area-inset-bottom, 0px);
}
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
