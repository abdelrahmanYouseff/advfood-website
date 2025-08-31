<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

const props = defineProps({
  product: Object,
  restaurants: Array,
  categories: Array
})

const form = useForm({
  name: props.product.name,
  description: props.product.description,
  price: props.product.price,
  restaurant_id: props.product.restaurant_id,
  category_id: props.product.category_id,
  image: null,
  is_available: props.product.is_available,
  is_featured: props.product.is_featured,
  sort_order: props.product.sort_order || 0
})

const submit = () => {
  form.post(route('admin.products.update', props.product.id), {
    method: 'put'
  })
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <h1 class="text-2xl font-bold text-gray-900">تعديل المنتج</h1>
    </template>

    <div class="max-w-4xl mx-auto">
      <div class="bg-white shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">معلومات المنتج</h2>
          <p class="mt-1 text-sm text-gray-500">تعديل معلومات المنتج: {{ product.name }}</p>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-6">
          <!-- Basic Information -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">اسم المنتج *</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.name }"
              />
              <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
            </div>

            <div>
              <label for="price" class="block text-sm font-medium text-gray-700 mb-2">السعر (ريال) *</label>
              <input
                id="price"
                v-model="form.price"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.price }"
              />
              <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">{{ form.errors.price }}</p>
            </div>
          </div>

          <!-- Restaurant and Category -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="restaurant_id" class="block text-sm font-medium text-gray-700 mb-2">المطعم *</label>
              <select
                id="restaurant_id"
                v-model="form.restaurant_id"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.restaurant_id }"
              >
                <option value="">اختر المطعم</option>
                <option v-for="restaurant in restaurants" :key="restaurant.id" :value="restaurant.id">
                  {{ restaurant.name }}
                </option>
              </select>
              <p v-if="form.errors.restaurant_id" class="mt-1 text-sm text-red-600">{{ form.errors.restaurant_id }}</p>
            </div>

            <div>
              <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">الفئة *</label>
              <select
                id="category_id"
                v-model="form.category_id"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.category_id }"
              >
                <option value="">اختر الفئة</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">{{ form.errors.category_id }}</p>
            </div>
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">وصف المنتج *</label>
            <textarea
              id="description"
              v-model="form.description"
              rows="4"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              :class="{ 'border-red-500': form.errors.description }"
            ></textarea>
            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
          </div>

          <!-- Current Image -->
          <div v-if="product.image_url">
            <label class="block text-sm font-medium text-gray-700 mb-2">الصورة الحالية</label>
            <div class="flex items-center space-x-4">
              <img :src="product.image_url" :alt="product.name" class="w-24 h-24 object-cover rounded-lg border border-gray-300" />
              <div class="text-sm text-gray-600">
                <p>الصورة الحالية للمنتج</p>
                <p class="text-xs text-gray-500">اختر صورة جديدة لتحديثها</p>
              </div>
            </div>
          </div>

          <!-- New Product Image -->
          <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">صورة المنتج الجديدة</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors duration-200">
              <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                  <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                    <span>اختر ملف</span>
                    <input
                      id="image"
                      type="file"
                      @change="form.image = $event.target.files[0]"
                      accept="image/*"
                      class="sr-only"
                    />
                  </label>
                  <p class="mr-1">أو اسحب وأفلت</p>
                </div>
                <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 2MB</p>
              </div>
            </div>
            <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
          </div>

          <!-- Settings -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">ترتيب العرض</label>
              <input
                id="sort_order"
                v-model="form.sort_order"
                type="number"
                min="0"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.sort_order }"
              />
              <p v-if="form.errors.sort_order" class="mt-1 text-sm text-red-600">{{ form.errors.sort_order }}</p>
            </div>

            <div>
              <label class="flex items-center">
                <input
                  v-model="form.is_available"
                  type="checkbox"
                  class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                />
                <span class="mr-2 text-sm font-medium text-gray-700">المنتج متاح</span>
              </label>
            </div>

            <div>
              <label class="flex items-center">
                <input
                  v-model="form.is_featured"
                  type="checkbox"
                  class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                />
                <span class="mr-2 text-sm font-medium text-gray-700">منتج مميز</span>
              </label>
            </div>
          </div>

          <!-- Current Info -->
          <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-700 mb-2">المعلومات الحالية</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
              <div>
                <span class="font-medium">المطعم الحالي:</span>
                <span class="mr-1">{{ product.restaurant?.name || 'غير محدد' }}</span>
              </div>
              <div>
                <span class="font-medium">الفئة الحالية:</span>
                <span class="mr-1">{{ product.category?.name || 'غير محدد' }}</span>
              </div>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3 space-x-reverse">
            <Link
              :href="route('admin.products.index')"
              class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            >
              إلغاء
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="form.processing">جاري التحديث...</span>
              <span v-else>تحديث المنتج</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
