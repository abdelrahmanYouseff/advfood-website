<template>
  <Head title="Gather-us" />
  <div class="min-h-screen flex flex-col" dir="rtl">
    <!-- Main Content -->
    <div
      class="flex-1 flex flex-col items-center justify-center py-16 px-4"
      :style="{ backgroundColor: bgColor }"
    >
      <!-- Logo - Perfect Circle -->
      <div
        class="mb-8 w-40 aspect-square rounded-full overflow-hidden shadow-lg ring-1 ring-black/5 bg-white"
        :class="isBrandBg ? 'ring-white/20' : 'border border-gray-200'"
      >
        <img
          :src="logo"
          alt="Logo"
          class="w-full h-full rounded-full object-cover object-center"
          draggable="false"
        />
      </div>

      <!-- Heading -->
      <h2 class="text-2xl md:text-3xl font-bold mb-8" :class="isBrandBg ? 'text-white' : 'text-gray-800'">
        متواجدين في
      </h2>

      <!-- The Chefz / Jahez Logo - Clickable Link -->
      <a
        :href="linkUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="block transition-transform hover:scale-105 focus:outline-none focus:ring-4 rounded-xl overflow-hidden shadow-xl"
        :class="isBrandBg ? 'focus:ring-white/50' : 'focus:ring-gray-300'"
      >
        <img
          :src="appImage"
          :alt="appImageAlt"
          class="w-36 md:w-40 h-auto object-contain rounded-xl"
        />
      </a>
    </div>

    <AppFooter />
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppFooter from '@/components/AppFooter.vue'

const props = defineProps({
  logo: {
    type: String,
    default: '/images/gatherus-logo.png'
  },
  bgColor: {
    type: String,
    default: '#ffffff'
  },
  linkUrl: {
    type: String,
    default: 'https://thechefzco.app.link/pkk483HvH0b'
  },
  appImage: {
    type: String,
    default: '/icons/the-chefz.webp'
  },
  appImageAlt: {
    type: String,
    default: 'ذا شيفز'
  }
})

const isBrandBg = computed(() => (props.bgColor || '').toLowerCase() === '#cf4823')
</script>
