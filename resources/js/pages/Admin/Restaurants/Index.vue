<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

defineProps({
  restaurants: Array,
  success: String,
  error: String
})

const handleDeleteClick = (restaurant) => {
  if (confirm(`هل أنت متأكد من حذف مطعم '${restaurant.name}'؟ هذا الإجراء لا يمكن التراجع عنه.`)) {
    router.delete(route('admin.restaurants.destroy', restaurant.id))
  }
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <h1 class="text-2xl font-bold text-gray-900">إدارة المطاعم</h1>
    </template>

    <!-- Success Message -->
    <div v-if="success" class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
      {{ success }}
    </div>

    <!-- Error Message -->
    <div v-if="error" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
      {{ error }}
    </div>

    <!-- Header Actions -->
    <div class="mb-6 flex justify-between items-center">
      <div>
        <h2 class="text-lg font-medium text-gray-900">جميع المطاعم</h2>
        <p class="mt-1 text-sm text-gray-500">إجمالي: {{ restaurants?.length || 0 }} مطعم</p>
      </div>
      <Link
        :href="route('admin.restaurants.create')"
        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors duration-200"
      >
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        إضافة مطعم جديد
      </Link>
    </div>

    <!-- Restaurants Grid -->
    <div class="bg-white shadow-sm rounded-lg">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900">جميع المطاعم</h2>
        <p class="mt-1 text-sm text-gray-500">إجمالي: {{ restaurants?.length || 0 }} مطعم</p>
      </div>

      <div v-if="restaurants && restaurants.length > 0" class="divide-y divide-gray-200">
        <div v-for="restaurant in restaurants" :key="restaurant.id"
             class="p-6 hover:bg-gray-50 transition-colors duration-200">
          <div class="flex items-center justify-between">
            <!-- Restaurant Info -->
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 rounded-xl overflow-hidden shadow-lg">
                <img
                  v-if="restaurant.logo_url"
                  :src="restaurant.logo_url"
                  :alt="restaurant.name + ' شعار'"
                  class="w-full h-full object-cover"
                  @error="console.log('فشل تحميل الصورة:', restaurant.logo_url)"
                  @load="console.log('تم تحميل الصورة بنجاح:', restaurant.logo_url)"
                />
                <div v-else class="w-full h-full bg-gradient-to-r from-green-500 to-blue-500 flex items-center justify-center">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                </div>
              </div>

              <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ restaurant.name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ restaurant.description || 'لا يوجد وصف متاح' }}</p>
                <div class="flex items-center mt-2 space-x-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                        :class="restaurant.is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                    {{ restaurant.is_active ? 'نشط' : 'غير نشط' }}
                  </span>
                  <span class="text-sm text-gray-500">
                    المنتجات: {{ restaurant.products_count || 0 }}
                  </span>
                  <span class="text-sm text-gray-500">
                    التقييم: {{ restaurant.rating ? restaurant.rating + '/5' : 'غير متاح' }}
                  </span>
                  <span class="text-sm text-gray-500">
                    وقت التوصيل: {{ restaurant.delivery_time || 0 }} دقيقة
                  </span>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-3">
              <Link
                :href="route('admin.restaurants.edit', restaurant.id)"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
              >
                تعديل
              </Link>

              <button
                @click="handleDeleteClick(restaurant)"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
              >
                <span v-if="restaurant.products_count > 0" class="text-xs block">🗑️ حذف مع المنتجات</span>
                <span v-else>حذف</span>
              </button>
            </div>
          </div>

          <!-- Additional Info Row -->
          <div class="mt-4 grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600">
            <div>
              <span class="font-medium">العنوان:</span>
              <span class="mr-1">{{ restaurant.address || 'غير متاح' }}</span>
            </div>
            <div>
              <span class="font-medium">الهاتف:</span>
              <span class="mr-1">{{ restaurant.phone || 'غير متاح' }}</span>
            </div>
            <div>
              <span class="font-medium">رسوم التوصيل:</span>
              <span class="mr-1">{{ restaurant.delivery_fee || '0' }} ريال</span>
            </div>
            <div>
              <span class="font-medium">الحد الأدنى للطلب:</span>
              <span class="mr-1">{{ restaurant.minimum_order || '0' }} ريال</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد مطاعم بعد</h3>
        <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة أول مطعم لك.</p>
        <div class="mt-6">
          <Link
            :href="route('admin.restaurants.create')"
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
          >
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            إضافة مطعم
          </Link>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
