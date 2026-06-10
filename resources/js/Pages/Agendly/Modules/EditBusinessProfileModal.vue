<template>
  <div v-if="show" class="fixed inset-0 z-[60] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-background/80 backdrop-blur-sm" @click="$emit('close')"></div>
    
    <div class="relative bg-card w-full max-w-lg rounded-2xl border border-border shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
      
      <div class="p-6 border-b border-border flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold text-foreground">Configuración de Perfil</h2>
          <p class="text-xs text-muted-foreground">Actualiza tu información personal y de negocio</p>
        </div>
        <button @click="$emit('close')" class="text-muted-foreground hover:text-foreground transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
      </div>

      <div class="p-6 overflow-y-auto">
        <form @submit.prevent="submit" class="space-y-5">
          
          <div v-if="user.business" class="space-y-4 p-4 rounded-2xl bg-muted/30 border border-border">
            <h3 class="text-xs font-bold uppercase tracking-wider text-primary">Información del Negocio</h3>

            <div>
              <label class="block text-sm font-medium mb-1.5">Nombre del negocio</label>
              <input v-model="form.business_name" type="text" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm focus:ring-2 focus:ring-primary/30 outline-none" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Categoría</label>
                    <select v-model="form.business_category_id" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none">
                        <option v-for="cat in businessCategories" :key="cat.id" :value="cat.id">{{ cat.description }}</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Teléfono</label>
                    <input v-model="form.business_phone" type="text" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none" />
                </div>
            </div>
            
            <div>
              <label class="block text-sm font-medium mb-1.5">Descripción Corta</label>
              <textarea v-model="form.business_description" rows="2" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none"></textarea>
            </div>
          </div>

          <div class="space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Cuenta de Usuario</h3>
            
            <div>
              <label class="block text-sm font-medium mb-1.5">Tu Nombre</label>
              <input v-model="form.name" type="text" required class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none" />
            </div>

            <div>
              <label class="block text-sm font-medium mb-1.5">Correo Electrónico</label>
              <input v-model="form.email" type="email" required class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none" />
            </div>

            <!-- <div>
              <label class="block text-sm font-medium mb-1.5">Nueva Contraseña (opcional)</label>
              <input v-model="form.password" type="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-border bg-card text-sm outline-none" />
            </div> -->
          </div>

          <div class="flex gap-3 pt-2">
            <button type="button" @click="$emit('close')" class="flex-1 py-3 text-sm font-semibold text-muted-foreground hover:bg-muted rounded-xl transition-colors">
              Cancelar
            </button>
            <button type="submit" :disabled="form.processing" class="flex-1 py-3 bg-primary text-primary-foreground font-semibold rounded-xl text-sm hover:opacity-90 disabled:opacity-50 transition-all">
              {{ form.processing ? 'Guardando...' : 'Guardar Cambios' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
  show: Boolean,
  user: Object,
  businessCategories: Array
});

const emit = defineEmits(['close']);

// Inicializar el formulario con los datos recibidos por props
const form = useForm({
  name: props.user?.name || '',
  email: props.user?.email || '',
  password: '',
  business_name: props.user?.business?.name || '',
  business_category_id: props.user?.business?.business_category_id || '',
  business_description: props.user?.business?.description || '',
  business_phone: props.user?.business?.phone || '',
  business_address: props.user?.business?.address || '',
});

// Sincronizar el formulario si el usuario cambia mientras el modal está abierto
watch(() => props.user, (newUser) => {
  if (newUser) {
    form.name = newUser.name;
    form.email = newUser.email;
    form.business_name = newUser.business?.name || '';
    form.business_category_id = newUser.business?.business_category_id || '';
    form.business_description = newUser.business?.description || '';
    form.business_phone = newUser.business?.phone || '';
    form.business_address = newUser.business?.address || '';
  }
}, { deep: true });

const submit = () => {
  form.post(route('agendly.resgister.update'), {
    preserveScroll: true,
    onSuccess: () => emit('close'),
  });
};
</script>