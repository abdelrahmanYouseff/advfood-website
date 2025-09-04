<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black" dir="rtl">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-md border-b border-gray-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- Logo -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <div class="relative">
              <img src="/Foods Logo.png" alt="ADVFOOD" class="w-12 h-12 rounded-lg shadow-lg" />
              <div class="absolute -inset-1 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg opacity-20 blur-sm"></div>
            </div>
            <div>
              <h1 class="text-xl font-bold text-white">ADVFOOD</h1>
              <p class="text-xs text-gray-400 -mt-1">معرض الصور</p>
            </div>
          </div>

          <!-- Page Info -->
          <div class="text-center">
            <div class="text-white font-bold text-lg">
              {{ currentIndex }} / {{ totalImages }}
            </div>
            <div class="text-gray-400 text-sm">
              {{ currentImage?.name || 'صورة غير متوفرة' }}
            </div>
          </div>

          <!-- Navigation -->
          <div class="flex items-center space-x-4 space-x-reverse">
            <Link
              v-if="previousImage"
              :href="`/qrs/${currentIndex - 1}`"
              class="flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all duration-200"
            >
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              السابق
            </Link>
            <Link
              v-if="nextImage"
              :href="`/qrs/${currentIndex + 1}`"
              class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all duration-200"
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
        <div class="relative">
          <!-- Book Shadow -->
          <div class="absolute inset-0 bg-gradient-to-r from-gray-800 to-gray-900 rounded-3xl shadow-2xl transform rotate-1 scale-105 opacity-50"></div>
          
          <!-- Book -->
          <div class="relative bg-gradient-to-br from-amber-50 to-amber-100 rounded-3xl shadow-2xl overflow-hidden">
            <!-- Book Spine -->
            <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-b from-amber-800 to-amber-900 shadow-lg"></div>
            
            <!-- Book Binding Holes -->
            <div class="absolute left-4 top-1/4 w-1 h-1 bg-amber-700 rounded-full"></div>
            <div class="absolute left-4 top-1/2 w-1 h-1 bg-amber-700 rounded-full"></div>
            <div class="absolute left-4 top-3/4 w-1 h-1 bg-amber-700 rounded-full"></div>
            
            <!-- Book Pages -->
            <div class="ml-8 mr-4 py-8">
              <!-- Page Header -->
              <div class="text-center mb-8">
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-full shadow-lg">
                  <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  معرض الصور - صفحة {{ currentIndex }}
                </div>
              </div>

              <!-- Image Container -->
              <div class="relative max-w-4xl mx-auto">
                <div v-if="currentImage" class="relative group">
                  <!-- Page Turn Effect -->
                  <div v-if="isFlipping" class="absolute inset-0 z-10 pointer-events-none">
                    <div class="w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent transform -skew-x-12 animate-pulse"></div>
                  </div>
                  
                  <!-- Image Frame -->
                  <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 hover:scale-105 book-shadow" :class="{ 'flip-animation': isFlipping }">
                    <!-- Page Corner -->
                    <div class="absolute top-4 right-4 w-8 h-8 bg-gradient-to-br from-amber-200 to-amber-300 rounded-bl-2xl shadow-md"></div>
                    
                    <!-- Page Lines -->
                    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
                      <div class="absolute top-8 left-8 w-1 h-full bg-gradient-to-b from-transparent via-amber-100 to-transparent opacity-50"></div>
                      <div class="absolute top-8 right-8 w-1 h-full bg-gradient-to-b from-transparent via-amber-100 to-transparent opacity-50"></div>
                    </div>
                    
                    <!-- Image -->
                    <img
                      :src="`/asset/${currentImage.filename}`"
                      :alt="currentImage.name"
                      class="w-full h-auto max-h-[70vh] object-contain transition-all duration-500"
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
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ currentImage.name }}</h2>
                    <p class="text-gray-600">صفحة {{ currentIndex }} من {{ totalImages }}</p>
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
            </div>
          </div>
        </div>

        <!-- Navigation Controls -->
        <div class="flex justify-center items-center mt-12 space-x-8 space-x-reverse">
          <!-- Previous Button -->
          <Link
            v-if="previousImage"
            :href="`/qrs/${currentIndex - 1}`"
            class="group flex items-center px-8 py-4 bg-gradient-to-r from-gray-700 to-gray-800 text-white rounded-2xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105"
          >
            <svg class="w-6 h-6 ml-3 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="font-bold">الصفحة السابقة</span>
          </Link>
          
          <!-- Page Indicator -->
          <div class="flex items-center space-x-2 space-x-reverse">
            <div class="text-white text-lg font-bold">
              {{ currentIndex }} / {{ totalImages }}
            </div>
          </div>
          
          <!-- Next Button -->
          <Link
            v-if="nextImage"
            :href="`/qrs/${currentIndex + 1}`"
            class="group flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl hover:from-red-600 hover:to-orange-600 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105"
          >
            <span class="font-bold">الصفحة التالية</span>
            <svg class="w-6 h-6 mr-3 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
          </Link>
        </div>

        <!-- Thumbnail Navigation -->
        <div v-if="allImages.length > 1" class="mt-12">
          <div class="text-center mb-6">
            <h3 class="text-xl font-bold text-white mb-2">تصفح الصور</h3>
            <p class="text-gray-400">انقر على أي صورة للانتقال إليها</p>
          </div>
          
          <div class="flex justify-center">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 max-w-4xl">
              <Link
                v-for="(image, index) in allImages"
                :key="index"
                :href="`/qrs/${index + 1}`"
                class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 book-page"
                :class="index + 1 === currentIndex ? 'ring-4 ring-red-500' : ''"
              >
                <img
                  :src="`/asset/${image.filename}`"
                  :alt="image.name"
                  class="w-full h-24 object-cover group-hover:scale-110 transition-transform duration-300"
                />
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                  <span class="text-white font-bold text-sm">{{ index + 1 }}</span>
                </div>
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
