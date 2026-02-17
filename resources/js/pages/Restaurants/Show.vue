<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Cover Image - يشمل الهيدر من الأعلى -->
    <div class="relative w-full min-h-[32rem]">
      <img
        :src="coverImageSrc"
        :alt="restaurant.name"
        class="absolute inset-0 w-full h-full object-cover"
        @error="onCoverImageError"
      />
      <div class="absolute inset-0 bg-black/40" />

      <!-- Header فوق الصورة -->
      <header
        ref="header"
        class="absolute top-0 left-0 right-0 z-50 w-full transition-transform duration-300"
        :class="{ '-translate-y-full': isHeaderHidden }"
      >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-end items-center h-36">
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

      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-8">
        <div class="max-w-7xl mx-auto">
          <div class="flex items-end justify-between">
            <div class="text-white">
              <h1 class="text-4xl font-bold">{{ restaurant.name }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Shopping Cart Sidebar -->
        <div class="lg:col-span-1 order-2 lg:order-1">
          <div class="bg-white rounded-lg shadow-lg sticky top-6">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-orange-500 to-red-500">
              <div class="flex items-center justify-between text-white">
                <h3 class="text-xl font-semibold flex items-center gap-2">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  {{ $t('Shopping Cart') }}
                </h3>
                <span class="bg-white text-orange-500 px-3 py-1 rounded-full text-sm font-bold">
                  {{ cartItems.length }}
                </span>
              </div>
            </div>

            <!-- Cart Items -->
            <div class="p-6">
              <div v-if="cartItems.length === 0" class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500">{{ $t('Your cart is empty') }}</p>
                <p class="text-sm text-gray-400 mt-2">{{ $t('Add items from the menu') }}</p>
              </div>

              <div v-else class="space-y-4 max-h-96 overflow-y-auto">
                <div
                  v-for="item in cartItems"
                  :key="item.id"
                  class="flex gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors"
                >
                  <img
                    :src="item.image_url"
                    :alt="item.name"
                    class="w-16 h-16 rounded-lg object-cover"
                  />
                  <div class="flex-1">
                    <h4 class="font-semibold text-sm text-gray-900">{{ (currentLanguage === 'ar' && item.name_ar) ? item.name_ar : item.name }}</h4>
                    <p class="text-sm text-gray-600">{{ item.price }} {{ $t('SAR') }}</p>
                    <div class="flex items-center gap-2 mt-2">
                      <button
                        @click="decreaseQuantity(item.id)"
                        class="w-6 h-6 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center transition-colors"
                      >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path>
                        </svg>
                      </button>
                      <span class="text-sm font-semibold w-8 text-center">{{ item.quantity }}</span>
                      <button
                        @click="increaseQuantity(item.id)"
                        class="w-6 h-6 bg-orange-500 hover:bg-orange-600 text-white rounded-full flex items-center justify-center transition-colors"
                      >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                      </button>
                      <button
                        @click="removeFromCart(item.id)"
                        class="mr-auto text-red-500 hover:text-red-700 transition-colors"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Cart Summary -->
              <div v-if="cartItems.length > 0" class="mt-6 pt-6 border-t border-gray-200">
                <div class="space-y-2 mb-4">
                  <div class="flex justify-between text-sm">
                    <span class="text-gray-600">{{ $t('Subtotal') }}</span>
                    <span class="font-semibold">{{ cartSubtotal.toFixed(2) }} {{ $t('SAR') }}</span>
                  </div>
                  <div class="flex justify-between text-sm">
                    <span class="text-gray-600">{{ $t('Delivery Fee') }}</span>
                    <span class="font-semibold">{{ restaurant.delivery_fee }} {{ $t('SAR') }}</span>
                  </div>
                  <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-200">
                    <span>{{ $t('Total') }}</span>
                    <span class="text-orange-500">{{ cartTotal.toFixed(2) }} {{ $t('SAR') }}</span>
                  </div>
                </div>
                <Link
                  :href="`/checkout/${restaurant.id}`"
                  class="block w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-center"
                >
                  {{ $t('Proceed to Checkout') }}
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Menu -->
        <div class="lg:col-span-2 order-1 lg:order-2">
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
                        :alt="getProductName(product)"
                        class="w-20 h-20 rounded-lg object-cover shadow-md"
                        @error="handleImageError"
                      />
                    </div>

                    <!-- Product Details -->
                    <div class="flex-1">
                      <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                          <h4 class="font-semibold text-gray-900">{{ getProductName(product) }}</h4>
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
                        <div class="flex items-center gap-3">
                          <span class="font-bold text-lg text-gray-900">
                            {{ product.formatted_price }}
                          </span>
                          <button
                            @click="addToCart(product)"
                            class="group relative w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg active:scale-95"
                            :title="$t('Add to Cart')"
                          >
                            <svg class="w-5 h-5 transition-transform group-hover:rotate-90 duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-ping"></span>
                          </button>
                        </div>
                      </div>
                      <p class="text-gray-600 text-sm leading-relaxed">
                        {{ getProductDescription(product) || translateDescription(product.description) }}
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

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { useI18n } from 'vue-i18n'
import AppFooter from '@/components/AppFooter.vue'
import { useProductLocale } from '@/composables/useProductLocale'

const { t, locale } = useI18n()
const { getProductName, getProductDescription } = useProductLocale()

// Set current language based on the locale
const currentLanguage = ref(locale.value || 'ar')
const isHeaderHidden = ref(false)
const lastScrollY = ref(0)

// Shopping cart state
const cartItems = ref([])

const props = defineProps({
  restaurant: Object,
  categories: Array,
  products: Array,
})

// Placeholder gradient عندما تفشل كل الصور (data URI يعمل دائماً)
const PLACEHOLDER_IMAGE = 'data:image/svg+xml,' + encodeURIComponent(
  '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="400" viewBox="0 0 1200 400"><defs><linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%236b7280"/><stop offset="100%" style="stop-color:%234b5563"/></linearGradient></defs><rect width="1200" height="400" fill="url(%23g)"/></svg>'
)

const coverImageSrc = ref(
  props.restaurant?.cover_image_url || props.restaurant?.logo_url || '/images/default-restaurant-cover.png'
)

const onCoverImageError = () => {
  if (coverImageSrc.value !== PLACEHOLDER_IMAGE) {
    coverImageSrc.value = coverImageSrc.value === '/images/default-restaurant-cover.png'
      ? PLACEHOLDER_IMAGE
      : '/images/default-restaurant-cover.png'
  }
}

// Helper functions
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

const DEFAULT_PRODUCT_IMG = 'data:image/svg+xml,' + encodeURIComponent(
  '<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 80 80"><rect fill="#e5e7eb" width="80" height="80"/><text x="50%" y="50%" fill="#9ca3af" font-size="10" text-anchor="middle" dy=".3em">صورة</text></svg>'
)

const handleImageError = (event) => {
  const img = event.target
  if (img.src?.includes('data:image')) return
  img.src = img.src?.includes('default-product') ? DEFAULT_PRODUCT_IMG : '/images/default-product.png'
}

// Cart computed properties
const cartSubtotal = computed(() => {
  return cartItems.value.reduce((total, item) => {
    return total + (item.price * item.quantity)
  }, 0)
})

const cartTotal = computed(() => {
  return cartSubtotal.value + parseFloat(props.restaurant.delivery_fee || 0)
})

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

// Cart functions
const addToCart = (product) => {
  // Check if product already exists in cart
  const existingItem = cartItems.value.find(item => item.id === product.id)

  if (existingItem) {
    // Increase quantity if already in cart
    existingItem.quantity++
  } else {
    // Add new item to cart
    cartItems.value.push({
      id: product.id,
      name: product.name,
      name_ar: product.name_ar || null,
      price: parseFloat(product.price),
      image_url: product.image_url,
      quantity: 1
    })
  }

  // Save to localStorage
  localStorage.setItem('cart', JSON.stringify(cartItems.value))
}

const removeFromCart = (productId) => {
  cartItems.value = cartItems.value.filter(item => item.id !== productId)
  localStorage.setItem('cart', JSON.stringify(cartItems.value))
}

const increaseQuantity = (productId) => {
  const item = cartItems.value.find(item => item.id === productId)
  if (item) {
    item.quantity++
    localStorage.setItem('cart', JSON.stringify(cartItems.value))
  }
}

const decreaseQuantity = (productId) => {
  const item = cartItems.value.find(item => item.id === productId)
  if (item) {
    if (item.quantity > 1) {
      item.quantity--
    } else {
      removeFromCart(productId)
    }
    localStorage.setItem('cart', JSON.stringify(cartItems.value))
  }
}

// Load cart from localStorage on mount
if (typeof window !== 'undefined') {
  const savedCart = localStorage.getItem('cart')
  if (savedCart) {
    cartItems.value = JSON.parse(savedCart)
  }
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
