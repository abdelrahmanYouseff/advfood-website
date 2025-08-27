<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const form = useForm({
  name: '',
  description: '',
  address: '',
  phone: '',
  email: '',
  working_hours: '',
  delivery_time: 30,
  delivery_fee: 0,
  minimum_order: 0,
  rating: 0,
  is_active: true,
  logo: null,
  cover_image: null
})

const submit = () => {
  form.post(route('admin.restaurants.store'))
}
</script>

<template>
  <AdminLayout>
    <template #header>
      <h1 class="text-2xl font-bold text-gray-900">إضافة مطعم جديد</h1>
    </template>

    <div class="max-w-4xl mx-auto">
      <div class="bg-white shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">معلومات المطعم</h2>
          <p class="mt-1 text-sm text-gray-500">أدخل معلومات المطعم الجديد</p>
        </div>

        <form @submit.prevent="submit" enctype="multipart/form-data" class="p-6 space-y-6">
          <!-- Basic Information -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف *</label>
              <input
                id="phone"
                v-model="form.phone"
                type="tel"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                :class="{ 'border-red-500': form.errors.phone }"
              />
              <p v-if="form.errors.phone" class="mt-1 text-sm text-red-600">{{ form.errors.phone }}</p>
            </div>

            <div>
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
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">وصف المطعم</label>
            <textarea
              id="description"
              v-model="form.description"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              :class="{ 'border-red-500': form.errors.description }"
            ></textarea>
            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
          </div>

          <!-- Working Hours -->
          <div>
            <label for="working_hours" class="block text-sm font-medium text-gray-700 mb-2">ساعات العمل</label>
            <input
              id="working_hours"
              v-model="form.working_hours"
              type="text"
              placeholder="مثال: 9:00 ص - 10:00 م"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              :class="{ 'border-red-500': form.errors.working_hours }"
            />
            <p v-if="form.errors.working_hours" class="mt-1 text-sm text-red-600">{{ form.errors.working_hours }}</p>
          </div>

          <!-- Delivery Settings -->
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

          <!-- Rating -->
          <div>
            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">التقييم (من 5)</label>
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

          <!-- Status -->
          <div>
            <label class="flex items-center">
              <input
                v-model="form.is_active"
                type="checkbox"
                class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
              />
              <span class="mr-2 text-sm font-medium text-gray-700">المطعم نشط</span>
            </label>
          </div>

          <!-- Images -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">شعار المطعم</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors duration-200">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="logo" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                      <span>اختر ملف</span>
                      <input
                        id="logo"
                        type="file"
                        accept="image/*"
                        @change="form.logo = $event.target.files[0]"
                        class="sr-only"
                      />
                    </label>
                    <p class="mr-1">أو اسحب وأفلت</p>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 2MB</p>
                </div>
              </div>
              <p v-if="form.errors.logo" class="mt-1 text-sm text-red-600">{{ form.errors.logo }}</p>
            </div>

            <div>
              <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">صورة الغلاف</label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors duration-200">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="cover_image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                      <span>اختر ملف</span>
                      <input
                        id="cover_image"
                        type="file"
                        accept="image/*"
                        @change="form.cover_image = $event.target.files[0]"
                        class="sr-only"
                      />
                    </label>
                    <p class="mr-1">أو اسحب وأفلت</p>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 2MB</p>
                </div>
              </div>
              <p v-if="form.errors.cover_image" class="mt-1 text-sm text-red-600">{{ form.errors.cover_image }}</p>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3 space-x-reverse">
            <Link
              :href="route('admin.restaurants.index')"
              class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
            >
              إلغاء
            </Link>
            <button
              type="submit"
              :disabled="form.processing"
              class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <span v-if="form.processing">جاري الحفظ...</span>
              <span v-else>حفظ المطعم</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
