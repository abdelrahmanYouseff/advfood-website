<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center space-x-4 space-x-reverse">
            <Link
              :href="route('cart.index')"
              class="text-gray-600 hover:text-gray-900"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </Link>
            <h1 class="text-3xl font-bold text-gray-900">إتمام الطلب</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-8">
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">معلومات التوصيل</h2>
            </div>

            <form @submit.prevent="submitOrder" class="p-6 space-y-6">
              <!-- Delivery Information -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <label for="delivery_name" class="block text-sm font-medium text-gray-700 mb-2">
                    الاسم الكامل *
                  </label>
                  <input
                    id="delivery_name"
                    v-model="form.delivery_name"
                    type="text"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    placeholder="أدخل اسمك الكامل"
                  />
                  <div v-if="errors.delivery_name" class="mt-1 text-sm text-red-600">
                    {{ errors.delivery_name }}
                  </div>
                </div>

                <div>
                  <label for="delivery_phone" class="block text-sm font-medium text-gray-700 mb-2">
                    رقم الهاتف *
                  </label>
                  <input
                    id="delivery_phone"
                    v-model="form.delivery_phone"
                    type="tel"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    placeholder="01xxxxxxxxx"
                  />
                  <div v-if="errors.delivery_phone" class="mt-1 text-sm text-red-600">
                    {{ errors.delivery_phone }}
                  </div>
                </div>
              </div>

              <div>
                <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-2">
                  عنوان التوصيل *
                </label>
                <textarea
                  id="delivery_address"
                  v-model="form.delivery_address"
                  rows="3"
                  required
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                  placeholder="أدخل عنوان التوصيل بالتفصيل"
                ></textarea>
                <div v-if="errors.delivery_address" class="mt-1 text-sm text-red-600">
                  {{ errors.delivery_address }}
                </div>
              </div>

              <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                  ملاحظات إضافية
                </label>
                <textarea
                  id="notes"
                  v-model="form.notes"
                  rows="3"
                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                  placeholder="أي ملاحظات إضافية للطلب (اختياري)"
                ></textarea>
                <div v-if="errors.notes" class="mt-1 text-sm text-red-600">
                  {{ errors.notes }}
                </div>
              </div>

              <!-- Restaurant Info -->
              <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex items-center">
                  <img
                    :src="restaurant.logo_url"
                    :alt="restaurant.name"
                    class="w-12 h-12 rounded-full object-cover"
                  />
                  <div class="mr-3">
                    <h3 class="font-medium text-gray-900">{{ restaurant.name }}</h3>
                    <p class="text-sm text-gray-500">وقت التوصيل المتوقع: {{ restaurant.delivery_time }} دقيقة</p>
                  </div>
                </div>
              </div>

              <!-- Submit Button -->
              <div class="flex justify-end">
                <button
                  type="submit"
                  :disabled="processing"
                  class="bg-orange-600 text-white py-3 px-8 rounded-lg font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  <span v-if="processing">جاري إرسال الطلب...</span>
                  <span v-else>تأكيد الطلب</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-4 mt-8 lg:mt-0">
          <div class="bg-white rounded-lg shadow sticky top-8">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">ملخص الطلب</h2>
            </div>

            <div class="p-6">
              <!-- Cart Items -->
              <div class="space-y-4 mb-6">
                <div
                  v-for="item in cartItems"
                  :key="item.product.id"
                  class="flex items-center space-x-3 space-x-reverse"
                >
                  <img
                    :src="item.product.image_url"
                    :alt="item.product.name"
                    class="w-12 h-12 rounded-lg object-cover"
                  />
                  <div class="flex-1 min-w-0">
                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ item.product.name }}</h3>
                    <p class="text-sm text-gray-500">{{ item.quantity }} × {{ item.product.formatted_price }}</p>
                  </div>
                  <div class="text-right">
                    <p class="text-sm font-medium text-gray-900">{{ formatPrice(item.subtotal) }}</p>
                  </div>
                </div>
              </div>

              <!-- Price Breakdown -->
              <div class="space-y-3 border-t border-gray-200 pt-4">
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">المجموع الفرعي</span>
                  <span class="font-medium">{{ formatPrice(subtotal) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">رسوم التوصيل</span>
                  <span class="font-medium">{{ formatPrice(deliveryFee) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">الضريبة (14%)</span>
                  <span class="font-medium">{{ formatPrice(tax) }}</span>
                </div>
                <div class="border-t border-gray-200 pt-3">
                  <div class="flex justify-between text-lg font-semibold">
                    <span>المجموع الكلي</span>
                    <span class="text-orange-600">{{ formatPrice(total) }}</span>
                  </div>
                </div>
              </div>

              <!-- Estimated Delivery -->
              <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                  </svg>
                  <div class="mr-3">
                    <p class="text-sm font-medium text-blue-900">وقت التوصيل المتوقع</p>
                    <p class="text-sm text-blue-700">{{ estimatedDeliveryTime }}</p>
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
import { ref, computed } from 'vue'
import { Link, router, useForm } from '@inertiajs/vue3'

const props = defineProps({
  cartItems: Array,
  total: Number,
  restaurant: Object,
  errors: Object,
})

const form = useForm({
  delivery_name: '',
  delivery_phone: '',
  delivery_address: '',
  notes: '',
})

const processing = ref(false)

const subtotal = computed(() => {
  return props.cartItems.reduce((sum, item) => sum + item.subtotal, 0)
})

const deliveryFee = computed(() => {
  return props.restaurant.delivery_fee
})

const tax = computed(() => {
  return subtotal.value * 0.14
})

const estimatedDeliveryTime = computed(() => {
  const now = new Date()
  const deliveryTime = new Date(now.getTime() + props.restaurant.delivery_time * 60000)
  return deliveryTime.toLocaleTimeString('ar-EG', {
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  })
})

const formatPrice = (price) => {
  return `${price.toFixed(2)} ريال`
}

const submitOrder = () => {
  processing.value = true

  router.post(route('orders.store'), form.data(), {
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>

