<template>
  <AgendlyBusinessLayout>
  <div class="px-4 py-5">
    <div class="mb-6">
      <p class="text-sm text-muted-foreground">Configuracion</p>
      <h1 class="text-2xl font-extrabold text-foreground">Perfil del negocio</h1>
    </div>

    <EditBusinessProfileModal 
      :show="showEditModal" 
      :user="user"
      :businessCategories="businessCategories"
      @close="showEditModal = false"
    />
    <div v-if="business" class="flex flex-col gap-5">
      <!-- Business card -->
      <div class="bg-card rounded-xl border border-border p-5 flex flex-col items-center text-center">
        <div class="w-20 h-20 rounded-2xl bg-primary/10 flex items-center justify-center mb-4">
          <span class="text-2xl font-extrabold text-primary">{{ user.business.name.substring(0, 2).toUpperCase() }}</span>
        </div>
        <h2 class="text-lg font-bold text-foreground">{{ user.business.name }}</h2>
        <p class="text-sm text-muted-foreground mt-1">{{ user.business.category.name }}</p>
        <p class="text-sm text-muted-foreground mt-3">{{ user.business.description }}</p>
        <div class="flex items-center gap-1 mt-2">
          <!-- <svg class="w-4 h-4 text-amber-400 fill-amber-400" viewBox="0 0 24 24">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
          </svg> -->

          <!-- Reviews -->
          <!-- <span class="text-sm font-semibold text-foreground">{{ business.rating }}</span>
          <span class="text-xs text-muted-foreground">({{ business.reviewCount }} resenas)</span> -->
          <button 
            @click="showEditModal = true" 
            class="flex items-center gap-2 px-4 py-2 bg-secondary text-secondary-foreground rounded-xl hover:bg-secondary/80 transition-colors"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Editar Perfil
          </button>
        </div>
      </div>

      <!-- Info -->
      <div class="bg-card rounded-xl border border-border p-4 flex flex-col gap-4">
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-muted-foreground flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" />
          </svg>
          <div>
            <p class="text-xs text-muted-foreground">Direccion</p>
            <p class="text-sm font-medium text-foreground">{{ user.business.address }}</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-muted-foreground flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
          </svg>
          <div>
            <p class="text-xs text-muted-foreground">Telefono</p>
            <p class="text-sm font-medium text-foreground">{{ user.business.phone }}</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            width="24" 
            height="24" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            stroke-width="2" 
            stroke-linecap="round" 
            stroke-linejoin="round"
          >
            <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
          </svg>
          <div>
            <p class="text-xs text-muted-foreground">Email</p>
            <p class="text-sm font-medium text-foreground">{{ user.business.email }}</p>
          </div>
        </div>
        <div class="flex items-start gap-3">
          <svg class="w-5 h-5 text-muted-foreground flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />
          </svg>
          <div>
            <p class="text-xs text-muted-foreground">Duracion por cita</p>
            <p class="text-sm font-medium text-foreground">{{ business.slotDuration }} minutos</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </AgendlyBusinessLayout>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useStore } from '@/stores/mockData.js'
import AgendlyBusinessLayout from '@/Layouts/AgendlyBusinessLayout.vue'
import EditBusinessProfileModal from '../Modules/EditBusinessProfileModal.vue'

const props = defineProps({
  user: Array,
  businessCategories: Array
})
console.log(props.user)
const { state, getBusinessById } = useStore()
const businessId = computed(() => state.currentUser?.businessId || 1)
const business = computed(() => getBusinessById(businessId.value))
const showEditModal = ref(false);
</script>
