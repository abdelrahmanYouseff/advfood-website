<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header
      ref="header"
      class="fixed top-0 left-0 right-0 z-50 w-full transition-transform duration-300"
      :class="{ '-translate-y-full': isHeaderHidden }"
      style="background-color: transparent;"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end items-center h-36">
          <!-- Back Button -->
          <Link
            href="/"
            class="flex items-center gap-2 px-4 py-2 text-sm border border-white/30 rounded-md hover:bg-white/20 transition-colors text-white"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            {{ $t('Back to Home') }}
          </Link>
        </div>
      </div>
    </header>

    <!-- Header with Restaurant Info -->
    <div class="relative pt-36">
      <div class="h-96 overflow-hidden">
        <img
          :src="restaurant.cover_image_url || restaurant.logo_url || '/images/default-restaurant-cover.png'"
          :alt="restaurant.name"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black/40" />
      </div>


      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-8">
        <div class="max-w-7xl mx-auto">
          <div class="flex items-end justify-between">
            <div class="text-white">
              <h1 class="text-4xl font-bold mb-2">{{ restaurant.name }}</h1>
              <div class="flex items-center gap-4 text-lg">
                <span class="bg-white/20 text-white border border-white/30 px-3 py-1 rounded-full text-sm">
                  {{ getCuisineType() }}
                </span>
                <span class="bg-white/20 text-white border border-white/30 px-3 py-1 rounded-full text-sm">
                  {{ getPriceRange(restaurant.minimum_order) }}
                </span>
                <div class="flex items-center gap-1">
                  <svg class="w-5 h-5 fill-yellow-400 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>
                  <span>{{ restaurant.rating || '0.0' }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Restaurant Details Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-lg shadow-lg sticky top-6">
            <div class="p-6 border-b border-gray-200">
              <h3 class="text-xl font-semibold text-gray-900">{{ $t('Restaurant Information') }}</h3>
            </div>
            <div class="p-6 space-y-4">
              <p class="text-gray-600">{{ restaurant.description || $t('Restaurant description not available') }}</p>

              <div class="border-t border-gray-200 pt-4"></div>

              <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>{{ restaurant.address || 'العنوان غير متوفر' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <span>{{ restaurant.phone || 'الهاتف غير متوفر' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                  <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>{{ getWorkingHours(restaurant.working_hours) }}</span>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Menu -->
        <div class="lg:col-span-2">
          <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $t('Menu') }}</h2>
            <p class="text-gray-600">{{ $t('Discover our carefully selected dishes') }}</p>
          </div>

          <div v-if="categories.length > 0" class="space-y-8">
            <div
              v-for="category in categories"
              :key="category.id"
              class="bg-white rounded-lg shadow-lg overflow-hidden"
            >
              <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">{{ category.name }}</h3>
              </div>
              <div class="divide-y divide-gray-200">
                <div
                  v-for="(product, index) in getCategoryProducts(category.id)"
                  :key="product.id"
                  class="p-6 hover:bg-gray-50 transition-colors"
                >
                  <div class="flex gap-4">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                      <img
                        :src="product.image_url"
                        :alt="product.name"
                        class="w-20 h-20 rounded-lg object-cover shadow-md"
                        @error="handleImageError"
                      />
                    </div>

                    <!-- Product Details -->
                    <div class="flex-1">
                      <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                          <h4 class="font-semibold text-gray-900">{{ product.name }}</h4>
                          <div class="flex gap-1">
                            <span v-if="product.is_vegetarian" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                              <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.828a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                              </svg>
                              نباتي
                            </span>
                            <span v-if="product.is_gluten_free" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                              <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                              </svg>
                              خالي من الجلوتين
                            </span>
                          </div>
                        </div>
                        <span class="font-bold text-lg text-gray-900">
                          {{ product.formatted_price }}
                        </span>
                      </div>
                      <p class="text-gray-600 text-sm leading-relaxed">
                        {{ translateDescription(product.description) }}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- No Menu Items -->
          <div v-else class="text-center py-16">
            <div class="max-w-md mx-auto">
              <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $t('No Menu Items') }}</h3>
              <p class="text-xl text-gray-600 mb-8">{{ $t('This restaurant has no menu items available at the moment') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div class="space-y-4">
            <p class="text-gray-300 leading-relaxed">
              {{ $t('Your ideal destination to discover the best restaurants and culinary experiences. From cozy small restaurants to luxurious fine dining, we connect you with unforgettable meals.') }}
            </p>
            <div class="flex space-x-4 space-x-reverse">
              <!-- Facebook -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                aria-label="Facebook"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>

              <!-- Twitter -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                aria-label="Twitter"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>

              <!-- Instagram -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                aria-label="Instagram"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.281c-.49 0-.98-.49-.98-.98s.49-.98.98-.98.98.49.98.98-.49.98-.98.98zm-5.83 8.281c-1.297 0-2.448-.49-3.323-1.297C6.198 13.895 5.708 12.744 5.708 11.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297z"/>
                </svg>
              </a>

              <!-- YouTube -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                aria-label="YouTube"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="space-y-4">
            <h4 class="text-lg font-semibold text-white">{{ $t('Quick Links') }}</h4>
            <ul class="space-y-2">
              <li><a href="#" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">{{ $t('About Us') }}</a></li>
              <li><a href="#" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">{{ $t('Contact Us') }}</a></li>
              <li><a href="#" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">{{ $t('Privacy Policy') }}</a></li>
              <li><a href="#" class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block">{{ $t('Terms of Service') }}</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div class="space-y-4">
            <h4 class="text-lg font-semibold text-white">{{ $t('Contact Us') }}</h4>
            <div class="space-y-3">
              <div class="text-gray-300">
                <div class="font-medium">{{ $t('Address') }}</div>
                <div class="text-sm">QM4G+F35, King Abdulaziz Rd, Al Muruj, Riyadh 12465, Saudi Arabia</div>
              </div>

              <div class="text-gray-300">
                <div class="font-medium">{{ $t('Phone') }}</div>
                <div class="text-sm">+966 50 784 4079</div>
              </div>

              <div class="text-gray-300">
                <div class="font-medium">{{ $t('Email') }}</div>
                <div class="text-sm">info@adv-line.sa</div>
              </div>
            </div>
          </div>
        </div>

        <div class="my-8 border-t border-gray-700"></div>

        <!-- Bottom Section -->
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <div class="flex items-center space-x-2 space-x-reverse text-gray-300">
            <span>© {{ new Date().getFullYear() }} {{ $t('All rights reserved') }}.</span>
          </div>

          <div class="flex items-center space-x-1 space-x-reverse text-gray-300">
            <span>{{ $t('Made with') }}</span>
            <svg class="w-4 h-4 text-red-500 fill-red-500 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span>{{ $t('food lovers') }}</span>
          </div>

          <div class="flex space-x-6 space-x-reverse text-sm text-gray-400">
            <a href="#" class="hover:text-white transition-colors">{{ $t('Privacy') }}</a>
            <a href="#" class="hover:text-white transition-colors">{{ $t('Terms') }}</a>
            <a href="#" class="hover:text-white transition-colors">{{ $t('Cookies') }}</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'

const { t, locale } = useI18n()

// Set current language based on the locale
const currentLanguage = ref(locale.value || 'ar')
const isHeaderHidden = ref(false)
const lastScrollY = ref(0)

const props = defineProps({
  restaurant: Object,
  categories: Array,
  products: Array,
})

// Helper functions
const getPriceRange = (minimumOrder) => {
  if (minimumOrder <= 50) return '$'
  if (minimumOrder <= 100) return '$$'
  return '$$$'
}

const getCuisineType = () => {
  // Since we don't have cuisine field in database, return a default
  return t('Restaurant')
}

const getWorkingHours = (workingHours) => {
  if (!workingHours || typeof workingHours !== 'object') {
    return t('Working hours not available')
  }

  // If it's an object with day-specific hours, show a general message
  if (workingHours.monday || workingHours.tuesday) {
    return t('Open Today')
  }

  return t('Working hours not available')
}

const getCategoryProducts = (categoryId) => {
  return props.products.filter(product => product.category_id === categoryId)
}

const handleImageError = (event) => {
  event.target.src = '/images/default-product.png'
}

// Translate product descriptions
const translateDescription = (description) => {
  const translations = {
    'Delicious traditional Egyptian sweet made with layers of phyllo pastry and nuts, soaked in sweet syrup': 'حلوى مصرية تقليدية لذيذة مصنوعة من طبقات عجين الفيلو والمكسرات، منقوعة في شراب حلو',
    'Fresh and crispy Egyptian bread with a golden crust, perfect for any meal': 'خبز مصري طازج ومقرمش بقشرة ذهبية، مثالي لأي وجبة',
    'Traditional Egyptian pastry filled with nuts and sweetened with honey': 'معجنات مصرية تقليدية محشوة بالمكسرات ومحلاة بالعسل',
    'Classic Egyptian dessert made with layers of pastry and cream': 'حلوى مصرية كلاسيكية مصنوعة من طبقات المعجنات والكريمة',
    'Sweet and aromatic Egyptian bread perfect for breakfast': 'خبز مصري حلو وعطري مثالي للإفطار',
    'Traditional Egyptian cookies with a unique taste and texture': 'بسكويت مصري تقليدي بطعم وقوام فريد',
    'Rich and creamy Egyptian dessert with layers of flavor': 'حلوى مصرية غنية وكريمية بطبقات من النكهات',
    'Fresh Egyptian bread with sesame seeds and traditional flavor': 'خبز مصري طازج بالسمسم والنكهة التقليدية'
  }

  return translations[description] || description
}

// Header scroll behavior
const handleScroll = () => {
  const currentScrollY = window.scrollY

  // Only show header when at the very top of the page (scrollY = 0)
  if (currentScrollY === 0) {
    isHeaderHidden.value = false
  } else {
    // Hide header for any other scroll position
    isHeaderHidden.value = true
  }

  lastScrollY.value = currentScrollY
}

// Add scroll event listener
if (typeof window !== 'undefined') {
  window.addEventListener('scroll', handleScroll)
}
</script>
