<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header class="bg-gradient-to-r from-orange-500 to-red-500 text-white py-6 shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <h1 class="text-3xl font-bold">{{ $t('Checkout') }}</h1>
          <Link
            :href="`/restaurants/${restaurant.id}`"
            class="flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ $t('Back to Menu') }}
          </Link>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
          <form @submit="submitOrder" ref="checkoutForm" class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $t('Delivery Information') }}</h2>

            <!-- Customer Name -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t('Full Name') }} <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.customer_name"
                type="text"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                :placeholder="$t('Enter your full name')"
              />
              <span v-if="errors.customer_name" class="text-red-500 text-sm mt-1">{{ errors.customer_name }}</span>
            </div>

            <!-- Phone Number -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t('Phone Number') }} <span class="text-red-500">*</span>
              </label>
              <input
                v-model="form.customer_phone"
                type="tel"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                :placeholder="$t('Enter your phone number')"
              />
              <span v-if="errors.customer_phone" class="text-red-500 text-sm mt-1">{{ errors.customer_phone }}</span>
            </div>

            <!-- Address with Map -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t('Delivery Address') }} <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <textarea
                  v-model="form.address"
                  required
                  rows="3"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                  :placeholder="$t('Enter your delivery address')"
                ></textarea>
                <button
                  type="button"
                  @click="getCurrentLocation"
                  class="absolute top-3 left-3 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  {{ $t('Use Current Location') }}
                </button>
              </div>
              <span v-if="errors.address" class="text-red-500 text-sm mt-1">{{ errors.address }}</span>
            </div>

            <!-- Apartment & Building Number -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  {{ $t('Apartment') }}
                </label>
                <input
                  v-model="form.apartment"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                  :placeholder="$t('Apartment number')"
                />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                  {{ $t('Building Number') }}
                </label>
                <input
                  v-model="form.building_number"
                  type="text"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                  :placeholder="$t('Building number')"
                />
              </div>
            </div>

            <!-- Landmark (Optional) -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t('Landmark') }} <span class="text-gray-400 text-xs">({{ $t('Optional') }})</span>
              </label>
              <input
                v-model="form.landmark"
                type="text"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                :placeholder="$t('Nearby landmark or reference point')"
              />
            </div>

            <!-- Notes -->
            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t('Order Notes') }} <span class="text-gray-400 text-xs">({{ $t('Optional') }})</span>
              </label>
              <textarea
                v-model="form.notes"
                rows="3"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all"
                :placeholder="$t('Any special instructions for your order')"
              ></textarea>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="isSubmitting"
              class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="!isSubmitting">{{ $t('Confirm Order') }}</span>
              <span v-else class="flex items-center justify-center gap-2">
                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ $t('Processing...') }}
              </span>
            </button>
          </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-lg sticky top-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-orange-500 to-red-500">
              <h3 class="text-xl font-semibold text-white">{{ $t('Order Summary') }}</h3>
            </div>

            <div class="p-6">
              <!-- Restaurant Info -->
              <div class="mb-6 pb-6 border-b border-gray-200">
                <h4 class="font-semibold text-gray-900 mb-2">{{ restaurant.name }}</h4>
                <p class="text-sm text-gray-600">{{ restaurant.address }}</p>
              </div>

              <!-- Cart Items -->
              <div class="space-y-4 mb-6">
                <div
                  v-for="item in cartItems"
                  :key="item.id"
                  class="flex gap-3"
                >
                  <img
                    :src="item.image_url"
                    :alt="item.name"
                    class="w-16 h-16 rounded-lg object-cover"
                  />
                  <div class="flex-1">
                    <h5 class="font-semibold text-sm text-gray-900">{{ item.name }}</h5>
                    <p class="text-sm text-gray-600">{{ item.quantity }} × {{ item.price }} {{ $t('SAR') }}</p>
                    <p class="text-sm font-semibold text-orange-500">{{ (item.quantity * item.price).toFixed(2) }} {{ $t('SAR') }}</p>
                  </div>
                </div>
              </div>

              <!-- Price Summary -->
              <div class="space-y-2 pt-6 border-t border-gray-200">
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">{{ $t('Subtotal') }}</span>
                  <span class="font-semibold">{{ cartSubtotal.toFixed(2) }} {{ $t('SAR') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">{{ $t('Delivery Fee') }}</span>
                  <span class="font-semibold">{{ restaurant.delivery_fee }} {{ $t('SAR') }}</span>
                </div>
                <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                  <span>{{ $t('Total') }}</span>
                  <span class="text-orange-500">{{ cartTotal.toFixed(2) }} {{ $t('SAR') }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const { t, locale } = useI18n()
const currentLanguage = ref(locale.value || 'ar')

const props = defineProps({
  restaurant: Object,
})

// Get cart items from localStorage
const cartItems = ref([])
if (typeof window !== 'undefined') {
  const savedCart = localStorage.getItem('cart')
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart)
  }
}

// Form data
const form = ref({
  restaurant_id: props.restaurant.id,
  customer_name: '',
  customer_phone: '',
  address: '',
  latitude: null,
  longitude: null,
  apartment: '',
  building_number: '',
  landmark: '',
  notes: '',
})

const errors = ref({})
const isSubmitting = ref(false)

// Computed properties
const cartSubtotal = computed(() => {
  return cartItems.value.reduce((total, item) => {
    return total + (item.price * item.quantity)
  }, 0)
})

const cartTotal = computed(() => {
  return cartSubtotal.value + parseFloat(props.restaurant.delivery_fee || 0)
})

// Get current location
const getCurrentLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        form.value.latitude = position.coords.latitude
        form.value.longitude = position.coords.longitude

        // Reverse geocoding to get address
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
          .then(response => response.json())
          .then(data => {
            form.value.address = data.display_name
          })
          .catch(error => {
            console.error('Error getting address:', error)
            alert(t('Could not get address from location'))
          })
      },
      (error) => {
        console.error('Error getting location:', error)
        alert(t('Could not get your location. Please enter address manually.'))
      }
    )
  } else {
    alert(t('Geolocation is not supported by your browser'))
  }
}

// Submit order
const submitOrder = (event) => {
  console.log('Submit Order clicked')
  console.log('Cart Items:', cartItems.value)

  if (cartItems.value.length === 0) {
    event.preventDefault()
    alert(t('Your cart is empty'))
    console.error('Cart is empty!')
    return
  }

  isSubmitting.value = true
  errors.value = {}

  const orderData = {
    ...form.value,
    items: cartItems.value,
    subtotal: cartSubtotal.value,
    delivery_fee: parseFloat(props.restaurant.delivery_fee),
    total: cartTotal.value,
  }

  console.log('Sending order data:', orderData)

  // Prevent default form submission
  event.preventDefault()

  // Send AJAX request to get redirect URL
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

  fetch(`/checkout/${props.restaurant.id}/process`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify(orderData)
  })
  .then(response => {
    console.log('Response status:', response.status)
    console.log('Response headers:', response.headers)
    return response.json()
  })
  .then(data => {
    console.log('Response data:', data)
    if (data.success && data.redirect_url) {
      console.log('Redirecting to:', data.redirect_url)
      // Redirect to Noon Payment
      window.location.href = data.redirect_url
    } else {
      console.error('Invalid response:', data)
      alert('حدث خطأ في معالجة الطلب')
      isSubmitting.value = false
    }
  })
  .catch(error => {
    console.error('Error:', error)
    alert('حدث خطأ في معالجة الطلب')
    isSubmitting.value = false
  })
}
</script>
