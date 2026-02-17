<template>
  <div class="min-h-screen bg-gray-50" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center">
            <img src="/images/gatherus-logo-new.png" alt="GatherUs Logo" class="w-16 h-16" />
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex items-center space-x-8" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
            <a href="/" class="text-gray-700 hover:text-red-600 font-medium">الرئيسية</a>
            <a href="/restaurants" class="text-red-600 font-medium">المطاعم</a>
            <a href="/cart" class="text-gray-700 hover:text-red-600 font-medium">السلة</a>
            <a href="/login" class="text-gray-700 hover:text-red-600 font-medium">تسجيل الدخول</a>
            <a href="/register" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">إنشاء حساب</a>
          </nav>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button class="text-gray-700 hover:text-red-600 p-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-orange-600 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-3xl mx-auto">
          <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
            مرحباً بك في عالم الطعام اللذيذ
          </h1>
          <p class="text-xl md:text-2xl text-red-100 mb-8 leading-relaxed">
            اكتشف أشهى المطاعم وأفضل الأطباق التي يتم توصيلها مباشرة إلى باب منزلك
          </p>
          <div class="flex flex-wrap justify-center gap-4 text-white">
            <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3">
              <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
              </svg>
              <span class="font-medium">تقييم عالي</span>
            </div>
            <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3">
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span class="font-medium">توصيل سريع</span>
            </div>
            <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-3">
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
              </svg>
              <span class="font-medium">أسعار مناسبة</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

      <!-- Restaurants Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="restaurant in restaurants"
          :key="restaurant.id"
          class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden"
        >
          <!-- Restaurant Image -->
          <div class="h-48 bg-gray-200">
            <img
              v-if="restaurant.cover_image_url"
              :src="restaurant.cover_image_url"
              :alt="restaurant.name"
              class="w-full h-full object-cover"
            />
            <div v-else class="w-full h-full bg-gray-200 flex items-center justify-center">
              <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
            </div>
          </div>

          <!-- Restaurant Info -->
          <div class="p-6">
            <!-- Restaurant Logo and Name -->
            <div class="flex items-center mb-4">
              <img
                v-if="restaurant.logo_url"
                :src="restaurant.logo_url"
                :alt="restaurant.name"
                class="w-12 h-12 rounded-full object-cover border-2 border-gray-200"
              />
              <div v-else class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
              <div class="flex-1 mr-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ restaurant.name }}</h3>
                <p class="text-sm text-gray-600">{{ restaurant.description || 'مطعم متميز' }}</p>
              </div>
            </div>

            <!-- Restaurant Details -->
            <div class="space-y-2 mb-4">
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">وقت التوصيل:</span>
                <span class="font-medium">{{ restaurant.delivery_time || '30' }} دقيقة</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">رسوم التوصيل:</span>
                <span class="font-medium">{{ restaurant.delivery_fee || '5' }} ريال</span>
              </div>
              <div class="flex justify-between text-sm">
                <span class="text-gray-600">الحد الأدنى:</span>
                <span class="font-medium">{{ restaurant.minimum_order || '25' }} ريال</span>
              </div>
            </div>

            <!-- Action Button -->
            <Link
              :href="route('restaurants.show', restaurant.id)"
              class="w-full bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition-colors duration-200 text-center block"
            >
              عرض القائمة
            </Link>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="filteredRestaurants.length === 0" class="text-center py-12">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">لا توجد مطاعم</h3>
        <p class="text-gray-600">جرب البحث بكلمات مختلفة</p>
      </div>
    </main>

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppFooter from '@/components/AppFooter.vue'

const props = defineProps({
  restaurants: Array,
})

const searchQuery = ref('')

const filteredRestaurants = computed(() => {
  if (!props.restaurants) return []

  if (!searchQuery.value) return props.restaurants

  return props.restaurants.filter(restaurant =>
    restaurant.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    restaurant.description?.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})
</script>

<style scoped>
.line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom animations */
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
}

.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

/* Enhanced button hover effects */
.group\/btn:hover {
  transform: scale(1.05);
}

/* Smooth transitions */
* {
  transition: all 0.3s ease;
}
</style>
