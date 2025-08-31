<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 to-orange-50">
    <!-- Header -->
    <header class="bg-white shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
          <!-- Logo -->
          <div class="flex items-center space-x-4">
            <img src="/Foods Logo.png" alt="ADVFOOD" class="w-12 h-12" />
            <h1 class="text-3xl font-bold text-gray-900">ADVFOOD</h1>
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex items-center space-x-8">
            <a href="/restaurants" class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-200">
              المطاعم
            </a>
            <a href="/cart" class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-200">
              السلة
            </a>
            <a href="/login" class="text-gray-700 hover:text-red-600 font-medium transition-colors duration-200">
              تسجيل الدخول
            </a>
            <a href="/register" class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-6 py-3 rounded-full font-medium hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-lg hover:shadow-xl">
              إنشاء حساب
            </a>
          </nav>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button class="text-gray-700 hover:text-red-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <!-- Content -->
          <div class="text-center lg:text-right">
            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
              اكتشف أفضل
              <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-orange-500">
                المطاعم
              </span>
              في منطقتك
            </h1>
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
              طلب طعام سريع وسهل من أشهى المطاعم. اختر من بين مئات الأطباق اللذيذة واحصل على طلبك في أسرع وقت ممكن.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <a href="/restaurants" class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-8 py-4 rounded-full text-lg font-bold hover:from-red-600 hover:to-orange-600 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105">
                استكشف المطاعم
              </a>
              <a href="/register" class="border-2 border-red-500 text-red-500 px-8 py-4 rounded-full text-lg font-bold hover:bg-red-500 hover:text-white transition-all duration-200">
                إنشاء حساب
              </a>
            </div>
          </div>

          <!-- Hero Image -->
          <div class="relative">
            <div class="relative z-10">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-full max-w-md mx-auto lg:mx-0" />
            </div>
            <!-- Decorative elements -->
            <div class="absolute -top-4 -right-4 w-32 h-32 bg-gradient-to-br from-red-200 to-orange-200 rounded-full opacity-50"></div>
            <div class="absolute -bottom-4 -left-4 w-24 h-24 bg-gradient-to-br from-orange-200 to-yellow-200 rounded-full opacity-50"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-4xl font-bold text-gray-900 mb-4">لماذا تختار ADVFOOD؟</h2>
          <p class="text-xl text-gray-600">نقدم لك أفضل تجربة طلب طعام</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 transition-all duration-300 transform hover:scale-105">
            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">توصيل سريع</h3>
            <p class="text-gray-600">احصل على طلبك في أسرع وقت ممكن مع خدمة توصيل موثوقة</p>
          </div>

          <!-- Feature 2 -->
          <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 transition-all duration-300 transform hover:scale-105">
            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">جودة عالية</h3>
            <p class="text-gray-600">نختار لك أفضل المطاعم وأشهى الأطباق بجودة عالية</p>
          </div>

          <!-- Feature 3 -->
          <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 transition-all duration-300 transform hover:scale-105">
            <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center">
              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">أسعار مناسبة</h3>
            <p class="text-gray-600">أسعار تنافسية مع عروض وخصومات حصرية</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-red-500 to-orange-500">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">ابدأ رحلتك مع ADVFOOD اليوم</h2>
        <p class="text-xl text-red-100 mb-8">انضم إلى آلاف العملاء الراضين واستمتع بأفضل تجربة طلب طعام</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="/restaurants" class="bg-white text-red-600 px-8 py-4 rounded-full text-lg font-bold hover:bg-gray-100 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105">
            استكشف المطاعم
          </a>
          <a href="/register" class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-bold hover:bg-white hover:text-red-600 transition-all duration-200">
            إنشاء حساب مجاني
          </a>
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
