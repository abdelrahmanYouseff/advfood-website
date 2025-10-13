<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center px-4" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <div class="max-w-md w-full">
      <!-- Error Icon -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-100 mb-6 animate-pulse">
          <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $t('Payment Failed') }}</h1>
        <p class="text-gray-600">{{ $t('Unfortunately, your payment could not be processed') }}</p>
      </div>

      <!-- Order Details Card -->
      <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
        <div class="border-b border-gray-200 pb-4 mb-4">
          <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $t('Order Details') }}</h2>
          <p class="text-sm text-gray-600">{{ $t('Order Number') }}: <span class="font-semibold">{{ order.order_number }}</span></p>
        </div>

        <div class="space-y-3">
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">{{ $t('Restaurant') }}</span>
            <span class="font-semibold text-gray-900">{{ order.restaurant?.name }}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">{{ $t('Total Amount') }}</span>
            <span class="font-semibold text-red-600 text-lg">{{ order.total }} {{ $t('SAR') }}</span>
          </div>
          <div class="flex justify-between text-sm">
            <span class="text-gray-600">{{ $t('Status') }}</span>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
              {{ $t('Payment Failed') }}
            </span>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="space-y-3">
        <button
          @click="retryPayment"
          class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center gap-2"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
          </svg>
          {{ $t('Retry Payment') }}
        </button>

        <Link
          :href="`/restaurants/${order.restaurant?.id}`"
          class="w-full bg-white hover:bg-gray-50 text-gray-700 border-2 border-gray-300 py-4 rounded-xl font-semibold text-lg transition-all duration-300 flex items-center justify-center gap-2"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          {{ $t('Back to Restaurant') }}
        </Link>

        <Link
          href="/"
          class="w-full bg-white hover:bg-gray-50 text-gray-700 py-3 rounded-xl font-medium transition-all duration-300 flex items-center justify-center gap-2"
        >
          {{ $t('Go to Home') }}
        </Link>
      </div>

      <!-- Help Text -->
      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          {{ $t('Need help? Contact us at') }}
          <a href="tel:+966123456789" class="text-orange-600 hover:text-orange-700 font-semibold">
            +966 12 345 6789
          </a>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const { t, locale } = useI18n()
const currentLanguage = ref(locale.value || 'ar')

const props = defineProps({
  order: Object,
})

const retryPayment = () => {
  // Redirect back to checkout to retry payment
  router.visit(`/checkout/${props.order.restaurant_id}`)
}
</script>



