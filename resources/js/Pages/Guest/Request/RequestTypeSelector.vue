<script setup lang="ts">
interface RequestType {
  id: number
  name: string
  description: string
  icon: string
  color: string
}

const model = defineModel<number | null>({ required: true })

defineProps<{
  types: RequestType[]
}>()
</script>

<template>
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
    <button
      v-for="type in types"
      :key="type.id"
      @click="model = type.id"
      class="group relative p-5 rounded-2xl border-2 text-left transition-all duration-300 overflow-hidden"
      :class="{
        'border-blue-500 bg-gradient-to-br from-blue-50 to-white shadow-xl shadow-blue-500/15 scale-[1.02]': model === type.id,
        'border-gray-200 bg-white hover:border-blue-200 hover:shadow-lg hover:shadow-gray-200/50 hover:scale-[1.01]': model !== type.id
      }"
    >
      <!-- Background Gradient on Selection -->
      <div 
        v-if="model === type.id"
        class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-transparent to-blue-600/5 pointer-events-none"
      ></div>

      <!-- Selection Indicator -->
      <div 
        class="absolute top-3 right-3 w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-300"
        :class="{
          'border-blue-500 bg-blue-500 scale-110': model === type.id,
          'border-gray-300 group-hover:border-blue-300': model !== type.id
        }"
      >
        <svg 
          v-if="model === type.id"
          class="w-3 h-3 text-white"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="3"
        >
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
      </div>

      <!-- Icon Container -->
      <div 
        class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-all duration-300"
        :class="{
          'bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30': model === type.id,
          'bg-gray-100 group-hover:bg-blue-50': model !== type.id
        }"
      >
        <!-- Code Icon -->
        <svg 
          v-if="type.icon === 'code'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
        </svg>

        <!-- Bug Icon -->
        <svg 
          v-else-if="type.icon === 'bug'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>

        <!-- Rocket Icon -->
        <svg 
          v-else-if="type.icon === 'rocket'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
        </svg>

        <!-- Support Icon -->
        <svg 
          v-else-if="type.icon === 'support'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Lightbulb Icon -->
        <svg 
          v-else-if="type.icon === 'lightbulb'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
        </svg>

        <!-- Database Icon -->
        <svg 
          v-else-if="type.icon === 'database'"
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
        </svg>

        <!-- Default Icon -->
        <svg 
          v-else
          class="w-6 h-6 transition-colors duration-300"
          :class="model === type.id ? 'text-white' : 'text-gray-600 group-hover:text-blue-600'"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
      </div>

      <!-- Content -->
      <h3 
        class="text-base font-bold mb-1.5 transition-colors duration-300 pr-6"
        :class="model === type.id ? 'text-blue-900' : 'text-gray-900'"
      >
        {{ type.name }}
      </h3>
      <p class="text-sm text-gray-500 leading-relaxed">
        {{ type.description }}
      </p>
    </button>
  </div>
</template>
