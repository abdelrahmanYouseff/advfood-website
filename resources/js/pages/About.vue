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
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
              <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $t('Our Story') }}</h2>
              <p class="text-lg text-gray-600 mb-6">
                {{ $t('Founded with a passion for connecting food lovers with exceptional dining experiences, we have been serving the community since our inception. Our journey began with a simple vision: to make great food accessible to everyone.') }}
              </p>
              <p class="text-lg text-gray-600">
                {{ $t('Today, we are proud to be the leading platform for discovering and enjoying the finest restaurants in your area. From local favorites to international cuisine, we bring the world\'s flavors to your doorstep.') }}
              </p>
            </div>
            <div class="relative">
              <div class="aspect-w-16 aspect-h-9">
                <img
                  src="/images/about-story.jpg"
                  alt="Our Story"
                  class="w-full h-96 object-cover rounded-2xl shadow-2xl"
                  @error="handleImageError"
                />
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

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <!-- Company Info -->
          <div class="space-y-4">
            <p class="text-gray-300 leading-relaxed">
              {{ $t('From local favorites to international cuisine, we bring the world\'s flavors to you.') }}
            </p>
            <div class="flex" :class="currentLanguage === 'ar' ? 'space-x-4 space-x-reverse' : 'space-x-4'">
              <!-- Facebook -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <!-- Twitter -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>
              <!-- Instagram -->
              <a
                href="#"
                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.718-1.297c-.875.807-2.026 1.297-3.323 1.297s-2.448-.49-3.323-1.297c-.807-.875-1.297-2.026-1.297-3.323s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="space-y-4">
            <h4 class="text-lg font-semibold text-white">{{ $t('Quick Links') }}</h4>
            <div class="space-y-2">
              <a href="/" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Home') }}</a>
              <a href="#" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Restaurants') }}</a>
              <a href="/about" class="block text-gray-300 hover:text-white transition-colors">{{ $t('About Us') }}</a>
              <a href="#" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Contact') }}</a>
            </div>
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

          <!-- Legal -->
          <div class="space-y-4">
            <h4 class="text-lg font-semibold text-white">{{ $t('Legal') }}</h4>
            <div class="space-y-2">
              <a href="#" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Privacy Policy') }}</a>
              <a href="#" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Terms of Service') }}</a>
              <a href="#" class="block text-gray-300 hover:text-white transition-colors">{{ $t('Cookies') }}</a>
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
            <span>{{ $t('for') }} {{ $t('food lovers') }}</span>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { Link } from '@inertiajs/vue3'

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
