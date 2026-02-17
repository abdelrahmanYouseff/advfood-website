<template>
  <Head title="Gather-us" />
  <div class="min-h-screen flex flex-col" dir="rtl">
    <!-- Main Content - Teal Green Background -->
    <div class="flex-1 flex flex-col items-center justify-center py-16 px-4" style="background-color: #cf4823;">
      <!-- Logo - Circular with white outline -->
      <div class="mb-8 w-40 h-40 rounded-full p-1 shadow-lg overflow-hidden" style="background-color: #cf4823;">
        <img
          src="/images/gatherus-logo.png"
          alt="Logo"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Heading -->
      <h2 class="text-2xl md:text-3xl font-bold text-white mb-8">
        متواجدين في
      </h2>

      <!-- The Chefz Logo - Clickable Link -->
      <a
        href="https://thechefzco.app.link/pkk483HvH0b"
        target="_blank"
        rel="noopener noreferrer"
        class="block transition-transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-white/50 rounded-xl overflow-hidden shadow-xl"
      >
        <img
          src="/icons/the-chefz.webp"
          alt="ذا شيفز"
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
</script>
