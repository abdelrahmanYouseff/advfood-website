<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
  products: Array,
  success: String,
  error: String
})

const handleDeleteClick = (product) => {
  if (confirm(`هل أنت متأكد من حذف منتج '${product.name}'؟ هذا الإجراء لا يمكن التراجع عنه.`)) {
    router.delete(route('admin.products.destroy', product.id))
  }
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <h1 class="text-2xl font-bold text-gray-900">إدارة المنتجات</h1>
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
        <h2 class="text-lg font-medium text-gray-900">جميع المنتجات</h2>
        <p class="mt-1 text-sm text-gray-500">إجمالي: {{ products?.length || 0 }} منتج</p>
      </div>
      <Link
        :href="route('admin.products.create')"
        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors duration-200"
      >
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        إضافة منتج جديد
      </Link>
    </div>

    <!-- Products Grid -->
    <div class="bg-white shadow-sm rounded-lg">
      <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-medium text-gray-900">جميع المنتجات</h2>
        <p class="mt-1 text-sm text-gray-500">إجمالي: {{ products?.length || 0 }} منتج</p>
      </div>

      <div v-if="products && products.length > 0" class="divide-y divide-gray-200">
        <div v-for="product in products" :key="product.id"
             class="p-6 hover:bg-gray-50 transition-colors duration-200">
          <div class="flex items-center justify-between">
            <!-- Product Info -->
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 rounded-xl overflow-hidden shadow-lg">
                <img
                  v-if="product.image_url"
                  :src="product.image_url"
                  :alt="product.name"
                  class="w-full h-full object-cover"
                />
                <div v-else class="w-full h-full bg-gradient-to-r from-green-500 to-blue-500 flex items-center justify-center">
                  <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                  </svg>
                </div>
              </div>

              <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ product.name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ product.description || 'لا يوجد وصف متاح' }}</p>
                <div class="flex items-center mt-2 space-x-4">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                        :class="product.is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                    {{ product.is_available ? 'متاح' : 'غير متاح' }}
                  </span>
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                        :class="product.is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'">
                    {{ product.is_featured ? 'مميز' : 'عادي' }}
                  </span>
                  <span class="text-sm text-gray-500">
                    السعر: {{ product.price }} ريال
                  </span>
                </div>
              </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-3">
              <Link
                :href="route('admin.products.edit', product.id)"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
              >
                تعديل
              </Link>

              <button
                @click="handleDeleteClick(product)"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
              >
                حذف
              </button>
            </div>
          </div>

          <!-- Additional Info Row -->
          <div class="mt-4 grid grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-gray-600">
            <div>
              <span class="font-medium">المطعم:</span>
              <span class="mr-1">{{ product.restaurant?.name || 'غير محدد' }}</span>
            </div>
            <div>
              <span class="font-medium">الفئة:</span>
              <span class="mr-1">{{ product.category?.name || 'غير محدد' }}</span>
            </div>
            <div>
              <span class="font-medium">ترتيب العرض:</span>
              <span class="mr-1">{{ product.sort_order || '0' }}</span>
            </div>
            <div>
              <span class="font-medium">تاريخ الإنشاء:</span>
              <span class="mr-1">{{ new Date(product.created_at).toLocaleDateString('ar-SA') }}</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="p-12 text-center">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد منتجات بعد</h3>
        <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة أول منتج لك.</p>
        <div class="mt-6">
          <Link
            :href="route('admin.products.create')"
            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700"
          >
            <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            إضافة منتج
          </Link>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
