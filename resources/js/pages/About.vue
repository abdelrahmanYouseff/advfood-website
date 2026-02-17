<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header class="sticky top-0 z-50 w-full" style="background-color: #cf4823; backdrop-filter: blur(10px);">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-36" :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'">
          <!-- Logo -->
          <div class="flex items-center">
            <div class="w-32 h-32 flex items-center justify-center">
              <img src="/asset/GatherUs-Logo.png" alt="GatherUs Logo" class="w-32 h-32 object-contain">
            </div>
          </div>

          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center" :class="currentLanguage === 'ar' ? 'space-x-8 space-x-reverse' : 'space-x-8'">
            <Link
              href="/"
              class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors duration-200 hover:bg-white/20 rounded-md"
            >
              {{ $t('Home') }}
            </Link>
            <Link
              href="/about"
              class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors duration-200 hover:bg-white/20 rounded-md"
            >
              {{ $t('About Us') }}
            </Link>
            <Link
              href="/"
              class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors duration-200 hover:bg-white/20 rounded-md"
            >
              {{ $t('Restaurants') }}
            </Link>
            <Link
              href="/"
              class="text-white hover:text-gray-200 px-3 py-2 text-sm font-medium transition-colors duration-200 hover:bg-white/20 rounded-md"
            >
              {{ $t('Contact') }}
            </Link>
          </nav>

          <!-- Desktop Action Buttons -->
          <div class="hidden md:flex items-center space-x-3 space-x-reverse">
            <!-- Language Switcher -->
            <div class="relative">
              <button
                @click="toggleLanguageDropdown"
                class="flex items-center gap-2 px-3 py-2 text-sm border border-white/30 rounded-md hover:bg-white/20 transition-colors text-white"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
                <span class="text-sm">{{ getCurrentLanguage.flag }}</span>
                <span class="hidden lg:inline">{{ getCurrentLanguage.name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <!-- Language Dropdown -->
              <div
                v-if="isLanguageDropdownOpen"
                class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                :class="currentLanguage === 'ar' ? 'right-0' : 'left-0'"
              >
                <div class="py-1">
                  <button
                    v-for="language in languages"
                    :key="language.code"
                    @click="handleLanguageChange(language.code)"
                    class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'"
                  >
                    <span>{{ language.flag }}</span>
                    <span>{{ language.name }}</span>
                    <svg
                      v-if="currentLanguage === language.code"
                      class="w-3 h-3 text-green-600 ml-auto"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Mobile menu button -->
          <button
            @click="toggleMobileMenu"
            class="md:hidden p-2 text-white hover:text-gray-200 hover:bg-white/20 rounded-md transition-colors"
          >
            <svg v-if="!isMobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div
        v-if="isMobileMenuOpen"
        class="md:hidden shadow-lg" style="background-color: #cf4823; border-top: 1px solid rgba(255,255,255,0.2);"
      >
        <div class="px-4 py-6">
          <!-- Mobile Logo -->
          <div class="flex items-center space-x-2 mb-8">
            <div class="w-20 h-20 flex items-center justify-center">
              <img src="/asset/GatherUs-Logo.png" alt="GatherUs Logo" class="w-20 h-20 object-contain">
            </div>
            <div class="flex flex-col">
              <span class="text-xs text-white -mt-1">اكتشف الطعام الرائع</span>
            </div>
          </div>

          <!-- Mobile Navigation -->
          <nav class="flex flex-col space-y-4">
            <Link
              href="/"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('Home') }}
            </Link>
            <Link
              href="/about"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('About Us') }}
            </Link>
            <Link
              href="/"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('Restaurants') }}
            </Link>
            <Link
              href="/"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('Contact') }}
            </Link>

            <div class="pt-6 border-t border-gray-200 space-y-3">
              <!-- Language Switcher Mobile -->
              <div class="mb-4">
                <p class="text-sm font-medium text-white mb-2">اللغة / Language</p>
                <div class="grid grid-cols-2 gap-2">
                  <button
                    v-for="language in languages"
                    :key="language.code"
                    @click="handleLanguageChange(language.code)"
                    :class="[
                      'flex items-center gap-2 p-2 rounded-md border transition-colors',
                      currentLanguage === language.code
                        ? 'bg-white/20 border-white/30 text-white'
                        : 'border-white/30 hover:bg-white/10 text-white'
                    ]"
                  >
                    <span>{{ language.flag }}</span>
                    <span class="text-sm">{{ language.name }}</span>
                    <svg
                      v-if="currentLanguage === language.code"
                      class="w-3 h-3 text-green-600 mr-auto"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </div>
              </div>

            </div>
          </nav>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
      <!-- Hero Section -->
      <div class="text-white py-20" style="background-color: #cf4823;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
            {{ $t('About Us') }}
          </h1>
          <p class="text-xl text-white max-w-3xl mx-auto">
            {{ $t('Discover our story and mission to bring you the best culinary experiences.') }}
          </p>
        </div>
      </div>

      <!-- About Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Our Story -->
        <div class="mb-16">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch min-h-[500px]">
            <!-- Image Section -->
            <div class="relative">
              <div class="h-full">
                <img
                  src="/images/about-story.jpg"
                  alt="Our Story"
                  class="w-full h-full object-cover"
                  @error="handleImageError"
                />
                <!-- Vintage frame effect -->
                <div class="absolute inset-0 border-4 border-amber-200 opacity-30"></div>
                <!-- Sepia overlay -->
                <div class="absolute inset-0 bg-amber-900 opacity-20"></div>
              </div>
            </div>

            <!-- Text Section with Red Background -->
            <div class="p-12 flex flex-col justify-center" style="background-color: #cf4823;" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
              <div class="text-white">
                <div class="mb-4">
                  <span class="text-2xl font-bold">{{ $t('Since 1974') }}</span>
                </div>
                <h2 class="text-4xl font-bold text-white mb-8">{{ $t('Our Story') }}</h2>
                <div class="space-y-4 text-lg leading-relaxed">
                  <p>
                    {{ $t('Founded in Jeddah in 1974 by Shakour Abu Ghazaleh, our journey began with a simple vision: to provide high-quality, affordable food to our community.') }}
                  </p>
                  <p>
                    {{ $t('Over the years, we have expanded our offerings to include chicken, fish, and shrimp dishes, always maintaining our commitment to quality and taste.') }}
                  </p>
                  <p>
                    {{ $t('Today, we are proud to serve thousands of customers daily, bringing the authentic flavors of our heritage to every table.') }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Our Mission -->
        <div class="mb-16">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $t('Our Mission') }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
              {{ $t('To revolutionize the way people discover, order, and enjoy food by connecting them with the best restaurants and culinary experiences.') }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Fast Delivery') }}</h3>
              <p class="text-gray-600">{{ $t('Quick and reliable delivery service to bring your favorite meals to you in no time.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Quality Assurance') }}</h3>
              <p class="text-gray-600">{{ $t('We ensure every meal meets our high standards of quality and freshness.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Customer Love') }}</h3>
              <p class="text-gray-600">{{ $t('Your satisfaction is our priority, and we work hard to exceed your expectations.') }}</p>
            </div>
          </div>
        </div>

        <!-- Our Values -->
        <div class="mb-16">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $t('Our Values') }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
              {{ $t('The principles that guide everything we do and shape our commitment to excellence.') }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 bg-white rounded-xl shadow-lg text-center">
              <div class="text-4xl mb-4">🌟</div>
              <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $t('Excellence') }}</h3>
              <p class="text-gray-600 text-sm">{{ $t('Striving for the highest standards in everything we do.') }}</p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg text-center">
              <div class="text-4xl mb-4">🤝</div>
              <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $t('Integrity') }}</h3>
              <p class="text-gray-600 text-sm">{{ $t('Building trust through honest and transparent practices.') }}</p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg text-center">
              <div class="text-4xl mb-4">💡</div>
              <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $t('Innovation') }}</h3>
              <p class="text-gray-600 text-sm">{{ $t('Continuously improving and innovating our services.') }}</p>
            </div>

            <div class="p-6 bg-white rounded-xl shadow-lg text-center">
              <div class="text-4xl mb-4">❤️</div>
              <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $t('Passion') }}</h3>
              <p class="text-gray-600 text-sm">{{ $t('Driven by our love for great food and service.') }}</p>
            </div>
          </div>
        </div>

        <!-- Contact CTA -->
        <div class="text-center py-16" style="background-color: #cf4823;">
          <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-white mb-6">{{ $t('Get in Touch') }}</h2>
            <p class="text-xl text-white mb-8">
              {{ $t('Have questions or feedback? We\'d love to hear from you!') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                href="/"
                class="inline-flex items-center px-6 py-3 bg-white text-gray-900 font-medium rounded-lg hover:bg-gray-100 transition-colors"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                {{ $t('Contact Us') }}
              </Link>
              <Link
                href="/"
                class="inline-flex items-center px-6 py-3 border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-gray-900 transition-colors"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ $t('Back to Home') }}
              </Link>
            </div>
          </div>
        </div>
      </div>
    </main>

    <AppFooter />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { Link } from '@inertiajs/vue3'
import AppFooter from '@/components/AppFooter.vue'

const { t, locale } = useI18n()

// Language and mobile menu state
const currentLanguage = ref('ar')
const isLanguageDropdownOpen = ref(false)
const isMobileMenuOpen = ref(false)

// Navigation items
const navigationItems = ref([
  { name: t('Home'), icon: null },
  { name: t('Restaurants'), icon: null },
  { name: t('About'), icon: null },
  { name: t('Contact'), icon: null }
])

// Languages
const languages = ref([
  { code: 'en', name: 'English', flag: '🇺🇸' },
  { code: 'ar', name: 'العربية', flag: '🇸🇦' }
])

// Computed
const getCurrentLanguage = computed(() => {
  return languages.value.find(lang => lang.code === currentLanguage.value) || languages.value[0]
})

// Methods
const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value
}

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const handleLanguageChange = (languageCode) => {
  currentLanguage.value = languageCode
  locale.value = languageCode
  isLanguageDropdownOpen.value = false
  isMobileMenuOpen.value = false
}

const handleNavClick = (itemName) => {
  if (itemName === t('Home')) {
    window.location.href = '/'
  } else if (itemName === t('About')) {
    window.location.href = '/about'
  } else if (itemName === t('Contact')) {
    // Handle contact action
    console.log('Contact clicked')
  } else if (itemName === t('Restaurants')) {
    // Handle restaurants action
    console.log('Restaurants clicked')
  }
  isMobileMenuOpen.value = false
}

const handleImageError = (event) => {
  event.target.src = '/images/default-restaurant-cover.png'
}

// Lifecycle
onMounted(() => {
  currentLanguage.value = locale.value || 'ar'
})

// Watch for language changes
watch(currentLanguage, (newLang) => {
  locale.value = newLang
})
</script>
