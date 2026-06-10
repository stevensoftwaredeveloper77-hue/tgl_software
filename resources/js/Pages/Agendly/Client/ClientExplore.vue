<template>
  <AgendlyClientLayout>
  <div class="px-4 py-5">
    <!-- Greeting -->
    <div class="mb-5">
      <p class="text-sm text-muted-foreground">Hola, {{ state.currentUser?.name || 'Usuario' }}</p>
      <h1 class="text-2xl font-extrabold text-foreground">Explorar negocios</h1>
    </div>

    <!-- Search bar -->
    <div class="relative mb-4">
      <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <input
        v-model="search"
        type="text"
        placeholder="Buscar negocio o servicio..."
        class="w-full pl-11 pr-4 py-3 rounded-xl border border-border bg-card text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
      />
    </div>

    <!-- Category filters -->
    <div class="flex gap-2 mb-5 overflow-x-auto pb-1 -mx-4 px-4 scrollbar-hide">
      <button
        v-for="cat in businessCategories"
        :key="cat.id"
        @click="selectedCategory = cat"
        :class="[
          'px-4 py-2 text-xs font-semibold rounded-full whitespace-nowrap transition-all flex-shrink-0',
          selectedCategory === cat
            ? 'bg-primary text-primary-foreground'
            : 'bg-muted text-muted-foreground'
        ]"
      >
        {{ cat.name }}
      </button>
    </div>

    <!-- Results count -->
    <p class="text-xs text-muted-foreground mb-3">
      {{ businesses.length }} negocio{{ businesses.length !== 1 ? 's' : '' }} encontrado{{ businesses.length !== 1 ? 's' : '' }}
    </p>

    <!-- Business cards -->
    <div class="flex flex-col gap-3">
      <Link
        v-for="biz in businesses"
        :key="biz.id"
        :href="`/agendly/client/business/${biz.id}`"
        class="bg-card rounded-xl border border-border p-4 flex gap-4 items-start hover:border-primary/30 transition-colors active:scale-[0.98]"
      >
        <!-- Avatar with category icon -->
        <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" :class="categoryColor(biz.category)">
          <!-- Barberia -->
          <svg v-if="biz.category_id == 1" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 3v12" /><circle cx="18" cy="6" r="3" /><circle cx="6" cy="18" r="3" /><path d="M18 9a9 9 0 0 1-9 9" />
          </svg>
          <!-- Salud -->
          <svg v-else-if="biz.category_id === 2" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
          </svg>
          <!-- Automotriz -->
          <svg v-else-if="biz.category_id === 3" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="7" cy="17" r="2" /><circle cx="17" cy="17" r="2" /><path d="M5 17H3v-6l2-5h14l2 5v6h-2" /><path d="M5 11h14" />
          </svg>
          <!-- Default -->
          <svg v-else class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
          </svg>
        </div>

        <!-- Info -->
        <div class="flex-1 min-w-0">
          <h3 class="text-sm font-bold text-foreground truncate">{{ biz.name }}</h3>
          <p class="text-xs text-primary font-medium mt-0.5">{{ biz.category.name }}</p>
          <p class="text-xs text-muted-foreground mt-1 line-clamp-2">{{ biz.description }}</p>

          <div class="flex items-center gap-1 mt-2 text-xs text-muted-foreground">
            <svg class="w-3 h-3 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" />
            </svg>
            <span class="truncate">{{ biz.address }}</span>
          </div>
        </div>

        <!-- Arrow -->
        <svg class="w-4 h-4 text-muted-foreground flex-shrink-0 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6" />
        </svg>
      </Link>
    </div>

    <!-- Empty state -->
    <div
      v-if="filteredBusinesses.length === 0"
      class="flex flex-col items-center justify-center py-16 text-center"
    >
      <div class="w-16 h-16 rounded-full bg-muted flex items-center justify-center mb-4">
        <svg class="w-8 h-8 text-muted-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8" /><line x1="21" y1="21" x2="16.65" y2="16.65" />
        </svg>
      </div>
      <p class="text-sm font-semibold text-foreground">Sin resultados</p>
      <p class="text-xs text-muted-foreground mt-1">Intenta con otro termino de busqueda o categoria</p>
    </div>
  </div>
  </AgendlyClientLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useStore } from '@/stores/mockData.js'
import AgendlyClientLayout from '@/Layouts/AgendlyClientLayout.vue'

const props = defineProps({
  businesses: Array,
  businessCategories: Array
})

console.log(props.businesses)

const { state } = useStore()

const search = ref('')
const selectedCategory = ref('Todas')

const categories = computed(() => state.categories)

const filteredBusinesses = computed(() => {
  let list = state.businesses
  if (selectedCategory.value !== 'Todas') {
    list = list.filter((b) => b.category === selectedCategory.value)
  }
  if (search.value.trim()) {
    const q = search.value.trim().toLowerCase()
    list = list.filter(
      (b) =>
        b.name.toLowerCase().includes(q) ||
        b.category.toLowerCase().includes(q) ||
        b.description.toLowerCase().includes(q)
    )
  }
  return list
})

const categoryColor = (cat) => {
  const map = {
    Barberia: 'bg-primary/10 text-primary',
    Salud: 'bg-blue-50 text-blue-600',
    Belleza: 'bg-pink-50 text-pink-600',
    Automotriz: 'bg-amber-50 text-amber-600',
  }
  return map[cat] || 'bg-muted text-muted-foreground'
}
</script>
