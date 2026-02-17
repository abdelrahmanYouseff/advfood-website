<script setup>
import { Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { useProductLocale } from '@/composables/useProductLocale'

const { getProductName, getProductDescription } = useProductLocale()

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
    <div v-if="success" class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
      <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
      </svg>
      {{ success }}
    </div>

    <!-- Error Message -->
    <div v-if="error" class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-2">
      <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
      </svg>
      {{ error }}
    </div>

    <!-- Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h2 class="text-lg font-semibold text-gray-900">جميع المنتجات</h2>
        <p class="mt-0.5 text-sm text-gray-500">{{ products?.length || 0 }} منتج</p>
      </div>
      <Link
        :href="route('admin.products.create')"
        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-medium transition-all duration-200 shadow-sm hover:shadow"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        إضافة منتج جديد
      </Link>
    </div>

    <!-- Products Grid -->
    <div v-if="products && products.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <div
        v-for="product in products"
        :key="product.id"
        class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-emerald-100 transition-all duration-300"
      >
        <!-- Image -->
        <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
          <img
            v-if="product.image_url"
            :src="product.image_url"
            :alt="getProductName(product)"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
          />
          <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-teal-500">
            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
          </div>
          <!-- Badges overlay -->
          <div class="absolute top-3 right-3 flex flex-col gap-1.5">
            <span
              class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium shadow-sm"
              :class="product.is_available ? 'bg-emerald-500/95 text-white' : 'bg-gray-500/95 text-white'"
            >
              {{ product.is_available ? 'متاح' : 'غير متاح' }}
            </span>
            <span
              v-if="product.is_featured"
              class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium bg-amber-500/95 text-white shadow-sm"
            >
              مميز
            </span>
          </div>
        </div>

        <!-- Content -->
        <div class="p-4">
          <h3 class="font-semibold text-gray-900 line-clamp-1 group-hover:text-emerald-600 transition-colors">
            {{ getProductName(product) }}
          </h3>
          <p class="mt-1 text-sm text-gray-500 line-clamp-2 min-h-[2.5rem]">
            {{ getProductDescription(product) || 'لا يوجد وصف' }}
          </p>
          <div class="mt-3 flex items-center justify-between">
            <span class="text-lg font-bold text-emerald-600">{{ product.price }} <span class="text-sm font-normal text-gray-500">ريال</span></span>
            <div class="flex gap-2">
              <Link
                :href="route('admin.products.edit', product.id)"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-blue-500 hover:bg-blue-600 text-white transition-colors"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                تعديل
              </Link>
              <button
                @click="handleDeleteClick(product)"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-red-500 hover:bg-red-600 text-white transition-colors"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                حذف
              </button>
            </div>
          </div>
          <div class="mt-3 pt-3 border-t border-gray-100 flex flex-wrap gap-2 text-xs text-gray-500">
            <span class="inline-flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              {{ product.restaurant?.name || '—' }}
            </span>
            <span class="inline-flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </svg>
              {{ product.category?.name || '—' }}
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div v-else class="bg-white rounded-2xl border border-gray-100 shadow-sm p-16 text-center">
      <div class="w-20 h-20 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
      </div>
      <h3 class="text-lg font-semibold text-gray-900">لا توجد منتجات بعد</h3>
      <p class="mt-2 text-gray-500 max-w-sm mx-auto">ابدأ بإضافة أول منتج لعرضه هنا</p>
      <Link
        :href="route('admin.products.create')"
        class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-medium transition-colors"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        إضافة منتج
      </Link>
    </div>
  </AdminLayout>
</template>
