<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center space-x-4 space-x-reverse">
            <Link
              :href="route('orders.index')"
              class="text-gray-600 hover:text-gray-900"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
            </Link>
            <h1 class="text-3xl font-bold text-gray-900">تفاصيل الطلب</h1>
          </div>
          <div class="flex items-center space-x-4 space-x-reverse">
            <span class="text-sm text-gray-500">رقم الطلب: {{ order.order_number }}</span>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-8">
          <!-- Order Status -->
          <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">حالة الطلب</h2>
            </div>
            <div class="p-6">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                      <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </div>
                  <div class="mr-4">
                    <p class="text-sm font-medium text-gray-900">{{ order.status_label }}</p>
                    <p class="text-sm text-gray-500">تم إنشاء الطلب في {{ formatDate(order.created_at) }}</p>
                  </div>
                </div>
                <div class="text-right">
                  <p class="text-lg font-semibold text-orange-600">{{ order.formatted_total }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Order Items -->
          <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">المنتجات المطلوبة</h2>
            </div>
            <div class="divide-y divide-gray-200">
              <div
                v-for="item in order.items"
                :key="item.id"
                class="p-6 flex items-center space-x-4 space-x-reverse"
              >
                <img
                  :src="item.product.image_url"
                  :alt="item.product_name"
                  class="w-16 h-16 rounded-lg object-cover"
                />
                <div class="flex-1 min-w-0">
                  <div class="flex items-center justify-between">
                    <div>
                      <h3 class="text-lg font-medium text-gray-900">{{ item.product_name }}</h3>
                      <p class="text-sm text-gray-500">الكمية: {{ item.quantity }}</p>
                      <p class="text-sm text-gray-500">السعر: {{ formatPrice(item.price) }}</p>
                    </div>
                    <div class="text-right">
                      <p class="text-lg font-semibold text-gray-900">{{ formatPrice(item.total) }}</p>
                    </div>
                  </div>
                  <div v-if="item.notes" class="mt-2">
                    <p class="text-sm text-gray-600">ملاحظات: {{ item.notes }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Delivery Information -->
          <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">معلومات التوصيل</h2>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h3 class="text-sm font-medium text-gray-900 mb-2">اسم المستلم</h3>
                  <p class="text-sm text-gray-600">{{ order.delivery_name }}</p>
                </div>
                <div>
                  <h3 class="text-sm font-medium text-gray-900 mb-2">رقم الهاتف</h3>
                  <p class="text-sm text-gray-600">{{ order.delivery_phone }}</p>
                </div>
                <div class="md:col-span-2">
                  <h3 class="text-sm font-medium text-gray-900 mb-2">عنوان التوصيل</h3>
                  <p class="text-sm text-gray-600">{{ order.delivery_address }}</p>
                </div>
                <div v-if="order.notes" class="md:col-span-2">
                  <h3 class="text-sm font-medium text-gray-900 mb-2">ملاحظات</h3>
                  <p class="text-sm text-gray-600">{{ order.notes }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-4">
          <div class="bg-white rounded-lg shadow sticky top-8">
            <div class="px-6 py-4 border-b border-gray-200">
              <h2 class="text-lg font-semibold text-gray-900">ملخص الطلب</h2>
            </div>

            <div class="p-6">
              <!-- Restaurant Info -->
              <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                  <img
                    :src="order.restaurant.logo_url"
                    :alt="order.restaurant.name"
                    class="w-12 h-12 rounded-full object-cover"
                  />
                  <div class="mr-3">
                    <h3 class="font-medium text-gray-900">{{ order.restaurant.name }}</h3>
                    <p class="text-sm text-gray-500">{{ order.restaurant.address }}</p>
                  </div>
                </div>
              </div>

              <!-- Price Breakdown -->
              <div class="space-y-3">
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">المجموع الفرعي</span>
                  <span class="font-medium">{{ formatPrice(order.subtotal) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">رسوم التوصيل</span>
                  <span class="font-medium">{{ formatPrice(order.delivery_fee) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                  <span class="text-gray-600">الضريبة (14%)</span>
                  <span class="font-medium">{{ formatPrice(order.tax) }}</span>
                </div>
                <div class="border-t border-gray-200 pt-3">
                  <div class="flex justify-between text-lg font-semibold">
                    <span>المجموع الكلي</span>
                    <span class="text-orange-600">{{ formatPrice(order.total) }}</span>
                  </div>
                </div>
              </div>

              <!-- Estimated Delivery -->
              <div v-if="order.estimated_delivery_time" class="mt-6 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                  </svg>
                  <div class="mr-3">
                    <p class="text-sm font-medium text-blue-900">وقت التوصيل المتوقع</p>
                    <p class="text-sm text-blue-700">{{ formatDateTime(order.estimated_delivery_time) }}</p>
                  </div>
                </div>
              </div>

              <!-- Order Actions -->
              <div class="mt-6 space-y-3">
                <Link
                  :href="route('restaurants.show', order.restaurant.id)"
                  class="w-full bg-orange-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors text-center block"
                >
                  طلب مرة أخرى
                </Link>
                <Link
                  :href="route('orders.index')"
                  class="w-full bg-gray-100 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors text-center block"
                >
                  جميع الطلبات
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  order: Object,
})

const formatPrice = (price) => {
  return `${parseFloat(price).toFixed(2)} ريال`
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('ar-EG', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  })
}

const formatDateTime = (date) => {
  return new Date(date).toLocaleString('ar-EG', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  })
}
</script>

