<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <div class="flex items-center">
            <h1 class="text-3xl font-bold text-gray-900">طلباتي</h1>
          </div>
          <div class="flex items-center space-x-4 space-x-reverse">
            <Link
              :href="route('restaurants.index')"
              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700"
            >
              طلب جديد
            </Link>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Empty State -->
      <div v-if="orders.length === 0" class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد طلبات</h3>
        <p class="mt-1 text-sm text-gray-500">ابدأ بالتسوق من مطاعمنا المميزة</p>
        <div class="mt-6">
          <Link
            :href="route('restaurants.index')"
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700"
          >
            تصفح المطاعم
          </Link>
        </div>
      </div>

      <!-- Orders List -->
      <div v-else class="space-y-6">
        <div
          v-for="order in orders"
          :key="order.id"
          class="bg-white rounded-lg shadow hover:shadow-md transition-shadow duration-200"
        >
          <div class="p-6">
            <!-- Order Header -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="flex items-center">
                  <img
                    :src="order.restaurant.logo_url"
                    :alt="order.restaurant.name"
                    class="w-12 h-12 rounded-full object-cover"
                  />
                  <div class="mr-3">
                    <h3 class="text-lg font-semibold text-gray-900">{{ order.restaurant.name }}</h3>
                    <p class="text-sm text-gray-500">رقم الطلب: {{ order.order_number }}</p>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <div class="flex items-center space-x-2 space-x-reverse">
                  <span
                    :class="[
                      'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                      getStatusClass(order.status)
                    ]"
                  >
                    {{ order.status_label }}
                  </span>
                </div>
                <p class="text-lg font-semibold text-orange-600 mt-1">{{ order.formatted_total }}</p>
              </div>
            </div>

            <!-- Order Items Preview -->
            <div class="mb-4">
              <div class="flex items-center space-x-2 space-x-reverse text-sm text-gray-600">
                <span>{{ order.items.length }} منتج</span>
                <span>•</span>
                <span>{{ formatDate(order.created_at) }}</span>
              </div>
              <div class="mt-2 flex flex-wrap gap-2">
                <span
                  v-for="item in order.items.slice(0, 3)"
                  :key="item.id"
                  class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700"
                >
                  {{ item.product_name }} ({{ item.quantity }})
                </span>
                <span
                  v-if="order.items.length > 3"
                  class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700"
                >
                  +{{ order.items.length - 3 }} أكثر
                </span>
              </div>
            </div>

            <!-- Order Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
              <div class="text-sm text-gray-500">
                <p>التوصيل إلى: {{ order.delivery_name }}</p>
                <p>{{ order.delivery_address }}</p>
              </div>
              <div class="flex items-center space-x-3 space-x-reverse">
                <Link
                  :href="route('orders.show', order.id)"
                  class="text-orange-600 hover:text-orange-700 font-medium"
                >
                  عرض التفاصيل
                </Link>
                <Link
                  :href="route('restaurants.show', order.restaurant.id)"
                  class="inline-flex items-center px-3 py-1.5 border border-orange-300 text-sm font-medium rounded-md text-orange-700 bg-orange-50 hover:bg-orange-100"
                >
                  طلب مرة أخرى
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
  orders: Array,
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('ar-EG', {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
    hour12: true
  })
}

const getStatusClass = (status) => {
  switch (status) {
    case 'pending':
      return 'bg-yellow-100 text-yellow-800'
    case 'confirmed':
      return 'bg-blue-100 text-blue-800'
    case 'preparing':
      return 'bg-purple-100 text-purple-800'
    case 'ready':
      return 'bg-indigo-100 text-indigo-800'
    case 'delivering':
      return 'bg-orange-100 text-orange-800'
    case 'delivered':
      return 'bg-green-100 text-green-800'
    case 'cancelled':
      return 'bg-red-100 text-red-800'
    default:
      return 'bg-gray-100 text-gray-800'
  }
}
</script>

