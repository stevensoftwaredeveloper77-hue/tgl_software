<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()

const currentPath = computed(() => window.location.pathname)

const navItems = [
  {
    href: '/agendly/business',
    label: 'Citas',
    icon: '<rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" />',
  },
  {
    href: '/agendly/business/configuration',
    label: 'Horario',
    icon: '<circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" />',
  },
  {
    href: '/agendly/business/profile',
    label: 'Perfil',
    icon: '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" />',
  },
]

const isActive = (path) => {
  if (path === '/negocio') return currentPath.value === '/negocio'
  return currentPath.value.startsWith(path)
}
</script>

<template>
  <div class="min-h-screen flex flex-col bg-background pb-20">
    <header class="sticky top-0 z-40 bg-background/80 backdrop-blur-lg border-b border-border">
      <div class="flex items-center justify-between px-4 py-3">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
            <svg class="w-5 h-5 text-primary-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
          </div>
          <span class="text-lg font-bold text-foreground tracking-tight">Agendly</span>
        </div>

        <Link
          href="/agendly/logout"
          method="post"
          as="button"
          class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-muted-foreground hover:text-foreground border border-border rounded-lg transition-colors"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
          Salir
        </Link>
      </div>
    </header>

    <main class="flex-1">
      <slot/>
    </main>

    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-card border-t border-border safe-area-bottom">
      <div class="flex items-center justify-around px-2 py-2">
        <Link
          v-for="item in navItems"
          :key="item.href"
          :href="item.href"
          class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors min-w-[64px]"
          :class="isActive(item.href) ? 'text-primary' : 'text-muted-foreground'"
        >
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" v-html="item.icon"></svg>
          <span class="text-[10px] font-semibold">{{ item.label }}</span>
        </Link>
      </div>
    </nav>
  </div>
</template>

<style scoped>
.safe-area-bottom {
  padding-bottom: env(safe-area-inset-bottom, 0px);
}
</style>