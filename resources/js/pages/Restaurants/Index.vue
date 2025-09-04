<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 via-yellow-50 to-orange-50" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
    <!-- Enhanced Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-2xl border-b border-red-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <div class="relative">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-14 h-14 drop-shadow-lg" />
              <div class="absolute -inset-1 bg-gradient-to-r from-red-500 to-orange-500 rounded-full opacity-20 blur-sm"></div>
            </div>
            <div>
              <h1 class="text-2xl font-bold bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">ADVFOOD</h1>
              <p class="text-xs text-gray-500 -mt-1">منصة طلب الطعام الأولى</p>
            </div>
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex items-center space-x-8 space-x-reverse">
            <a href="/" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              الرئيسية
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/restaurants" class="group relative text-red-600 font-medium">
              المطاعم
              <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-gradient-to-r from-red-500 to-orange-500"></span>
            </a>
            <a href="/cart" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              السلة
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/login" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              تسجيل الدخول
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/register" class="relative bg-gradient-to-r from-red-500 to-orange-500 text-white px-6 py-3 rounded-full font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group overflow-hidden">
              <span class="relative z-10">إنشاء حساب</span>
              <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
          </nav>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button class="text-gray-700 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Hero Section with Parallax -->
    <div class="relative overflow-hidden bg-gradient-to-br from-red-600 via-orange-600 to-yellow-600 pt-24">
      <!-- Animated Background -->
      <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-red-700/90 to-orange-700/90"></div>
        <div class="absolute top-0 left-0 w-full h-full">
          <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute top-40 right-20 w-96 h-96 bg-yellow-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
          <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-red-400/15 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="text-center">
          <div class="mb-12">
            <div class="inline-flex items-center px-8 py-4 bg-white/20 backdrop-blur-sm rounded-full text-white text-lg font-medium mb-8 border border-white/30">
              <svg class="w-6 h-6 ml-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              توصيل سريع • طعام طازج • أفضل الأسعار
            </div>
          </div>

          <div class="flex items-center justify-center mb-12" :class="$i18n.locale === 'ar' ? 'flex-row-reverse' : 'flex-row'">
            <div class="relative">
              <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-24 w-24 md:h-32 md:w-32 rounded-2xl shadow-2xl" :class="$i18n.locale === 'ar' ? 'ml-6' : 'mr-6'">
              <div class="absolute -inset-4 bg-gradient-to-r from-yellow-400/30 to-orange-400/30 rounded-2xl blur-2xl"></div>
            </div>
            <h1 class="text-6xl md:text-8xl font-bold text-white leading-tight">
              مرحباً بك في
              <span class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">
                ADVFOOD
              </span>
              <br>اكتشف أشهى المطاعم
            </h1>
          </div>
          <p class="text-2xl md:text-3xl text-red-100 mb-16 max-w-5xl mx-auto leading-relaxed">
            جرب أشهى الأطباق الطهي التي يتم توصيلها مباشرة إلى باب منزلك.
            من المفضلات المحلية إلى المأكولات العالمية، نحن نجلب لك نكهات العالم.
          </p>

          <!-- Enhanced Search Bar -->
          <div class="max-w-4xl mx-auto">
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-red-400 to-orange-500 rounded-3xl blur-2xl opacity-75 group-hover:opacity-100 transition-opacity duration-500"></div>
              <div class="relative bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20">
                <div class="flex items-center p-3">
                  <div class="flex-1 relative">
                    <input
                      v-model="searchQuery"
                      type="text"
                      placeholder="ابحث عن المطاعم أو المأكولات أو الأطباق..."
                      class="w-full pl-16 pr-6 py-6 text-xl border-0 bg-transparent focus:outline-none placeholder-gray-500 font-medium"
                    />
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                      <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                      </svg>
                    </div>
                  </div>
                  <button class="ml-3 px-12 py-6 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 text-lg">
                    بحث
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
    <div class="bg-white/90 backdrop-blur-md shadow-2xl border-b border-red-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
          <div class="flex items-center space-x-8 space-x-reverse">
            <div class="flex items-center space-x-4 space-x-reverse">
              <div class="relative">
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-12 w-12 rounded-2xl shadow-lg">
                <div class="absolute -inset-1 bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl opacity-20 blur-sm"></div>
              </div>
              <span class="text-2xl font-bold text-gray-800">تصفية حسب:</span>
            </div>
            <div class="flex space-x-4 space-x-reverse">
              <select
                v-model="sortBy"
                class="px-8 py-4 border-0 bg-white/80 backdrop-blur-sm rounded-2xl focus:ring-2 focus:ring-red-500 focus:outline-none shadow-xl text-gray-700 font-bold transition-all duration-300 hover:bg-white text-lg"
              >
                <option value="rating">⭐ أعلى تقييم</option>
                <option value="delivery_time">⚡ أسرع توصيل</option>
                <option value="delivery_fee">💰 أقل رسوم توصيل</option>
              </select>
            </div>
          </div>

                                  <div class="flex items-center space-x-6 space-x-reverse">
              <Link
                :href="route('cart.index')"
                class="relative group inline-flex items-center px-10 py-5 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 shadow-2xl hover:shadow-red-500/25 transform hover:scale-105 text-lg"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-7 h-7 rounded-lg shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-3'">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-3'">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                </svg>
                عرض السلة
                <span v-if="cartCount > 0" class="absolute bg-red-500 text-white text-sm rounded-full h-8 w-8 flex items-center justify-center font-bold shadow-lg" :class="$i18n.locale === 'ar' ? '-top-3 -left-3' : '-top-3 -right-3'">
                  {{ cartCount }}
                </span>
              </Link>

              <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="flex items-center text-gray-700 hover:text-red-600 font-bold transition-all duration-300 px-6 py-3 rounded-xl hover:bg-red-50 text-lg"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-6 h-6 rounded-lg shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-3'">
                حسابي
              </Link>
              <Link
                v-else
                :href="route('login')"
                class="flex items-center text-gray-700 hover:text-red-600 font-bold transition-all duration-300 px-6 py-3 rounded-xl hover:bg-red-50 text-lg"
              >
                <img src="/Foods Logo.png" alt="ADVFood Logo" class="w-6 h-6 rounded-lg shadow-sm" :class="$i18n.locale === 'ar' ? 'ml-3' : 'mr-2'">
                تسجيل الدخول
              </Link>
            </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Restaurants Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <!-- Results Count -->
      <div class="mb-16 text-center">
        <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-100 to-orange-100 rounded-full text-red-700 text-sm font-medium mb-8">
          <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
          {{ filteredRestaurants.length }} مطعم متميز
        </div>
        <div class="flex items-center justify-center mb-8" :class="$i18n.locale === 'ar' ? 'flex-row-reverse' : 'flex-row'">
          <div class="relative">
            <img src="/Foods Logo.png" alt="ADVFood Logo" class="h-16 w-16 rounded-2xl shadow-2xl" :class="$i18n.locale === 'ar' ? 'ml-6' : 'mr-6'">
            <div class="absolute -inset-2 bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl opacity-20 blur-lg"></div>
          </div>
          <h2 class="text-5xl font-bold text-gray-900">
            اكتشف أفضل
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-600">المطاعم</span>
          </h2>
        </div>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
          اكتشف التميز الطهي مع مجموعتنا المختارة من أفضل المطاعم في منطقتك
        </p>
      </div>

      <!-- Enhanced Restaurants Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <div
          v-for="restaurant in filteredRestaurants"
          :key="restaurant.id"
          class="group relative bg-white rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-700 overflow-hidden transform hover:-translate-y-6 border border-red-100"
        >
          <!-- Restaurant Image -->
          <div class="relative h-64 bg-gradient-to-br from-red-100 to-orange-100 overflow-hidden">
            <img
              v-if="restaurant.cover_image_url"
              :src="restaurant.cover_image_url"
              :alt="restaurant.name"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
              @error="console.log('Cover image failed to load:', restaurant.cover_image_url)"
              @load="console.log('Cover image loaded successfully:', restaurant.cover_image_url)"
            />
            <div v-else class="w-full h-full bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
              <div class="text-center">
                <svg class="w-16 h-16 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <p class="text-red-500 font-medium text-sm">صورة المطعم</p>
              </div>
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
          </div>

          <!-- Restaurant Info - Simplified -->
          <div class="p-8 text-center">
            <!-- Restaurant Logo -->
            <div class="flex justify-center mb-6">
              <div class="relative">
                <img
                  v-if="restaurant.logo_url"
                  :src="restaurant.logo_url"
                  :alt="restaurant.name"
                  class="w-20 h-20 rounded-2xl object-cover border-4 border-red-100 shadow-xl"
                  @error="console.log('Logo failed to load:', restaurant.logo_url)"
                  @load="console.log('Logo loaded successfully:', restaurant.logo_url)"
                />
                <div v-else class="w-20 h-20 rounded-2xl bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center border-4 border-red-100 shadow-xl">
                  <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                  </svg>
                </div>
                <!-- Status Icon -->
                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full border-2 border-white shadow-lg flex items-center justify-center">
                  <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Restaurant Name -->
            <h3 class="text-2xl font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-300 mb-4">
              {{ restaurant.name }}
            </h3>

            <!-- Action Button -->
            <Link
              :href="route('restaurants.show', restaurant.id)"
              class="group/btn relative w-full bg-gradient-to-r from-red-500 to-orange-500 text-white py-4 px-6 rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 text-center block shadow-xl hover:shadow-red-500/25 transform hover:scale-105 overflow-hidden"
            >
              <span class="relative z-10 flex items-center justify-center text-base">
                استكشف القائمة
                <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" :class="$i18n.locale === 'ar' ? 'mr-2 group-hover/btn:-translate-x-1' : 'ml-2 group-hover/btn:translate-x-1'" :style="$i18n.locale === 'ar' ? 'transform: scaleX(-1)' : ''">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
              </span>
              <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
            </Link>
          </div>
        </div>
      </div>

      <!-- Enhanced Empty State -->
      <div v-if="filteredRestaurants.length === 0" class="text-center py-32">
        <div class="max-w-2xl mx-auto">
          <div class="relative w-40 h-40 mx-auto mb-12">
            <div class="absolute inset-0 bg-gradient-to-br from-red-100 to-orange-100 rounded-full animate-pulse"></div>
            <div class="absolute inset-4 bg-gradient-to-br from-red-200 to-orange-200 rounded-full flex items-center justify-center">
              <svg class="w-20 h-20 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
              </svg>
            </div>
          </div>
          <h3 class="text-4xl font-bold text-gray-900 mb-6">لم نجد مطاعم</h3>
          <p class="text-xl text-gray-600 mb-12 leading-relaxed">جرب البحث بكلمات مختلفة أو اضبط الفلاتر الخاصة بك</p>
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
