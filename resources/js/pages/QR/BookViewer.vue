<template>
  <div class="min-h-screen bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50" dir="rtl">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-amber-200 shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <div class="relative">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-12 h-12 rounded-lg shadow-lg" />
              <div class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg opacity-20 blur-sm"></div>
            </div>
            <div>
              <h1 class="text-xl font-bold text-amber-800">ADVFOOD</h1>
              <p class="text-xs text-amber-600 -mt-1">معرض الصور</p>
            </div>
          </div>

          <!-- Page Info -->
          <div class="text-center">
            <div class="text-amber-800 font-bold text-lg">
              {{ currentIndex }} / {{ totalImages }}
            </div>
            <div class="text-amber-600 text-sm">
              {{ currentImage?.name || 'صورة غير متوفرة' }}
            </div>
          </div>

          <!-- Navigation -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <Link
              v-if="previousImage"
              :href="`/qrs/${currentIndex - 1}`"
              class="flex items-center px-4 py-2 bg-amber-700 hover:bg-amber-800 text-white rounded-lg transition-all duration-200"
            >
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              السابق
            </Link>
            <Link
              v-if="nextImage"
              :href="`/qrs/${currentIndex + 1}`"
              class="flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-all duration-200"
            >
              التالي
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
            </Link>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="pt-20 pb-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Book Container -->
        <div class="relative max-w-4xl mx-auto">
          <!-- Book Shadow -->
          <div class="absolute inset-0 bg-gradient-to-r from-amber-800 to-amber-900 rounded-3xl shadow-2xl transform rotate-1 scale-105 opacity-30"></div>
          
          <!-- Main Book Panel -->
          <div class="relative bg-gradient-to-br from-amber-800 to-amber-900 rounded-3xl shadow-2xl overflow-hidden">
            <!-- Book Content -->
            <div class="p-8">
              <!-- Image Title -->
              <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-white mb-2" style="font-family: 'Dancing Script', cursive;">
                  {{ currentImage?.name || 'معرض الصور' }}
                </h2>
                <p class="text-amber-200 text-lg">صفحة {{ currentIndex }} من {{ totalImages }}</p>
              </div>

              <!-- Image Container -->
              <div class="relative max-w-4xl mx-auto">
                <div v-if="currentImage" class="relative group">
                  <!-- Page Turn Effect -->
                  <div v-if="isFlipping" class="absolute inset-0 z-10 pointer-events-none">
                    <div class="w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent transform -skew-x-12 animate-pulse"></div>
                  </div>
                  
                  <!-- Image Frame -->
                  <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:scale-105" :class="{ 'flip-animation': isFlipping }">
                    <!-- Image -->
                    <img
                      :src="`/asset/${currentImage.filename}`"
                      :alt="currentImage.name"
                      class="w-full h-auto max-h-[50vh] object-contain transition-all duration-500"
                      :class="{ 'transform scale-95 opacity-80': isFlipping }"
                      @load="onImageLoad"
                      @error="onImageError"
                    />
                    
                    <!-- Loading Overlay -->
                    <div v-if="isLoading" class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                      <div class="flex flex-col items-center">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-500"></div>
                        <p class="mt-4 text-gray-600">جاري تحميل الصورة...</p>
                      </div>
                    </div>
                    
                    <!-- Error Overlay -->
                    <div v-if="hasError" class="absolute inset-0 bg-gray-200 flex items-center justify-center">
                      <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <p class="text-gray-600">خطأ في تحميل الصورة</p>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Image Info -->
                  <div class="mt-6 text-center">
                    <p class="text-white text-lg leading-relaxed">
                      صورة عالية الجودة من معرض الصور التفاعلي. يمكنك تصفح جميع الصور باستخدام أزرار التنقل أدناه.
                    </p>
                  </div>
                </div>
                
                <!-- No Image Message -->
                <div v-else class="text-center py-20">
                  <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.709M15 6.291A7.962 7.962 0 0012 5c-2.34 0-4.29 1.009-5.824 2.709"></path>
                  </svg>
                  <h2 class="text-2xl font-bold text-gray-800 mb-2">الصورة غير متوفرة</h2>
                  <p class="text-gray-600 mb-6">لا توجد صورة بهذا الرقم</p>
                  <Link
                    href="/qrs/1"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-full hover:from-red-600 hover:to-orange-600 transition-all duration-200"
                  >
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    العودة للصفحة الأولى
                  </Link>
                </div>
              </div>
              
              <!-- Pricing Section -->
              <div class="mt-8 pt-6 border-t border-amber-600">
                <div class="grid grid-cols-2 gap-8 text-center">
                  <div>
                    <div class="text-amber-200 text-sm mb-2">عرض عادي</div>
                    <div class="text-white text-2xl font-bold">مجاني</div>
                  </div>
                  <div>
                    <div class="text-amber-200 text-sm mb-2">عرض مميز</div>
                    <div class="text-white text-2xl font-bold">مجاني</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation Bar -->
        <div class="flex justify-center mt-8">
          <div class="bg-white/90 backdrop-blur-sm rounded-2xl px-8 py-4 shadow-xl border border-amber-200">
            <div class="flex items-center space-x-6 space-x-reverse">
              <!-- Previous Button -->
              <Link
                v-if="previousImage"
                :href="`/qrs/${currentIndex - 1}`"
                class="flex items-center justify-center w-10 h-10 bg-amber-600 hover:bg-amber-700 text-white rounded-full transition-all duration-200 hover:scale-110"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </Link>
              
              <!-- Page Dots -->
              <div class="flex items-center space-x-2 space-x-reverse">
                <div
                  v-for="(image, index) in allImages"
                  :key="index"
                  class="w-3 h-3 rounded-full transition-all duration-200"
                  :class="index + 1 === currentIndex ? 'bg-amber-600 scale-125' : 'bg-amber-300'"
                ></div>
              </div>
              
              <!-- Next Button -->
              <Link
                v-if="nextImage"
                :href="`/qrs/${currentIndex + 1}`"
                class="flex items-center justify-center w-10 h-10 bg-amber-600 hover:bg-amber-700 text-white rounded-full transition-all duration-200 hover:scale-110"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </Link>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  currentImage: Object,
  currentIndex: Number,
  totalImages: Number,
  previousImage: Object,
  nextImage: Object,
  allImages: Array
})

const isLoading = ref(true)
const hasError = ref(false)
const isFlipping = ref(false)

const onImageLoad = () => {
  isLoading.value = false
  hasError.value = false
}

const onImageError = () => {
  isLoading.value = false
  hasError.value = true
}

const triggerFlipEffect = () => {
  isFlipping.value = true
  setTimeout(() => {
    isFlipping.value = false
  }, 600)
}

onMounted(() => {
  if (props.currentImage) {
    isLoading.value = true
    hasError.value = false
  }
})
</script>

<style scoped>
/* Custom animations */
@keyframes flip {
  0% { 
    transform: rotateY(0deg) scale(1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  }
  25% { 
    transform: rotateY(-15deg) scale(0.98);
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
  }
  50% { 
    transform: rotateY(-30deg) scale(0.95);
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
  }
  75% { 
    transform: rotateY(-15deg) scale(0.98);
    box-shadow: 0 15px 40px rgba(0,0,0,0.4);
  }
  100% { 
    transform: rotateY(0deg) scale(1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  }
}

@keyframes pageTurn {
  0% { 
    transform: translateX(0) rotateY(0deg);
    opacity: 1;
  }
  50% { 
    transform: translateX(-20px) rotateY(-10deg);
    opacity: 0.8;
  }
  100% { 
    transform: translateX(0) rotateY(0deg);
    opacity: 1;
  }
}

.flip-animation {
  animation: flip 0.8s ease-in-out;
}

.page-turn {
  animation: pageTurn 0.6s ease-in-out;
}

/* Book-like shadows */
.book-shadow {
  box-shadow: 
    0 0 0 1px rgba(0,0,0,0.1),
    0 10px 30px rgba(0,0,0,0.3),
    0 0 0 1px rgba(255,255,255,0.1) inset;
}

/* Smooth transitions */
* {
  transition: all 0.3s ease;
}

/* Hover effects for book pages */
.book-page:hover {
  transform: translateY(-2px);
  box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}
</style>
