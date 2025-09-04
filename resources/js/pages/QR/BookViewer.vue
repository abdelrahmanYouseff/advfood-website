<template>
  <div class="min-h-screen bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50" dir="rtl">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main Content -->
    <div class="py-8">
      <div class="max-w-4xl mx-auto px-4">
        <!-- Main Book Panel -->
        <div class="relative bg-gradient-to-br from-amber-800 to-amber-900 rounded-3xl shadow-2xl overflow-hidden">
          <!-- Book Content -->
          <div class="p-8">
            <!-- Image Display -->
            <div v-if="currentImage" class="flex justify-center items-center min-h-[60vh]">
              <img
                :src="`/asset/${currentImage.filename}`"
                :alt="currentImage.name"
                class="max-w-full max-h-[70vh] object-contain rounded-2xl shadow-2xl"
                @load="onImageLoad"
                @error="onImageError"
              />
            </div>

            <!-- No Image -->
            <div v-else class="flex justify-center items-center min-h-[60vh]">
              <div class="w-32 h-32 bg-amber-700 rounded-2xl"></div>
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
