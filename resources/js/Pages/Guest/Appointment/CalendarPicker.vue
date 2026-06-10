<script setup lang="ts">
import { ref, computed } from 'vue'

const model = defineModel<string>({ required: true })

const currentDate = new Date()
const viewDate = ref(new Date(currentDate.getFullYear(), currentDate.getMonth(), 1))

const monthNames = [
  'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
]

const dayNames = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb']

const currentMonth = computed(() => monthNames[viewDate.value.getMonth()])
const currentYear = computed(() => viewDate.value.getFullYear())

const calendarDays = computed(() => {
  const year = viewDate.value.getFullYear()
  const month = viewDate.value.getMonth()
  
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  
  const days: Array<{ date: Date; isCurrentMonth: boolean; isToday: boolean; isPast: boolean; dateStr: string }> = []
  
  // Previous month days
  const startDayOfWeek = firstDay.getDay()
  for (let i = startDayOfWeek - 1; i >= 0; i--) {
    const date = new Date(year, month, -i)
    days.push({
      date,
      isCurrentMonth: false,
      isToday: false,
      isPast: true,
      dateStr: formatDate(date)
    })
  }
  
  // Current month days
  for (let day = 1; day <= lastDay.getDate(); day++) {
    const date = new Date(year, month, day)
    const today = new Date()
    today.setHours(0, 0, 0, 0)
    
    days.push({
      date,
      isCurrentMonth: true,
      isToday: date.toDateString() === today.toDateString(),
      isPast: date < today,
      dateStr: formatDate(date)
    })
  }
  
  // Next month days
  const remainingDays = 42 - days.length
  for (let day = 1; day <= remainingDays; day++) {
    const date = new Date(year, month + 1, day)
    days.push({
      date,
      isCurrentMonth: false,
      isToday: false,
      isPast: false,
      dateStr: formatDate(date)
    })
  }
  
  return days
})

const formatDate = (date: Date): string => {
  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

const prevMonth = () => {
  viewDate.value = new Date(viewDate.value.getFullYear(), viewDate.value.getMonth() - 1, 1)
}

const nextMonth = () => {
  viewDate.value = new Date(viewDate.value.getFullYear(), viewDate.value.getMonth() + 1, 1)
}

const selectDate = (day: typeof calendarDays.value[0]) => {
  if (day.isPast && !day.isToday) return
  if (!day.isCurrentMonth) return
  model.value = day.dateStr
}

const canGoPrev = computed(() => {
  const today = new Date()
  return viewDate.value.getMonth() > today.getMonth() || viewDate.value.getFullYear() > today.getFullYear()
})
</script>

<template>
  <div class="bg-gradient-to-br from-slate-50 to-blue-50/50 rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
      <h3 class="text-lg font-semibold text-gray-900">Selecciona una fecha</h3>
    </div>
    
    <!-- Month Navigation -->
    <div class="flex items-center justify-between mb-6">
      <button
        @click="prevMonth"
        :disabled="!canGoPrev"
        class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 disabled:opacity-30 disabled:cursor-not-allowed transition-all duration-200 shadow-sm"
      >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      
      <div class="text-center">
        <span class="text-lg font-bold text-gray-900">{{ currentMonth }}</span>
        <span class="text-lg text-gray-500 ml-2">{{ currentYear }}</span>
      </div>
      
      <button
        @click="nextMonth"
        class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm"
      >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>
    
    <!-- Day Names -->
    <div class="grid grid-cols-7 mb-2">
      <div
        v-for="day in dayNames"
        :key="day"
        class="text-center text-xs font-semibold text-gray-400 uppercase tracking-wider py-2"
      >
        {{ day }}
      </div>
    </div>
    
    <!-- Calendar Grid -->
    <div class="grid grid-cols-7 gap-1">
      <button
        v-for="(day, index) in calendarDays"
        :key="index"
        @click="selectDate(day)"
        :disabled="(day.isPast && !day.isToday) || !day.isCurrentMonth"
        class="relative aspect-square flex items-center justify-center rounded-xl text-sm font-medium transition-all duration-200"
        :class="{
          'text-gray-300 cursor-not-allowed': !day.isCurrentMonth,
          'text-gray-300 cursor-not-allowed line-through': day.isPast && !day.isToday && day.isCurrentMonth,
          'text-gray-700 hover:bg-white hover:shadow-md cursor-pointer': day.isCurrentMonth && !day.isPast && model !== day.dateStr,
          'bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-105': model === day.dateStr,
          'ring-2 ring-blue-500 ring-offset-2': day.isToday && model !== day.dateStr
        }"
      >
        {{ day.date.getDate() }}
        <span 
          v-if="day.isToday" 
          class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full"
          :class="model === day.dateStr ? 'bg-white' : 'bg-blue-500'"
        ></span>
      </button>
    </div>
    
    <!-- Selected Date Display -->
    <Transition
      enter-active-class="transition-all duration-300 ease-out"
      enter-from-class="opacity-0 translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
    >
      <div v-if="model" class="mt-6 p-4 bg-white rounded-xl border border-blue-100 shadow-sm">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <div>
            <p class="text-xs text-gray-500 uppercase tracking-wider">Fecha seleccionada</p>
            <p class="font-semibold text-gray-900 capitalize">
              {{ new Date(model + 'T00:00:00').toLocaleDateString('es-ES', { weekday: 'long', day: 'numeric', month: 'long' }) }}
            </p>
          </div>
        </div>
      </div>
    </Transition>
  </div>
</template>
