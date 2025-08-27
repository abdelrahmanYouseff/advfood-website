<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 via-yellow-50 to-orange-50">
    <!-- Enhanced Header -->
    <header class="bg-white/90 backdrop-blur-sm shadow-lg border-b border-white/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center space-x-6">
            <Link
              :href="route('restaurants.index')"
              class="group p-3 bg-gradient-to-r from-red-100 to-orange-100 rounded-xl hover:from-red-200 hover:to-orange-200 transition-all duration-200 shadow-lg hover:shadow-xl"
            >
              <svg class="w-6 h-6 text-red-600 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </Link>
            <div class="flex items-center space-x-3">
              <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-10 w-10 rounded-lg shadow-sm">
              <div>
                <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                <p class="text-gray-600">{{ cartItems.length }} items in your cart</p>
              </div>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <button
              v-if="cartItems.length > 0"
              @click="clearCart"
              class="px-6 py-3 text-red-600 hover:text-red-700 font-semibold hover:bg-red-50 rounded-xl transition-all duration-200"
            >
              Clear Cart
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <!-- Enhanced Cart Items -->
        <div class="lg:col-span-8">
          <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20">
            <div class="px-8 py-6 border-b border-gray-200">
              <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                Selected Items
              </h2>
            </div>

            <!-- Enhanced Empty Cart -->
            <div v-if="cartItems.length === 0" class="p-16 text-center">
              <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h3>
              <p class="text-gray-600 mb-8 max-w-md mx-auto">Start shopping from our amazing restaurants and discover delicious food</p>
              <Link
                :href="route('restaurants.index')"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
                Browse Restaurants
              </Link>
            </div>

            <!-- Enhanced Cart Items List -->
            <div v-else class="divide-y divide-gray-200">
              <div
                v-for="item in cartItems"
                :key="item.product.id"
                class="p-8 flex items-center space-x-6 group hover:bg-gray-50/50 transition-all duration-200"
              >
                <!-- Enhanced Product Image -->
                <div class="flex-shrink-0">
                  <div class="relative">
                    <img
                      :src="item.product.image_url"
                      :alt="item.product.name"
                      class="w-24 h-24 rounded-2xl object-cover shadow-lg group-hover:shadow-xl transition-shadow duration-200"
                      @error="$event.target.src = '/images/default-product.png'"
                    />
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                      {{ item.quantity }}
                    </div>
                  </div>
                </div>

                <!-- Enhanced Product Info -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-start justify-between">
                    <div class="flex-1">
                      <h3 class="text-xl font-bold text-gray-900 mb-2">{{ item.product.name }}</h3>
                      <p class="text-gray-600 mb-1">{{ item.product.restaurant?.name || 'مطعم غير محدد' }}</p>
                      <p class="text-lg font-semibold text-red-600">{{ item.product.formatted_price }}</p>
                    </div>
                    <div class="text-right">
                      <p class="text-2xl font-bold text-gray-900">{{ formatPrice(item.subtotal) }} ريال</p>
                    </div>
                  </div>

                  <!-- Enhanced Quantity Controls -->
                  <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                      <button
                        @click="updateQuantity(item.product.id, item.quantity - 1)"
                        :disabled="item.quantity <= 1"
                        class="w-12 h-12 rounded-full bg-gradient-to-r from-red-100 to-orange-100 text-red-600 hover:from-red-200 hover:to-orange-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110"
                      >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                      </button>
                      <span class="w-16 text-center text-2xl font-bold text-gray-900">{{ item.quantity }}</span>
                      <button
                        @click="updateQuantity(item.product.id, item.quantity + 1)"
                        class="w-12 h-12 rounded-full bg-gradient-to-r from-red-100 to-orange-100 text-red-600 hover:from-red-200 hover:to-orange-200 flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110"
                      >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                      </button>
                    </div>
                    <button
                      @click="removeItem(item.product.id)"
                      class="px-6 py-3 text-red-600 hover:text-red-700 font-semibold hover:bg-red-50 rounded-xl transition-all duration-200 flex items-center"
                    >
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Remove
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Enhanced Order Summary -->
        <div class="lg:col-span-4 mt-8 lg:mt-0">
          <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 sticky top-8">
            <div class="px-8 py-6 border-b border-gray-200">
              <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Order Summary
              </h2>
            </div>

            <div class="p-8">
              <!-- Enhanced Restaurant Info -->
              <div v-if="cartItems.length > 0 && cartItems[0].product.restaurant" class="mb-8 p-6 bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl border border-red-100">
                <div class="flex items-center">
                  <img
                    :src="cartItems[0].product.restaurant.logo_url"
                    :alt="cartItems[0].product.restaurant.name"
                    class="w-16 h-16 rounded-2xl object-cover border-4 border-white shadow-lg"
                    @error="$event.target.src = '/images/default-restaurant-logo.png'"
                  />
                  <div class="ml-4">
                    <h3 class="text-lg font-bold text-gray-900">{{ cartItems[0].product.restaurant.name }}</h3>
                    <p class="text-gray-600 flex items-center">
                      <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                      </svg>
                      {{ cartItems[0].product.restaurant.delivery_time || 0 }} min delivery
                    </p>
                  </div>
                </div>
              </div>

              <!-- Enhanced Price Breakdown -->
              <div class="space-y-4">
                <div class="flex justify-between text-lg">
                  <span class="text-gray-600">Subtotal</span>
                  <span class="font-semibold">{{ formatPrice(subtotal) }} ريال</span>
                </div>
                <div class="flex justify-between text-lg">
                  <span class="text-gray-600">Delivery Fee</span>
                  <span class="font-semibold">{{ formatPrice(deliveryFee) }} ريال</span>
                </div>
                <div class="flex justify-between text-lg">
                  <span class="text-gray-600">Tax (14%)</span>
                  <span class="font-semibold">{{ formatPrice(tax) }} ريال</span>
                </div>
                <div class="border-t border-gray-200 pt-4">
                  <div class="flex justify-between text-2xl font-bold">
                    <span>Total</span>
                    <span class="text-red-600">{{ formatPrice(totalAmount) }} ريال</span>
                  </div>
                </div>
              </div>

              <!-- Enhanced Checkout Button -->
              <div class="mt-8">
                <Link
                  v-if="cartItems.length > 0"
                  :href="route('checkout')"
                  class="w-full bg-gradient-to-r from-red-500 to-orange-500 text-white py-4 px-6 rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 text-center block shadow-xl hover:shadow-2xl transform hover:scale-105"
                >
                  <span class="flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Proceed to Checkout
                  </span>
                </Link>
                <button
                  v-else
                  disabled
                  class="w-full bg-gray-300 text-gray-500 py-4 px-6 rounded-2xl font-bold cursor-not-allowed"
                >
                  Proceed to Checkout
                </button>
              </div>

              <!-- Enhanced Minimum Order Warning -->
              <div v-if="cartItems.length > 0 && subtotal < minimumOrder" class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-2xl">
                <div class="flex items-start">
                  <svg class="w-6 h-6 text-yellow-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  <div>
                    <p class="text-sm text-yellow-800 font-medium">
                      Minimum order is {{ formatPrice(minimumOrder) }} ريال
                    </p>
                    <p class="text-sm text-yellow-700 mt-1">
                      Add more items to complete your order
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  cartItems: Array,
  total: Number,
})

const subtotal = computed(() => {
  if (!props.cartItems || props.cartItems.length === 0) return 0
  return props.cartItems.reduce((sum, item) => {
    const itemSubtotal = parseFloat(item.subtotal) || 0
    return sum + itemSubtotal
  }, 0)
})

const deliveryFee = computed(() => {
  if (!props.cartItems || props.cartItems.length === 0) return 0
  if (!props.cartItems[0].product.restaurant) return 0
  const fee = parseFloat(props.cartItems[0].product.restaurant.delivery_fee) || 0
  return fee
})

const tax = computed(() => {
  return subtotal.value * 0.14
})

const minimumOrder = computed(() => {
  if (!props.cartItems || props.cartItems.length === 0) return 0
  if (!props.cartItems[0].product.restaurant) return 0
  const minOrder = parseFloat(props.cartItems[0].product.restaurant.minimum_order) || 0
  return minOrder
})

const totalAmount = computed(() => {
  return parseFloat(props.total) || 0
})

const formatPrice = (price) => {
  if (price === null || price === undefined) return '0.00'
  const numPrice = parseFloat(price)
  if (isNaN(numPrice)) return '0.00'
  return numPrice.toFixed(2)
}

const updateQuantity = (productId, quantity) => {
  if (quantity < 1) return

  router.put(route('cart.update', productId), {
    quantity: quantity
  })
}

const removeItem = (productId) => {
  router.delete(route('cart.remove', productId))
}

const clearCart = () => {
  if (confirm('Are you sure you want to clear your cart?')) {
    router.delete(route('cart.clear'))
  }
}
</script>
