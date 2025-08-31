<script setup>
import { Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({
  stats: Object
})
</script>

<template>
  <AdminLayout>
    <template #header>
      <h1 class="text-2xl font-bold text-gray-900">لوحة التحكم</h1>
    </template>

    <!-- Content -->
    <div>
      <!-- Welcome Section -->
      <div class="mb-8 bg-gradient-to-r from-green-600 to-blue-600 rounded-xl p-6 text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img src="/Foods Logo.png" alt="شعار ADVFood" class="h-12 w-12 rounded-lg shadow-lg">
          </div>
          <div class="mr-4">
            <h2 class="text-2xl font-bold">مرحباً بك في لوحة تحكم ADVFood</h2>
            <p class="text-green-100">إدارة المطاعم والمنتجات والطلبات بسهولة</p>
          </div>
        </div>
      </div>

      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Orders -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
          <div class="p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                  </svg>
                </div>
              </div>
              <div class="mr-4 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">إجمالي الطلبات</dt>
                  <dd class="text-2xl font-bold text-gray-900">{{ stats.total_orders }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Products -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
          <div class="p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                  </svg>
                </div>
              </div>
              <div class="mr-4 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">إجمالي المنتجات</dt>
                  <dd class="text-2xl font-bold text-gray-900">{{ stats.total_products }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Restaurants -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
          <div class="p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                </div>
              </div>
              <div class="mr-4 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">إجمالي المطاعم</dt>
                  <dd class="text-2xl font-bold text-gray-900">{{ stats.total_restaurants }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
          <div class="p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                  </svg>
                </div>
              </div>
              <div class="mr-4 w-0 flex-1">
                <dl>
                  <dt class="text-sm font-medium text-gray-500 truncate">إجمالي المستخدمين</dt>
                  <dd class="text-2xl font-bold text-gray-900">{{ stats.total_users }}</dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="bg-white shadow-lg rounded-xl border border-gray-100 mb-8">
        <div class="px-6 py-6">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-900">الطلبات الحديثة</h3>
            <Link
              :href="route('admin.orders.index')"
              class="text-green-600 hover:text-green-700 text-sm font-medium"
            >
              عرض جميع الطلبات →
            </Link>
          </div>
          <div class="overflow-hidden">
            <div v-if="stats.recent_orders && stats.recent_orders.length > 0" class="space-y-4">
              <div v-for="order in stats.recent_orders" :key="order.id" class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                      </svg>
                    </div>
                    <div>
                      <p class="text-sm font-bold text-gray-900">طلب رقم #{{ order.id }}</p>
                      <p class="text-sm text-gray-500">{{ order.user?.name || 'زائر' }}</p>
                    </div>
                  </div>
                  <div class="text-left">
                    <p class="text-sm font-bold text-gray-900">{{ order.total_amount }} ريال</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                          :class="{
                            'bg-green-100 text-green-800': order.status === 'completed',
                            'bg-yellow-100 text-yellow-800': order.status === 'pending',
                            'bg-red-100 text-red-800': order.status === 'cancelled',
                            'bg-blue-100 text-blue-800': order.status === 'processing'
                          }">
                      {{ order.status === 'completed' ? 'مكتمل' :
                         order.status === 'pending' ? 'في الانتظار' :
                         order.status === 'cancelled' ? 'ملغي' :
                         order.status === 'processing' ? 'قيد المعالجة' : order.status }}
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="text-center py-12">
              <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-gray-900 mb-2">لا توجد طلبات بعد</h3>
              <p class="text-gray-500">ستظهر الطلبات هنا عندما يبدأ العملاء في تقديم طلباتهم.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-shadow duration-200">
          <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mr-3">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">إدارة المطاعم</h3>
          </div>
          <p class="text-sm text-gray-500 mb-6">إضافة أو تعديل أو حذف المطاعم من المنصة.</p>
          <Link
            :href="route('admin.restaurants.index')"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-xl text-sm font-bold transition-colors duration-200 inline-block text-center shadow-lg hover:shadow-xl"
          >
            إدارة المطاعم
          </Link>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-shadow duration-200">
          <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center mr-3">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">إدارة المنتجات</h3>
          </div>
          <p class="text-sm text-gray-500 mb-6">إضافة أو تعديل أو حذف المنتجات من المطاعم.</p>
          <Link
            :href="route('admin.products.index')"
            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-xl text-sm font-bold transition-colors duration-200 inline-block text-center shadow-lg hover:shadow-xl"
          >
            إدارة المنتجات
          </Link>
        </div>

        <div class="bg-white shadow-lg rounded-xl border border-gray-100 p-6 hover:shadow-xl transition-shadow duration-200">
          <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center mr-3">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">عرض جميع الطلبات</h3>
          </div>
          <p class="text-sm text-gray-500 mb-6">عرض وإدارة جميع طلبات العملاء.</p>
          <Link
            :href="route('admin.orders.index')"
            class="w-full bg-purple-500 hover:bg-purple-600 text-white px-4 py-3 rounded-xl text-sm font-bold transition-colors duration-200 inline-block text-center shadow-lg hover:shadow-xl"
          >
            عرض الطلبات
          </Link>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
