<script setup lang="ts">
interface AppointmentType {
  id: number
  name: string
  description: string
  duration: string
  icon: string
}

const model = defineModel<number | null>({ required: true })

defineProps<{
  types: AppointmentType[]
}>()

const getIcon = (icon: string) => icon
</script>

<template>
  <div class="grid sm:grid-cols-2 gap-4">
    <button
      v-for="type in types"
      :key="type.id"
      @click="model = type.id"
      class="group relative p-6 rounded-2xl border-2 text-left transition-all duration-300"
      :class="{
        'border-blue-500 bg-gradient-to-br from-blue-50 to-blue-100/50 shadow-lg shadow-blue-500/10': model === type.id,
        'border-gray-200 bg-white hover:border-gray-300 hover:shadow-lg hover:shadow-gray-200/50': model !== type.id
      }"
    >
      <!-- Selection indicator -->
      <div 
        class="absolute top-4 right-4 w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all duration-300"
        :class="{
          'border-blue-500 bg-blue-500': model === type.id,
          'border-gray-300 group-hover:border-gray-400': model !== type.id
        }"
      >
        <svg 
          v-if="model === type.id"
          class="w-4 h-4 text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2.5"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>
      
      <!-- Icon -->
      <div 
        class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300"
        :class="{
          'bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30': model === type.id,
          'bg-gray-100 group-hover:bg-gray-200': model !== type.id
        }"
      >
        <!-- Video Icon -->
        <svg 
          v-if="type.icon === 'video'"
          class="w-7 h-7 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
        </svg>
        
        <!-- Phone Icon -->
        <svg 
          v-else-if="type.icon === 'phone'"
          class="w-7 h-7 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
        </svg>
        
        <!-- Chat Icon -->
        <svg 
          v-else-if="type.icon === 'chat'"
          class="w-7 h-7 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
        
        <!-- Building Icon -->
        <svg 
          v-else-if="type.icon === 'building'"
          class="w-7 h-7 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
        </svg>
      </div>
      
      <!-- Content -->
      <h3 
        class="text-lg font-bold mb-1 transition-colors duration-300"
        :class="model === type.id ? 'text-blue-900' : 'text-gray-900'"
      >
        {{ type.name }}
      </h3>
      <p class="text-sm text-gray-500 mb-4 leading-relaxed">
        {{ type.description }}
      </p>
      
      <!-- Duration Badge -->
      <div 
        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium transition-all duration-300"
        :class="{
          'bg-blue-200/50 text-blue-700': model === type.id,
          'bg-gray-100 text-gray-600': model !== type.id
        }"
      >
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ type.duration }}
      </div>
    </button>
  </div>
</template>
