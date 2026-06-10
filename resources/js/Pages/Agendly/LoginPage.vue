<template>
  <div class="min-h-screen flex flex-col bg-background">
    <!-- Back button -->
    <header class="px-4 py-4">
      <Link href="/agendly" class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-foreground transition-colors">
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12" />
          <polyline points="12 19 5 12 12 5" />
        </svg>
        Volver
      </Link>
    </header>

    <main class="flex-1 flex items-center justify-center px-4 pb-8">
      <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="flex flex-col items-center mb-8">
          <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center mb-3">
            <svg class="w-7 h-7 text-primary-foreground" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
              <line x1="16" y1="2" x2="16" y2="6" />
              <line x1="8" y1="2" x2="8" y2="6" />
              <line x1="3" y1="10" x2="21" y2="10" />
            </svg>
          </div>
          <h1 class="text-2xl font-extrabold text-foreground">Bienvenido de vuelta</h1>
          <p class="text-sm text-muted-foreground mt-1">Inicia sesion en tu cuenta de Agendly</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="handleLogin" class="flex flex-col gap-4">
          <div>
            <label for="email" class="block text-sm font-medium text-foreground mb-1.5">Correo electronico</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              placeholder="tu@correo.com"
              class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors"
            />
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-foreground mb-1.5">Contrasena</label>
            <div class="relative">
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                placeholder="Tu contrasena"
                class="w-full px-4 py-3 rounded-xl border border-border bg-card text-foreground placeholder:text-muted-foreground text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-colors pr-12"
              />
              <button
                type="button"
                @click="showPassword = !showPassword"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground transition-colors"
                :aria-label="showPassword ? 'Ocultar contrasena' : 'Mostrar contrasena'"
              >
                <svg v-if="!showPassword" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                  <circle cx="12" cy="12" r="3" />
                </svg>
                <svg v-else class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" />
                  <line x1="1" y1="1" x2="23" y2="23" />
                </svg>
              </button>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
              <input type="checkbox" v-model="rememberMe" class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30" />
              <span class="text-xs text-muted-foreground">Recordarme</span>
            </label>
            <a href="#" class="text-xs font-medium text-primary hover:underline">Olvide mi contrasena</a>
          </div>

          <button
            type="submit"
            class="w-full py-3.5 bg-primary text-primary-foreground font-semibold rounded-xl text-sm hover:opacity-90 transition-opacity mt-2"
          >
            Iniciar sesion
          </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center gap-3 my-6">
          <div class="flex-1 h-px bg-border"></div>
          <span class="text-xs text-muted-foreground">o continua con</span>
          <div class="flex-1 h-px bg-border"></div>
        </div>

        <!-- Social login -->
        <button
          type="button"
          class="w-full flex items-center justify-center gap-2 py-3 border border-border rounded-xl text-sm font-medium text-foreground hover:bg-muted/50 transition-colors"
        >
          <svg class="w-5 h-5" viewBox="0 0 24 24">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
          </svg>
          Google
        </button>

        <!-- Sign up link -->
        <p class="text-center text-sm text-muted-foreground mt-6">
          No tienes cuenta?
          <router-link to="/registro" class="font-semibold text-primary hover:underline">Registrate</router-link>
        </p>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from '@inertiajs/vue3';

const email = ref('')
const password = ref('')
const showPassword = ref(false)
const rememberMe = ref(false)

const form = useForm({
    email: '',
    password: '',
});


const handleLogin = () => {
  form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}
</script>
