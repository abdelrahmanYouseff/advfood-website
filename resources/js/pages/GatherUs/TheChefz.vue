<template>
  <Head title="Gather-us" />
  <div class="min-h-screen flex flex-col" dir="rtl">
    <!-- Main Content - White Background -->
    <div class="flex-1 flex flex-col items-center justify-center py-16 px-4 bg-white">
      <!-- Logo - Circular -->
      <div class="mb-8 w-40 h-40 rounded-full p-1 shadow-lg overflow-hidden border border-gray-200 bg-white">
        <img
          :src="logo"
          alt="Logo"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Heading -->
      <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8">
        متواجدين في
      </h2>

      <!-- The Chefz / Jahez Logo - Clickable Link -->
      <a
        :href="linkUrl"
        target="_blank"
        rel="noopener noreferrer"
        class="block transition-transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-300 rounded-xl overflow-hidden shadow-xl"
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
import { Head } from '@inertiajs/vue3'
import AppFooter from '@/components/AppFooter.vue'

defineProps({
  logo: {
    type: String,
    default: '/images/gatherus-logo.png'
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
</script>
