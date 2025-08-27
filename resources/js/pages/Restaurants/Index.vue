<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 via-yellow-50 to-orange-50" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
    <!-- Hero Section with Parallax -->
    <div class="relative overflow-hidden bg-gradient-to-br from-red-600 via-orange-600 to-yellow-600">
      <!-- Animated Background -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-red-700/90 to-orange-700/90"></div>
        <div class="absolute top-0 left-0 w-full h-full">
          <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute top-40 right-20 w-96 h-96 bg-yellow-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
          <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-red-400/15 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
          <div class="mb-8">
            <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-6">
              <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              {{ $t('Fast Delivery • Fresh Food • Best Prices') }}
            </div>
          </div>

          <div class="flex items-center justify-center mb-6" :class="$i18n.locale === 'ar' ? 'flex-row-reverse' : 'flex-row'">
            <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-20 w-20 md:h-24 md:w-24 rounded-lg shadow-lg" :class="$i18n.locale === 'ar' ? 'ml-4' : 'mr-4'">
            <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight">
              {{ $t('Welcome to') }}
              <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                {{ $t('ADVFood') }}
              </span>
              <br>{{ $t('Discover Delicious Restaurants') }}
            </h1>
          </div>
          <p class="text-xl md:text-2xl text-red-100 mb-12 max-w-4xl mx-auto leading-relaxed">
            {{ $t('Experience the finest culinary delights delivered right to your doorstep.') }}
            {{ $t('From local favorites to international cuisine, we bring the world\'s flavors to you.') }}
          </p>

          <!-- Enhanced Search Bar -->
          <div class="max-w-3xl mx-auto">
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-orange-500 rounded-2xl blur-lg opacity-75 group-hover:opacity-100 transition-opacity duration-300"></div>
              <div class="relative bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20">
                <div class="flex items-center p-2">
                  <div class="flex-1 relative">
                    <input
                      v-model="searchQuery"
                      type="text"
                      :placeholder="$t('Search for restaurants, cuisines, or dishes...')"
                      class="w-full pl-12 pr-4 py-4 text-lg border-0 bg-transparent focus:outline-none placeholder-gray-500"
                    />
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                      <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                      </svg>
                    </div>
                  </div>
                  <button class="ml-2 px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-xl font-semibold hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    {{ $t('Search') }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Wave Decoration -->
      <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-20 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
          <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="currentColor"></path>
          <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
        </svg>
      </div>
    </div>

    <!-- Enhanced Filters Section -->
    <div class="bg-white/80 backdrop-blur-sm shadow-lg border-b border-white/20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                      <div class="flex items-center space-x-6" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
              <div class="flex items-center space-x-3" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-8 w-8 rounded-lg shadow-sm">
                <span class="text-lg font-semibold text-gray-800">{{ $t('Filter by:') }}</span>
              </div>
              <div class="flex space-x-3" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
              <select
                v-model="sortBy"
                class="px-6 py-3 border-0 bg-white/70 backdrop-blur-sm rounded-xl focus:ring-2 focus:ring-red-500 focus:outline-none shadow-lg text-gray-700 font-medium transition-all duration-200 hover:bg-white"
              >
                <option value="rating">⭐ {{ $t('Highest Rated') }}</option>
                <option value="delivery_time">⚡ {{ $t('Fastest Delivery') }}</option>
                <option value="delivery_fee">💰 {{ $t('Lowest Delivery Fee') }}</option>
              </select>
            </div>
          </div>

                                  <div class="flex items-center space-x-4" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
              <Link
                :href="route('cart.index')"
                class="relative group inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-xl font-semibold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-6 h-6 rounded shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-3'">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-3'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                {{ $t('View Cart') }}
                <span v-if="cartCount > 0" class="absolute bg-red-500 text-white text-sm rounded-full h-7 w-7 flex items-center justify-center font-bold shadow-lg" :class="$i18n.locale === 'ar' ? '-top-3 -left-3' : '-top-3 -right-3'">
                  {{ cartCount }}
                </span>
              </Link>

              <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="flex items-center text-gray-700 hover:text-red-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-red-50"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-5 h-5 rounded shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-2' : 'mr-2'">
                {{ $t('My Account') }}
              </Link>
              <Link
                v-else
                :href="route('login')"
                class="flex items-center text-gray-700 hover:text-red-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-red-50"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-5 h-5 rounded shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-2' : 'mr-2'">
                {{ $t('Login') }}
              </Link>
            </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Restaurants Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <!-- Results Count -->
      <div class="mb-12 text-center">
        <div class="flex items-center justify-center mb-6" :class="$i18n.locale === 'ar' ? 'flex-row-reverse' : 'flex-row'">
          <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-12 w-12 rounded-lg shadow-lg" :class="$i18n.locale === 'ar' ? 'ml-4' : 'mr-4'">
          <h2 class="text-4xl font-bold text-gray-900">
            {{ filteredRestaurants.length }} {{ $t('Amazing Restaurants') }}
          </h2>
        </div>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
          {{ $t('Discover culinary excellence with our curated selection of the finest restaurants in your area') }}
        </p>
      </div>

      <!-- Enhanced Restaurants Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="restaurant in filteredRestaurants"
          :key="restaurant.id"
          class="group relative bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-4"
        >

          <!-- Restaurant Image with Overlay -->
          <div class="relative h-72 bg-gradient-to-br from-red-100 to-orange-100 overflow-hidden">
            <img
              v-if="restaurant.cover_image_url"
              :src="restaurant.cover_image_url"
              :alt="restaurant.name"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
              @error="console.log('Cover image failed to load:', restaurant.cover_image_url)"
              @load="console.log('Cover image loaded successfully:', restaurant.cover_image_url)"
            />
            <div v-else class="w-full h-full bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
              <svg class="w-16 h-16 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

            <!-- Enhanced Status Badge -->
            <div class="absolute top-6" :class="$i18n.locale === 'ar' ? 'left-6' : 'right-6'">
              <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-green-500 text-white shadow-2xl backdrop-blur-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" :class="$i18n.locale === 'ar' ? 'ml-2' : 'mr-2'">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ restaurant.delivery_time }} {{ $t('min') }}
              </span>
            </div>

            <!-- Enhanced Rating Badge -->
            <div class="absolute top-6" :class="$i18n.locale === 'ar' ? 'right-6' : 'left-6'">
              <div class="flex items-center bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full shadow-2xl">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-lg font-bold text-gray-900" :class="$i18n.locale === 'ar' ? 'mr-2' : 'ml-2'">{{ restaurant.rating }}</span>
              </div>
            </div>

            <!-- Floating Action Button -->
            <div class="absolute bottom-6 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0" :class="$i18n.locale === 'ar' ? 'left-6' : 'right-6'">
              <Link
                :href="route('restaurants.show', restaurant.id)"
                class="w-14 h-14 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-full flex items-center justify-center shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-200"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'rotate-180' : ''">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
              </Link>
            </div>
          </div>

          <!-- Enhanced Restaurant Info -->
          <div class="p-8">
            <div class="flex items-start justify-between mb-6">
              <div class="flex items-center">
                <div class="relative">
                  <img
                    :src="restaurant.logo_url"
                    :alt="restaurant.name"
                    class="w-20 h-20 rounded-2xl object-cover border-4 border-red-100 shadow-xl"
                    @error="console.log('Logo failed to load:', restaurant.logo_url)"
                    @load="console.log('Logo loaded successfully:', restaurant.logo_url)"
                  />
                  <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                </div>
                <div :class="$i18n.locale === 'ar' ? 'mr-6' : 'ml-6'">
                  <h3 class="text-2xl font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-200 mb-2">
                    {{ restaurant.name }}
                  </h3>
                  <p class="text-gray-600 flex items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'ml-2' : 'mr-2'">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ restaurant.address }}
                  </p>
                </div>
              </div>
            </div>

            <p class="text-gray-600 text-base mb-8 line-clamp-3 leading-relaxed">
              {{ restaurant.description }}
            </p>

            <!-- Enhanced Restaurant Stats -->
            <div class="grid grid-cols-2 gap-4 mb-8">
              <div class="text-center p-4 bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl border border-red-100">
                <div class="text-2xl font-bold text-red-600 mb-1">${{ restaurant.delivery_fee }}</div>
                <div class="text-sm text-gray-600 font-medium">{{ $t('Delivery Fee') }}</div>
              </div>
              <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl border border-gray-100">
                <div class="text-2xl font-bold text-gray-700 mb-1">${{ restaurant.minimum_order }}</div>
                <div class="text-sm text-gray-600 font-medium">{{ $t('Minimum Order') }}</div>
              </div>
            </div>

            <!-- Enhanced Action Button -->
            <Link
              :href="route('restaurants.show', restaurant.id)"
              class="w-full bg-gradient-to-r from-red-500 to-orange-500 text-white py-4 px-6 rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 text-center block shadow-xl hover:shadow-2xl transform hover:scale-105 group"
            >
              <span class="flex items-center justify-center">
                {{ $t('Explore Menu') }}
                <svg class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'mr-3 group-hover:-translate-x-1' : 'ml-3 group-hover:translate-x-1'" :style="$i18n.locale === 'ar' ? 'transform: scaleX(-1)' : ''">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
              </span>
            </Link>
          </div>
        </div>
      </div>

      <!-- Enhanced Empty State -->
      <div v-if="filteredRestaurants.length === 0" class="text-center py-20">
        <div class="max-w-md mx-auto">
          <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center">
            <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
          <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ $t('No Restaurants Found') }}</h3>
          <p class="text-xl text-gray-600 mb-8">{{ $t('Try searching with different keywords or adjust your filters') }}</p>
          <button
            @click="searchQuery = ''"
            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105"
          >
            {{ $t('Show All Restaurants') }}
          </button>
        </div>
      </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h3 class="text-4xl font-bold mb-6 bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">
            {{ $t('ADVFOOD - Best Food Delivery Experience') }}
          </h3>
          <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto">
            {{ $t('Fast • Secure • Reliable • Delicious') }}
          </p>
          <div class="flex justify-center space-x-12" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
            <div class="flex items-center text-lg text-gray-300">
              <div class="w-12 h-12 bg-green-500/20 rounded-full flex items-center justify-center" :class="$i18n.locale === 'ar' ? 'ml-4' : 'mr-4'">
                <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <span class="font-semibold">{{ $t('Fast Delivery') }}</span>
            </div>
            <div class="flex items-center text-lg text-gray-300">
              <div class="w-12 h-12 bg-yellow-500/20 rounded-full flex items-center justify-center" :class="$i18n.locale === 'ar' ? 'ml-4' : 'mr-4'">
                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <span class="font-semibold">{{ $t('Fresh Food') }}</span>
            </div>
            <div class="flex items-center text-lg text-gray-300">
              <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center" :class="$i18n.locale === 'ar' ? 'ml-4' : 'mr-4'">
                <svg class="w-6 h-6 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <span class="font-semibold">{{ $t('Secure Payment') }}</span>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  restaurants: Array,
})

const searchQuery = ref('')
const sortBy = ref('rating')
const cartCount = ref(0)

const filteredRestaurants = computed(() => {
  let filtered = props.restaurants

  // Search filter
  if (searchQuery.value) {
    filtered = filtered.filter(restaurant =>
      restaurant.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      restaurant.description?.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  }

  // Sort
  filtered.sort((a, b) => {
    switch (sortBy.value) {
      case 'rating':
        return b.rating - a.rating
      case 'delivery_time':
        return a.delivery_time - b.delivery_time
      case 'delivery_fee':
        return a.delivery_fee - b.delivery_fee
      default:
        return 0
    }
  })

  return filtered
})

onMounted(() => {
  // Get cart count from session
  const cart = JSON.parse(localStorage.getItem('cart') || '{}')
  cartCount.value = Object.keys(cart).length
})
</script>

<style scoped>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 10px;
}

::-webkit-scrollbar-track {
  background: #fef2f2;
  border-radius: 5px;
}

::-webkit-scrollbar-thumb {
  background: linear-gradient(to bottom, #ef4444, #f97316);
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(to bottom, #dc2626, #ea580c);
}

/* Animation delays */
.delay-500 {
  animation-delay: 500ms;
}

.delay-1000 {
  animation-delay: 1000ms;
}

/* Enhanced shadows */
.shadow-3xl {
  box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}
</style>
