<template>
  <div class="min-h-screen bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50" dir="rtl">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Main Content -->
    <div class="py-8">
      <div class="max-w-4xl mx-auto px-4">
        <!-- Book Title -->
        <div class="text-center mb-8">
          <h1 class="text-3xl font-bold mb-2" style="font-family: 'Playfair Display', serif; color: #662a37;">
            منيو ديلاوة
          </h1>
          <div class="w-24 h-1 mx-auto rounded-full" style="background-color: #662a37;"></div>
        </div>

        <!-- Main Book Panel -->
        <div class="relative rounded-3xl shadow-2xl overflow-hidden" style="background-color: #662a37;">
          <!-- Book Content -->
          <div class="p-8">
            <!-- Image Display -->
            <div v-if="localCurrentImage" class="flex justify-center items-center min-h-[60vh]">
              <img
                :src="`/${localCurrentImage.path}`"
                :alt="localCurrentImage.name"
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
          <div class="bg-white rounded-2xl px-8 py-4 shadow-lg border border-yellow-200">
            <div class="flex items-center space-x-6">
              <!-- Previous Button -->
              <button
                v-if="canGoPrevious"
                @click="goToPrevious"
                class="flex items-center justify-center w-10 h-10 bg-orange-600 hover:bg-orange-700 text-white rounded-full transition-all duration-200"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>

              <!-- Page Dots -->
              <div class="flex items-center space-x-2">
                <div
                  v-for="(image, index) in allImages"
                  :key="index"
                  class="w-3 h-3 rounded-full transition-all duration-200 cursor-pointer"
                  :class="index + 1 === localCurrentIndex ? 'bg-orange-600' : 'bg-yellow-300'"
                  @click="goToPage(index + 1)"
                ></div>
              </div>

              <!-- Next Button -->
              <button
                v-if="canGoNext"
                @click="goToNext"
                class="flex items-center justify-center w-10 h-10 bg-orange-600 hover:bg-orange-700 text-white rounded-full transition-all duration-200"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, watch } from 'vue'
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

// Local state for current page (starts with the initial page)
const localCurrentIndex = ref(props.currentIndex)
const localCurrentImage = ref(props.currentImage)

// Computed properties for navigation
const canGoPrevious = computed(() => localCurrentIndex.value > 1)
const canGoNext = computed(() => localCurrentIndex.value < props.totalImages)

// Navigation functions
const goToPrevious = (event) => {
  event?.preventDefault()
  if (canGoPrevious.value) {
    localCurrentIndex.value--
    localCurrentImage.value = props.allImages[localCurrentIndex.value - 1]
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

const goToNext = (event) => {
  event?.preventDefault()
  if (canGoNext.value) {
    localCurrentIndex.value++
    localCurrentImage.value = props.allImages[localCurrentIndex.value - 1]
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

const goToPage = (pageNumber, event) => {
  event?.preventDefault()
  if (pageNumber >= 1 && pageNumber <= props.totalImages) {
    localCurrentIndex.value = pageNumber
    localCurrentImage.value = props.allImages[pageNumber - 1]
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

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

// Keyboard navigation
const handleKeydown = (event) => {
  switch(event.key) {
    case 'ArrowLeft':
    case 'ArrowUp':
      event.preventDefault()
      goToPrevious(event)
      break
    case 'ArrowRight':
    case 'ArrowDown':
      event.preventDefault()
      goToNext(event)
      break
    case 'Home':
      event.preventDefault()
      goToPage(1, event)
      break
    case 'End':
      event.preventDefault()
      goToPage(props.totalImages, event)
      break
  }
}

onMounted(() => {
  if (localCurrentImage.value) {
    isLoading.value = true
    hasError.value = false
  }

  // Add keyboard event listener
  window.addEventListener('keydown', handleKeydown)

  // Prevent browser back/forward from changing the page
  window.addEventListener('popstate', (event) => {
    event.preventDefault()
    window.history.pushState(null, '', window.location.pathname)
  })

  // Ensure URL stays the same
  window.history.replaceState(null, '', window.location.pathname)
})

// Watch for any URL changes and prevent them
watch(() => window.location.pathname, (newPath) => {
  // If the path changes to something other than the original QR path, reset it
  if (!newPath.match(/^\/qrs\/\d+$/)) {
    window.history.replaceState(null, '', window.location.pathname)
  }
})

// Cleanup on unmount
onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown)
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
