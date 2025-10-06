<template>
  <div class="min-h-screen bg-background" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
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
                <span class="text-sm">{{ getCurrentLanguage().flag }}</span>
                <span class="hidden lg:inline">{{ getCurrentLanguage().name }}</span>
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
                    class="flex items-center justify-between w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >
                    <div class="flex items-center gap-2" :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'">
                      <span>{{ language.flag }}</span>
                      <span>{{ language.name }}</span>
                    </div>
                    <svg
                      v-if="currentLanguage === language.code"
                      class="w-4 h-4 text-green-600"
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
            <div class="w-28 h-28 flex items-center justify-center">
              <img src="/asset/GatherUs-Logo.png" alt="GatherUs Logo" class="w-28 h-28 object-contain">
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
            {{ $t('Discover Delicious Restaurants') }}
          </h1>
          <p class="text-xl text-white max-w-3xl mx-auto">
            {{ $t('Experience the finest culinary delights delivered right to your doorstep.') }}
          </p>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Title Section -->
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900 text-center">
            {{ $t('Discover Delicious Restaurants') }}
          </h2>
        </div>

        <!-- Results Count -->
        <div class="mb-6" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <p class="text-gray-600">
            {{ $t('Found') }} {{ filteredRestaurants.length }} {{ $t('restaurants') }}
          </p>
        </div>

        <!-- Restaurant Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <div
            v-for="restaurant in filteredRestaurants"
            :key="restaurant.id"
            class="group overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-white rounded-lg shadow-md"
          >
            <div class="relative h-64 overflow-hidden">
              <img
                :src="restaurant.cover_image_url || restaurant.logo_url || '/images/default-restaurant-cover.png'"
                :alt="restaurant.name"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                @error="handleImageError"
              />
              <div class="absolute top-4 right-4">
                <span class="bg-white/90 text-gray-800 px-2 py-1 rounded-full text-sm font-medium">
                  {{ getPriceRange(restaurant.minimum_order) }}
                </span>
              </div>
              <div class="absolute bottom-4 left-4 flex items-center gap-1 bg-white/90 px-2 py-1 rounded-full">
                <svg class="w-4 h-4 fill-yellow-400 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span class="text-sm font-medium text-gray-800">{{ restaurant.rating || '0.0' }}</span>
              </div>
            </div>

            <div class="p-6">
              <div class="flex items-start justify-between mb-3">
                <div>
                  <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ restaurant.name }}</h3>
                  <span class="inline-block px-2 py-1 text-xs border border-gray-300 rounded-full text-gray-600">
                    {{ getPriceRange(restaurant.minimum_order) }}
                  </span>
                </div>
              </div>

              <p class="text-gray-600 mb-4 line-clamp-2">{{ restaurant.description || 'وصف المطعم غير متوفر' }}</p>

              <div class="space-y-2 mb-4">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span>{{ restaurant.address || 'العنوان غير متوفر' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <span>{{ restaurant.phone || 'الهاتف غير متوفر' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  <span>{{ getWorkingHours(restaurant.working_hours) }}</span>
                </div>
              </div>

              <button
                @click="viewMenu(restaurant.id)"
                class="w-full bg-gradient-to-r from-gray-900 to-gray-700 hover:from-gray-800 hover:to-gray-600 text-white py-3 px-4 rounded-lg font-medium transition-all duration-200"
              >
                {{ $t('Explore Menu') }}
              </button>
            </div>
          </div>
        </div>

        <!-- No Results -->
        <div v-if="filteredRestaurants.length === 0" class="py-16" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <div class="text-gray-400 mb-4">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ $t('No Restaurants Found') }}</h3>
          <p class="text-gray-500">{{ $t('Try searching with different keywords or adjust your filters') }}</p>
          <button
            @click="clearFilters"
            class="mt-4 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
          >
            {{ $t('Clear Filters') }}
          </button>
        </div>
      </div>

      <!-- Recent Products Section -->
      <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Section Title -->
          <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
              {{ $t('Recently Added Products') }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
              {{ $t('Discover our latest additions to the menu, carefully crafted for your enjoyment') }}
            </p>
          </div>

          <!-- Products Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
            <div
              v-for="product in recentProducts"
              :key="product.id"
              class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden"
            >
              <!-- Product Image -->
              <div class="relative h-48 overflow-hidden">
                <img
                  :src="product.image_url"
                  :alt="product.name"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  @error="handleProductImageError"
                />
                <div class="absolute top-4 right-4">
                  <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ product.formatted_price }}
                  </span>
                </div>
                <div class="absolute top-4 left-4">
                  <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                    {{ $t('New') }}
                  </span>
                </div>
              </div>

              <!-- Product Info -->
              <div class="p-6">
                <div class="mb-3">
                  <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ product.name }}</h3>
                  <p class="text-gray-600 text-sm line-clamp-2">{{ product.description }}</p>
                </div>

                <div class="flex items-center justify-between mb-4">
                  <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>{{ product.restaurant?.name || 'مطعم غير محدد' }}</span>
                  </div>
                  <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>{{ product.category?.name || 'فئة غير محددة' }}</span>
                  </div>
                </div>

                <div class="flex items-center justify-between">
                  <div class="text-2xl font-bold text-gray-900">
                    {{ product.formatted_price }}
                  </div>
                  <button
                    @click="viewProduct(product.id)"
                    class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                  >
                    {{ $t('View Details') }}
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- No Products State -->
          <div v-if="recentProducts.length === 0" class="text-center py-16">
            <div class="text-gray-400 mb-4">
              <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ $t('No Recent Products') }}</h3>
            <p class="text-gray-500">{{ $t('Check back later for new additions to our menu') }}</p>
          </div>
        </div>
      </section>
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
              <li v-for="link in quickLinks" :key="link.name">
                <a
                  :href="link.href"
                  class="text-gray-300 hover:text-white hover:translate-x-1 transition-all duration-200 inline-block"
                >
                  {{ link.name }}
                </a>
              </li>
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
            <span>© {{ currentYear }} {{ $t('All rights reserved') }}.</span>
          </div>

          <div class="flex items-center space-x-1 space-x-reverse text-gray-300">
            <span>{{ $t('Made with') }}</span>
            <svg class="w-4 h-4 text-red-500 fill-red-500 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span>{{ $t('by') }} {{ $t('food lovers') }}</span>
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
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { Link } from '@inertiajs/vue3'

const { t, locale } = useI18n()

// Reactive state
const isMobileMenuOpen = ref(false)
const isLanguageDropdownOpen = ref(false)
const currentLanguage = ref('en')

// Restaurant data
const searchTerm = ref('')
const cuisineFilter = ref('all')
const priceFilter = ref('all')

// Restaurant data from database
const restaurants = ref([])

// Recent products data
const recentProducts = ref([])

// Footer data
const currentYear = new Date().getFullYear()

const quickLinks = computed(() => [
  { name: t('About'), href: '#' },
  { name: t('Contact Us'), href: '#' },
  { name: t('Privacy'), href: '#' },
  { name: t('Terms'), href: '#' },
])


// Languages data
const languages = [
  { code: 'en', name: 'English', flag: '🇺🇸' },
  { code: 'ar', name: 'العربية', flag: '🇸🇦' },
  { code: 'fr', name: 'Français', flag: '🇫🇷' },
  { code: 'es', name: 'Español', flag: '🇪🇸' },
]

// Translations
const translations = {
  ar: {
    home: 'الرئيسية',
    aboutUs: 'من نحن',
    cuisines: 'المطابخ',
    reviews: 'التقييمات',
    contact: 'اتصل بنا',
    signIn: 'تسجيل الدخول'
  },
  en: {
    home: 'Home',
    aboutUs: 'About Us',
    cuisines: 'Cuisines',
    reviews: 'Reviews',
    contact: 'Contact',
    signIn: 'Sign In'
  }
}

// Computed properties
const cuisines = computed(() => {
  // Since we don't have cuisine field in database, we'll use a default list
  return ['سعودي', 'عربي', 'إيطالي', 'ياباني', 'صيني', 'هندي', 'مكسيكي', 'فرنسي']
})

const priceRanges = computed(() => {
  // Generate price ranges based on minimum_order from database
  const ranges = restaurants.value.map(r => {
    if (r.minimum_order <= 50) return '$'
    if (r.minimum_order <= 100) return '$$'
    return '$$$'
  })
  return [...new Set(ranges)]
})

const filteredRestaurants = computed(() => {
  return restaurants.value.filter(restaurant => {
    const matchesSearch = restaurant.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
                         restaurant.description.toLowerCase().includes(searchTerm.value.toLowerCase())

    // For now, we'll skip cuisine and price filtering since the database structure is different
    // You can add these filters later when you have the appropriate fields
    return matchesSearch
  })
})

// Navigation items
const navigationItems = computed(() => [
  { name: translations[currentLanguage.value].home, href: '#', icon: 'ChefHat' },
  { name: translations[currentLanguage.value].aboutUs, href: '#' },
  { name: translations[currentLanguage.value].cuisines, href: '#' },
  { name: translations[currentLanguage.value].reviews, href: '#' },
  { name: translations[currentLanguage.value].contact, href: '#', icon: 'Phone' },
])

// Methods
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value
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

const handleLanguageChange = (languageCode) => {
  currentLanguage.value = languageCode
  locale.value = languageCode
  isLanguageDropdownOpen.value = false
}

// Watch for language changes and update i18n locale
watch(currentLanguage, (newLang) => {
  locale.value = newLang
})

const getCurrentLanguage = () => {
  return languages.find(lang => lang.code === currentLanguage.value) || languages[0]
}

const viewMenu = (restaurantId) => {
  console.log('View menu for restaurant:', restaurantId)
  // Navigate to restaurant menu page
  window.location.href = `/restaurants/${restaurantId}`
}

const clearFilters = () => {
  searchTerm.value = ''
  cuisineFilter.value = 'all'
  priceFilter.value = 'all'
}

const handleImageError = (event) => {
  event.target.src = '/images/default-restaurant-cover.png'
}

const handleProductImageError = (event) => {
  event.target.src = '/images/default-product.png'
}

const viewProduct = (productId) => {
  console.log('View product:', productId)
  // Navigate to product details or restaurant menu
  // For now, we'll navigate to the restaurant that has this product
  const product = recentProducts.value.find(p => p.id === productId)
  if (product && product.restaurant) {
    window.location.href = `/restaurants/${product.restaurant.id}`
  }
}

// Fetch restaurants from database
const fetchRestaurants = async () => {
  try {
    const response = await fetch('/api/restaurants')
    const data = await response.json()
    restaurants.value = data.restaurants || []
  } catch (error) {
    console.error('Error fetching restaurants:', error)
    restaurants.value = []
  }
}

// Fetch recent products from database
const fetchRecentProducts = async () => {
  try {
    const response = await fetch('/api/products/recent')
    const data = await response.json()
    recentProducts.value = data.products || []
  } catch (error) {
    console.error('Error fetching recent products:', error)
    recentProducts.value = []
  }
}

// Helper functions
const getPriceRange = (minimumOrder) => {
  if (minimumOrder <= 50) return '$'
  if (minimumOrder <= 100) return '$$'
  return '$$$'
}

const getWorkingHours = (workingHours) => {
  if (!workingHours || typeof workingHours !== 'object') {
    return 'ساعات العمل غير متوفرة'
  }

  // If it's an object with day-specific hours, show a general message
  if (workingHours.monday || workingHours.tuesday) {
    return 'مفتوح اليوم'
  }

  return 'ساعات العمل غير متوفرة'
}

// Fetch restaurants and products on component mount
fetchRestaurants()
fetchRecentProducts()

// Close dropdowns when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    isLanguageDropdownOpen.value = false
  }
}

// Add event listener for outside clicks
if (typeof window !== 'undefined') {
  document.addEventListener('click', handleClickOutside)
}
</script>
