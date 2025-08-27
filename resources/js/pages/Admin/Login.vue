<script setup>
import { Link, Form } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" dir="rtl">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden">
      <div class="absolute -top-40 -left-40 w-80 h-80 bg-green-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
      <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
      <div class="absolute top-40 right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="max-w-md w-full space-y-8 relative z-10">
      <!-- Header -->
      <div class="text-center">
        <div class="mx-auto h-20 w-20 bg-gradient-to-r from-green-500 to-blue-500 rounded-3xl flex items-center justify-center mb-6 shadow-2xl overflow-hidden">
          <img src="/Foods Logo.png" alt="شعار ADVFood" class="h-16 w-16 rounded-2xl">
        </div>
        <h2 class="text-4xl font-bold text-white mb-2">لوحة تحكم الأدمن</h2>
        <p class="text-gray-300">الوصول إلى لوحة تحكم إدارة ADVFood</p>
      </div>

      <!-- Login Form -->
      <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
        <Form
          method="post"
          :action="route('admin.login')"
          v-slot="{ errors, processing }"
          class="space-y-6"
        >
          <!-- Email Field -->
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-200 mb-2">
              بريد الأدمن الإلكتروني
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
              </div>
              <input
                id="email"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="email"
                placeholder="admin@gmail.com"
                class="w-full pr-10 pl-4 py-4 border border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-800/50 backdrop-blur-sm text-white placeholder-gray-400"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.email }"
              />
            </div>
            <p v-if="errors.email" class="mt-2 text-sm text-red-400">{{ errors.email }}</p>
          </div>

          <!-- Password Field -->
          <div>
            <label for="password" class="block text-sm font-semibold text-gray-200 mb-2">
              كلمة المرور
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </div>
              <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="أدخل كلمة مرور الأدمن"
                class="w-full pr-10 pl-4 py-4 border border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-800/50 backdrop-blur-sm text-white placeholder-gray-400"
                :class="{ 'border-red-500 focus:ring-red-500 focus:border-red-500': errors.password }"
              />
            </div>
            <p v-if="errors.password" class="mt-2 text-sm text-red-400">{{ errors.password }}</p>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="processing"
            class="w-full bg-gradient-to-r from-green-500 to-blue-500 text-white py-4 px-6 rounded-xl font-bold hover:from-green-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
          >
            <div class="flex items-center justify-center">
              <svg v-if="processing" class="animate-spin -mr-1 ml-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ processing ? 'جاري تسجيل الدخول...' : 'الوصول إلى لوحة التحكم' }}
            </div>
          </button>
        </Form>

        <!-- Security Notice -->
        <div class="mt-6 p-4 bg-yellow-500/10 border border-yellow-500/20 rounded-xl">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-yellow-400 ml-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm text-yellow-300 font-medium">منطقة وصول مقيدة</span>
          </div>
          <p class="text-xs text-gray-400 mt-1">فقط المدراء المصرح لهم يمكنهم الوصول إلى هذه اللوحة.</p>
        </div>
      </div>

      <!-- Back to Main Site -->
      <div class="text-center">
        <Link
          :href="route('restaurants.index')"
          class="text-gray-400 hover:text-white font-medium transition-colors duration-200 flex items-center justify-center"
        >
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          العودة إلى الموقع الرئيسي
        </Link>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes blob {
  0% {
    transform: translate(0px, 0px) scale(1);
  }
  33% {
    transform: translate(30px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-20px, 20px) scale(0.9);
  }
  100% {
    transform: translate(0px, 0px) scale(1);
  }
}

.animate-blob {
  animation: blob 7s infinite;
}

.animation-delay-2000 {
  animation-delay: 2s;
}

.animation-delay-4000 {
  animation-delay: 4s;
}
</style>
