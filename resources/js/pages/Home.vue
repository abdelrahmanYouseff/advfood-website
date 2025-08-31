<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 to-orange-50" dir="rtl">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-md shadow-xl border-b border-red-100 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <div class="relative">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-14 h-14 drop-shadow-lg" />
              <div class="absolute -inset-1 bg-gradient-to-r from-red-500 to-orange-500 rounded-full opacity-20 blur-sm"></div>
            </div>
            <div>
              <h1 class="text-3xl font-bold bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">ADVFOOD</h1>
              <p class="text-xs text-gray-500 -mt-1">منصة طلب الطعام الأولى</p>
            </div>
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex items-center space-x-8 space-x-reverse">
            <a href="/restaurants" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              المطاعم
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/cart" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              السلة
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/login" class="group relative text-gray-700 hover:text-red-600 font-medium transition-all duration-300">
              تسجيل الدخول
              <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-red-500 to-orange-500 group-hover:w-full transition-all duration-300"></span>
            </a>
            <a href="/register" class="relative bg-gradient-to-r from-red-500 to-orange-500 text-white px-8 py-3 rounded-full font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group overflow-hidden">
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

    <!-- Hero Section -->
    <section class="relative py-24 overflow-hidden bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-20 w-72 h-72 bg-red-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
        <div class="absolute top-40 left-20 w-72 h-72 bg-orange-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
        <div class="absolute -bottom-8 right-40 w-72 h-72 bg-yellow-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <!-- Content -->
          <div class="text-center lg:text-right space-y-8">
            <div class="space-y-4">
              <div class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                أكثر من 100+ مطعم
              </div>
              <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 leading-tight">
                اكتشف أفضل
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 animate-gradient">
                  المطاعم
                </span>
                <br>
                <span class="text-4xl lg:text-5xl">في منطقتك</span>
              </h1>
            </div>
            <p class="text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
              طلب طعام سريع وسهل من أشهى المطاعم. اختر من بين مئات الأطباق اللذيذة واحصل على طلبك في أسرع وقت ممكن مع ضمان الجودة والطازجة.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center lg:justify-start">
              <a href="/restaurants" class="group relative bg-gradient-to-r from-red-500 to-orange-500 text-white px-10 py-5 rounded-full text-lg font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-300 shadow-2xl hover:shadow-red-500/25 transform hover:scale-105 overflow-hidden">
                <span class="relative z-10 flex items-center justify-center">
                  <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                  استكشف المطاعم
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              </a>
              <a href="/register" class="group relative border-2 border-red-500 text-red-600 px-10 py-5 rounded-full text-lg font-bold hover:bg-red-500 hover:text-white transition-all duration-300 transform hover:scale-105 overflow-hidden">
                <span class="relative z-10 flex items-center justify-center">
                  <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                  </svg>
                  إنشاء حساب مجاني
                </span>
              </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 pt-8 border-t border-red-200">
              <div class="text-center">
                <div class="text-3xl font-bold text-red-600">100+</div>
                <div class="text-sm text-gray-600">مطعم</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-bold text-orange-600">1000+</div>
                <div class="text-sm text-gray-600">طبق</div>
              </div>
              <div class="text-center">
                <div class="text-3xl font-bold text-yellow-600">50K+</div>
                <div class="text-sm text-gray-600">عميل سعيد</div>
              </div>
            </div>
          </div>

          <!-- Hero Image -->
          <div class="relative">
            <div class="relative z-10 transform hover:scale-105 transition-transform duration-500">
              <div class="relative">
                <img src="/Foods Logo.png" alt="ADVFOOD" class="w-full max-w-lg mx-auto lg:mx-0 drop-shadow-2xl" />
                <div class="absolute -inset-4 bg-gradient-to-r from-red-500/20 to-orange-500/20 rounded-full blur-2xl"></div>
              </div>
            </div>
            <!-- Floating Elements -->
            <div class="absolute top-10 -right-10 w-20 h-20 bg-gradient-to-br from-red-400 to-orange-400 rounded-full opacity-80 animate-bounce"></div>
            <div class="absolute bottom-20 -left-10 w-16 h-16 bg-gradient-to-br from-orange-400 to-yellow-400 rounded-full opacity-80 animate-bounce animation-delay-1000"></div>
            <div class="absolute top-1/2 -right-5 w-12 h-12 bg-gradient-to-br from-yellow-400 to-red-400 rounded-full opacity-60 animate-pulse"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gradient-to-br from-white to-red-50/30">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
          <div class="inline-flex items-center px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-medium mb-6">
            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            مميزاتنا الفريدة
          </div>
          <h2 class="text-5xl font-bold text-gray-900 mb-6">لماذا تختار <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-600">ADVFOOD</span>؟</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">نقدم لك أفضل تجربة طلب طعام مع ضمان الجودة والسرعة والأمان</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="group relative text-center p-10 rounded-3xl bg-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border border-red-100">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-500/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
              <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-600 transition-colors duration-300">توصيل سريع</h3>
              <p class="text-gray-600 leading-relaxed">احصل على طلبك في أقل من 30 دقيقة مع خدمة توصيل موثوقة ومتطورة</p>
            </div>
          </div>

          <!-- Feature 2 -->
          <div class="group relative text-center p-10 rounded-3xl bg-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border border-red-100">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-500/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
              <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-600 transition-colors duration-300">جودة عالية</h3>
              <p class="text-gray-600 leading-relaxed">نختار لك أفضل المطاعم وأشهى الأطباق بجودة عالية وطازجة</p>
            </div>
          </div>

          <!-- Feature 3 -->
          <div class="group relative text-center p-10 rounded-3xl bg-white shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:scale-105 border border-red-100">
            <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-orange-500/5 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10">
              <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-r from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-600 transition-colors duration-300">أسعار مناسبة</h3>
              <p class="text-gray-600 leading-relaxed">أسعار تنافسية مع عروض وخصومات حصرية وبدون رسوم خفية</p>
            </div>
          </div>
        </div>

        <!-- Additional Features -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
          <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">دفع آمن</h4>
            <p class="text-sm text-gray-600">حماية كاملة لبياناتك</p>
          </div>

          <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">تتبع مباشر</h4>
            <p class="text-sm text-gray-600">اعرف مكان طلبك</p>
          </div>

          <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">دعم 24/7</h4>
            <p class="text-sm text-gray-600">خدمة عملاء متاحة</p>
          </div>

          <div class="text-center p-6 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-red-500 to-orange-500 rounded-xl flex items-center justify-center">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">توصيل فوري</h4>
            <p class="text-sm text-gray-600">في أقل من 30 دقيقة</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-24 bg-gradient-to-r from-red-600 via-orange-600 to-red-700 overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-24 h-24 bg-white rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white rounded-full"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
          <div class="inline-flex items-center px-6 py-3 rounded-full bg-white/20 text-white text-sm font-medium mb-8 backdrop-blur-sm">
            <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            انضم إلى أكثر من 50,000 عميل سعيد
          </div>
          
          <h2 class="text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">
            ابدأ رحلتك مع
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300">ADVFOOD</span>
            اليوم
          </h2>
          
          <p class="text-xl text-red-100 mb-12 leading-relaxed max-w-3xl mx-auto">
            انضم إلى آلاف العملاء الراضين واستمتع بأفضل تجربة طلب طعام مع ضمان الجودة والسرعة والأمان
          </p>
          
          <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="/restaurants" class="group relative bg-white text-red-600 px-12 py-5 rounded-full text-lg font-bold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-white/25 transform hover:scale-105 overflow-hidden">
              <span class="relative z-10 flex items-center justify-center">
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                استكشف المطاعم الآن
              </span>
              <div class="absolute inset-0 bg-gradient-to-r from-gray-100 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
            
            <a href="/register" class="group relative border-2 border-white text-white px-12 py-5 rounded-full text-lg font-bold hover:bg-white hover:text-red-600 transition-all duration-300 transform hover:scale-105 overflow-hidden">
              <span class="relative z-10 flex items-center justify-center">
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                إنشاء حساب مجاني
              </span>
            </a>
          </div>

          <!-- Trust Indicators -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 pt-16 border-t border-white/20">
            <div class="text-center">
              <div class="text-3xl font-bold text-white mb-2">⭐ 4.9/5</div>
              <div class="text-red-100">تقييم العملاء</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-white mb-2">🚚 15 دقيقة</div>
              <div class="text-red-100">متوسط وقت التوصيل</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-white mb-2">🔒 100%</div>
              <div class="text-red-100">دفع آمن</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div class="col-span-1 md:col-span-2">
            <div class="flex items-center space-x-4 mb-4">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-10 h-10" />
              <h3 class="text-2xl font-bold">ADVFOOD</h3>
            </div>
            <p class="text-gray-400 mb-4">
              منصة طلب طعام رائدة تقدم أفضل تجربة للمستخدمين والمطاعم على حد سواء.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-lg font-semibold mb-4">روابط سريعة</h4>
            <ul class="space-y-2">
              <li><a href="/restaurants" class="text-gray-400 hover:text-white transition-colors duration-200">المطاعم</a></li>
              <li><a href="/cart" class="text-gray-400 hover:text-white transition-colors duration-200">السلة</a></li>
              <li><a href="/login" class="text-gray-400 hover:text-white transition-colors duration-200">تسجيل الدخول</a></li>
              <li><a href="/register" class="text-gray-400 hover:text-white transition-colors duration-200">إنشاء حساب</a></li>
            </ul>
          </div>

          <!-- Contact -->
          <div>
            <h4 class="text-lg font-semibold mb-4">تواصل معنا</h4>
            <ul class="space-y-2 text-gray-400">
              <li>البريد الإلكتروني: info@advfood.com</li>
              <li>الهاتف: +966 50 123 4567</li>
              <li>العنوان: الرياض، المملكة العربية السعودية</li>
            </ul>
          </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
          <p class="text-gray-400">
            © 2025 ADVFOOD. جميع الحقوق محفوظة.
          </p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
// يمكن إضافة أي منطق إضافي هنا
</script>
