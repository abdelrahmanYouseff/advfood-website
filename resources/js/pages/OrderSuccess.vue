<template>
  <div class="min-h-screen bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center p-4" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
      <!-- Success Header -->
      <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-8 text-center">
        <div class="w-24 h-24 bg-white rounded-full mx-auto mb-4 flex items-center justify-center animate-bounce">
          <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-white mb-2">{{ $t('Order Confirmed!') }}</h1>
        <p class="text-green-50">{{ $t('Thank you for your order') }}</p>
      </div>

      <!-- Order Details -->
      <div class="p-8">
        <div class="bg-gray-50 rounded-lg p-6 mb-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900">{{ $t('Order Details') }}</h2>
            <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
              #{{ order.id }}
            </span>
          </div>

          <div class="space-y-3">
            <div class="flex justify-between">
              <span class="text-gray-600">{{ $t('Restaurant') }}:</span>
              <span class="font-semibold">{{ order.restaurant.name }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">{{ $t('Customer Name') }}:</span>
              <span class="font-semibold">{{ order.customer_name }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">{{ $t('Phone') }}:</span>
              <span class="font-semibold">{{ order.customer_phone }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">{{ $t('Delivery Address') }}:</span>
              <span class="font-semibold text-left">{{ order.address }}</span>
            </div>
            <div class="flex justify-between pt-3 border-t border-gray-200">
              <span class="text-gray-600">{{ $t('Total Amount') }}:</span>
              <span class="text-2xl font-bold text-green-600">{{ order.total }} {{ $t('SAR') }}</span>
            </div>
          </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $t('Order Items') }}</h3>
          <div class="space-y-3">
            <div
              v-for="item in order.items"
              :key="item.id"
              class="flex justify-between items-center p-3 bg-gray-50 rounded-lg"
            >
              <div>
                <p class="font-semibold text-gray-900">{{ item.name }}</p>
                <p class="text-sm text-gray-600">{{ item.quantity }} × {{ item.price }} {{ $t('SAR') }}</p>
              </div>
              <span class="font-semibold text-gray-900">{{ (item.quantity * item.price).toFixed(2) }} {{ $t('SAR') }}</span>
            </div>
          </div>
        </div>

        <!-- Status Info -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
          <div class="flex items-start gap-3">
            <svg class="w-6 h-6 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
              <h4 class="font-semibold text-blue-900 mb-1">{{ $t('What happens next?') }}</h4>
              <p class="text-sm text-blue-800">{{ $t('The restaurant will confirm your order shortly and start preparing it. You will receive updates on your order status.') }}</p>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
          <Link
            href="/"
            class="flex-1 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-3 rounded-lg font-semibold text-center transition-all duration-300 transform hover:scale-105"
          >
            {{ $t('Back to Home') }}
          </Link>
          <Link
            :href="`/restaurants/${order.restaurant.id}`"
            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-lg font-semibold text-center transition-all duration-300"
          >
            {{ $t('Order Again') }}
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const { t, locale } = useI18n()
const currentLanguage = ref(locale.value || 'ar')

const props = defineProps({
  order: Object,
})
</script>
