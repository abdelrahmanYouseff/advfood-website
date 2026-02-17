<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'

const props = defineProps({
  restaurant: Object
})

const form = useForm({
  name: props.restaurant.name,
  description: props.restaurant.description || '',
  address: props.restaurant.address,
  phone: props.restaurant.phone,
  email: props.restaurant.email || '',
  delivery_time: props.restaurant.delivery_time,
  delivery_fee: props.restaurant.delivery_fee,
  minimum_order: props.restaurant.minimum_order,
  rating: props.restaurant.rating || 0,
  is_active: props.restaurant.is_active ?? true,
  logo: null,
  cover_image: null
})

const submit = () => {
  form.transform((data) => ({
    ...data,
    _method: 'put'
  })).post(route('admin.restaurants.update', props.restaurant.id))
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <div class="flex items-center gap-3">
        <Link
          :href="route('admin.restaurants.index')"
          class="p-2 rounded-lg hover:bg-gray-100 transition-colors"
        >
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </Link>
        <h1 class="text-2xl font-bold text-gray-900">تعديل المطعم</h1>
      </div>
    </template>

    <div class="max-w-4xl mx-auto">
      <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
          <h2 class="text-lg font-medium text-gray-900">معلومات المطعم</h2>
          <p class="mt-1 text-sm text-gray-500">تعديل معلومات: {{ restaurant.name }}</p>
        </div>

        <form @submit.prevent="submit" class="p-6 space-y-6">
          <!-- الصور الحالية -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">الشعار الحالي</label>
              <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                <img
                  v-if="restaurant.logo_url"
                  :src="restaurant.logo_url"
                  :alt="restaurant.name"
                  class="w-24 h-24 object-contain rounded-lg border border-gray-200"
                />
                <div v-else class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                  <span class="text-gray-400 text-sm">لا يوجد شعار</span>
                </div>
                <div class="text-sm text-gray-600">
                  <p>الشعار الحالي للمطعم</p>
                  <p class="text-xs text-gray-500 mt-1">اختر صورة جديدة لتحديثه</p>
                </div>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">صورة الغلاف الحالية</label>
              <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                <img
                  v-if="restaurant.cover_image_url"
                  :src="restaurant.cover_image_url"
                  :alt="restaurant.name"
                  class="w-32 h-24 object-cover rounded-lg border border-gray-200"
                />
                <div v-else class="w-32 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                  <span class="text-gray-400 text-sm">لا يوجد</span>
                </div>
                <div class="text-sm text-gray-600">
                  <p>صورة الغلاف الحالية</p>
                  <p class="text-xs text-gray-500 mt-1">اختر صورة جديدة لتحديثها</p>
                </div>
              </div>
            </div>
          </div>

          <!-- الاسم والوصف -->
          <div class="grid grid-cols-1 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">اسم المطعم *</label>
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
              <label for="description" class="block text-sm font-medium text-gray-700 mb-2">الوصف</label>
              <textarea
                id="description"
                v-model="form.description"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.description }"
              ></textarea>
              <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
            </div>
          </div>

          <!-- العنوان والتواصل -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="address" class="block text-sm font-medium text-gray-700 mb-2">العنوان *</label>
              <input
                id="address"
                v-model="form.address"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.address }"
              />
              <p v-if="form.errors.address" class="mt-1 text-sm text-red-600">{{ form.errors.address }}</p>
            </div>
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">الهاتف *</label>
              <input
                id="phone"
                v-model="form.phone"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.phone }"
              />
              <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
            </div>
            <div class="md:col-span-2">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.email }"
              />
              <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
            </div>
          </div>

          <!-- التوصيل والأسعار -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
              <label for="delivery_time" class="block text-sm font-medium text-gray-700 mb-2">وقت التوصيل (دقيقة) *</label>
              <input
                id="delivery_time"
                v-model="form.delivery_time"
                type="number"
                min="1"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.delivery_time }"
              />
              <p v-if="form.errors.delivery_time" class="mt-1 text-sm text-red-600">{{ form.errors.delivery_time }}</p>
            </div>
            <div>
              <label for="delivery_fee" class="block text-sm font-medium text-gray-700 mb-2">رسوم التوصيل (ريال) *</label>
              <input
                id="delivery_fee"
                v-model="form.delivery_fee"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.delivery_fee }"
              />
              <p v-if="form.errors.delivery_fee" class="mt-1 text-sm text-red-600">{{ form.errors.delivery_fee }}</p>
            </div>
            <div>
              <label for="minimum_order" class="block text-sm font-medium text-gray-700 mb-2">الحد الأدنى للطلب (ريال) *</label>
              <input
                id="minimum_order"
                v-model="form.minimum_order"
                type="number"
                min="0"
                step="0.01"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.minimum_order }"
              />
              <p v-if="form.errors.minimum_order" class="mt-1 text-sm text-red-600">{{ form.errors.minimum_order }}</p>
            </div>
          </div>

          <!-- التقييم والنشاط -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">التقييم (0-5)</label>
              <input
                id="rating"
                v-model="form.rating"
                type="number"
                min="0"
                max="5"
                step="0.1"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.rating }"
              />
              <p v-if="form.errors.rating" class="mt-1 text-sm text-red-600">{{ form.errors.rating }}</p>
            </div>
            <div class="flex items-end pb-2">
              <label class="flex items-center">
                <input
                  v-model="form.is_active"
                  type="checkbox"
                  class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                />
                <span class="mr-2 text-sm font-medium text-gray-700">المطعم نشط</span>
              </label>
            </div>
          </div>

          <!-- رفع صور جديدة -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">شعار جديد</label>
              <input
                id="logo"
                type="file"
                accept="image/*"
                @change="form.logo = $event.target.files[0]"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              />
              <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF حتى 2MB. اتركه فارغاً للإبقاء على الشعار الحالي.</p>
              <p v-if="form.errors.logo" class="mt-1 text-sm text-red-600">{{ form.errors.logo }}</p>
            </div>
            <div>
              <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">صورة غلاف جديدة</label>
              <input
                id="cover_image"
                type="file"
                accept="image/*"
                @change="form.cover_image = $event.target.files[0]"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              />
              <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF حتى 2MB. اتركه فارغاً للإبقاء على الصورة الحالية.</p>
              <p v-if="form.errors.cover_image" class="mt-1 text-sm text-red-600">{{ form.errors.cover_image }}</p>
            </div>
          </div>

          <!-- أزرار -->
          <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <Link
              :href="route('admin.restaurants.index')"
              class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50"
            >
              إلغاء
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="form.processing">جاري التحديث...</span>
              <span v-else>تحديث المطعم</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
