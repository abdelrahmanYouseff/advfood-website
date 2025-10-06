<template>
  <div class="min-h-screen bg-gray-50" :dir="$i18n.locale === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center">
            <img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" alt="GatherUs Logo" class="w-16 h-16" />
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
                <span class="text-gray-600">التقييم:</span>
                <span class="font-medium">{{ restaurant.rating || '4.5' }} ⭐</span>
              </div>
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

    <!-- Professional Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-slate-900 to-black text-white">
      <!-- Main Footer Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div class="lg:col-span-1">
            <div class="flex items-center mb-6">
              <img src="http://127.0.0.1:8002/images/gatherus-logo-new.png" alt="GatherUs Logo" class="w-12 h-12 rounded-xl shadow-lg" />
              <h3 class="text-2xl font-bold ml-3 bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">
                منصتنا
              </h3>
            </div>
            <p class="text-gray-400 mb-6 leading-relaxed">
              منصة طلب الطعام الرائدة التي تجمع بين أفضل المطاعم وتجربة طلب سلسة وآمنة.
            </p>
            <!-- Social Media Icons -->
            <div class="space-y-4">
              <h5 class="text-lg font-semibold text-white mb-4">تابعنا على</h5>
              <div class="flex gap-2">
                <!-- Facebook -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                </a>

                <!-- Instagram -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-purple-500 via-pink-500 to-orange-500 rounded-lg hover:from-purple-600 hover:via-pink-600 hover:to-orange-600 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-pink-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.83-9.281c-.49 0-.98-.49-.98-.98s.49-.98.98-.98.98.49.98.98-.49.98-.98.98zm-5.83 8.281c-1.297 0-2.448-.49-3.323-1.297C6.198 13.895 5.708 12.744 5.708 11.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297z"/>
                  </svg>
                </a>

                <!-- Twitter -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-sky-500 to-sky-600 rounded-lg hover:from-sky-600 hover:to-sky-700 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-sky-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                  </svg>
                </a>

                <!-- YouTube -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-red-600 to-red-700 rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-red-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                  </svg>
                </a>

                <!-- LinkedIn -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-blue-700 to-blue-800 rounded-lg hover:from-blue-800 hover:to-blue-900 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                  </svg>
                </a>

                <!-- WhatsApp -->
                <a href="#" class="group relative w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-green-500/25 flex items-center justify-center">
                  <svg class="w-4 h-4 text-white transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                  </svg>
                </a>
              </div>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">روابط سريعة</h4>
            <ul class="space-y-3">
              <li><a href="/" class="text-gray-400 hover:text-white transition-colors duration-300">الرئيسية</a></li>
              <li><a href="/restaurants" class="text-gray-400 hover:text-white transition-colors duration-300">المطاعم</a></li>
              <li><a href="/cart" class="text-gray-400 hover:text-white transition-colors duration-300">السلة</a></li>
              <li><a href="/login" class="text-gray-400 hover:text-white transition-colors duration-300">تسجيل الدخول</a></li>
              <li><a href="/register" class="text-gray-400 hover:text-white transition-colors duration-300">إنشاء حساب</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">خدماتنا</h4>
            <ul class="space-y-3">
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">توصيل سريع</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">دفع آمن</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">تتبع الطلب</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">دعم العملاء</a></li>
              <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">برنامج الولاء</a></li>
            </ul>
          </div>

          <!-- Contact Info -->
          <div>
            <h4 class="text-lg font-semibold mb-6 text-white">تواصل معنا</h4>
            <div class="space-y-4">
              <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-gray-400">info@ourplatform.com</span>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <span class="text-gray-400">+966 50 123 4567</span>
              </div>
              <div class="flex items-center">
                <svg class="w-5 h-5 text-red-400 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-gray-400">الرياض، المملكة العربية السعودية</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Footer -->
      <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-400 text-sm mb-4 md:mb-0">
              © 2025 منصتنا. جميع الحقوق محفوظة.
            </div>
            <div class="flex space-x-6" :class="$i18n.locale === 'ar' ? 'space-x-reverse' : ''">
              <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">سياسة الخصوصية</a>
              <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">شروط الاستخدام</a>
              <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-300">سياسة الاسترداد</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'

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
