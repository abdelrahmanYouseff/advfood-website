<template>
  <div class="min-h-screen bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-50" dir="rtl">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Loading Screen -->
    <div v-if="isLoading" class="min-h-screen flex items-center justify-center">
      <div class="text-center">
        <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-orange-600 mx-auto mb-4"></div>
        <p class="text-orange-700 text-lg font-semibold">جاري تحميل الكتاب...</p>
        <p class="text-orange-500 text-sm mt-2">يرجى الانتظار...</p>
      </div>
    </div>

    <!-- Error Screen -->
    <div v-if="!isLoading && !pdfDocument" class="min-h-screen flex items-center justify-center">
      <div class="text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 19.5c-.77.833.192 2.5 1.732 2.5z"></path>
          </svg>
        </div>
        <p class="text-red-700 text-lg font-semibold">خطأ في تحميل الكتاب</p>
        <p class="text-red-500 text-sm mt-2">تأكد من أن ملف PDF موجود</p>
        <button @click="loadPDF" class="mt-4 px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
          إعادة المحاولة
        </button>
      </div>
    </div>

    <!-- Main Content -->
    <div v-else-if="pdfDocument" class="py-8">
      <div class="max-w-6xl mx-auto px-4">
        <!-- Book Title -->
        <div class="text-center mb-8">
          <h1 class="text-3xl font-bold text-orange-800 mb-2" style="font-family: 'Playfair Display', serif;">
            {{ pdfName }}
          </h1>
          <div class="w-24 h-1 bg-orange-600 mx-auto rounded-full"></div>
        </div>

        <!-- Main Book Panel -->
        <div class="relative rounded-3xl shadow-2xl overflow-hidden" style="background-color: #662b37;">
          <!-- Book Content -->
          <div class="p-8">
            <!-- PDF Page Display -->
            <div v-if="currentPage" class="flex justify-center items-center min-h-[70vh]">
              <div class="relative">
                <canvas
                  ref="pdfCanvas"
                  class="max-w-full max-h-[75vh] object-contain rounded-2xl shadow-2xl bg-white"
                  :class="{ 'flip-animation': isFlipping }"
                ></canvas>

                <!-- Page Loading Overlay -->
                <div v-if="pageLoading" class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-75 rounded-2xl">
                  <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-orange-600"></div>
                </div>
              </div>
            </div>

            <!-- No Page -->
            <div v-else class="flex justify-center items-center min-h-[70vh]">
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
                class="flex items-center justify-center w-12 h-12 bg-orange-600 hover:bg-orange-700 text-white rounded-full transition-all duration-200 shadow-lg"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </button>

              <!-- Page Info -->
              <div class="text-center">
                <div class="text-orange-700 font-semibold text-lg">
                  صفحة {{ currentPageNumber }} من {{ totalPages }}
                </div>
                <div class="text-orange-500 text-sm">
                  {{ Math.round((currentPageNumber / totalPages) * 100) }}%
                </div>
              </div>

              <!-- Next Button -->
              <button
                v-if="canGoNext"
                @click="goToNext"
                class="flex items-center justify-center w-12 h-12 bg-orange-600 hover:bg-orange-700 text-white rounded-full transition-all duration-200 shadow-lg"
              >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Page Dots -->
        <div class="flex justify-center mt-4">
          <div class="flex items-center space-x-2">
            <div
              v-for="pageNum in Math.min(totalPages, 20)"
              :key="pageNum"
              class="w-3 h-3 rounded-full transition-all duration-200 cursor-pointer"
              :class="pageNum === currentPageNumber ? 'bg-orange-600' : 'bg-yellow-300'"
              @click="goToPage(pageNum)"
            ></div>
            <span v-if="totalPages > 20" class="text-orange-600 text-sm ml-2">...</span>
          </div>
        </div>

        <!-- Zoom Controls -->
        <div class="flex justify-center mt-4">
          <div class="bg-white rounded-xl px-4 py-2 shadow-lg border border-yellow-200">
            <div class="flex items-center space-x-4">
              <button
                @click="zoomOut"
                class="w-8 h-8 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full flex items-center justify-center transition-all duration-200"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
              </button>

              <span class="text-orange-700 font-medium">{{ Math.round(scale * 100) }}%</span>

              <button
                @click="zoomIn"
                class="w-8 h-8 bg-orange-100 hover:bg-orange-200 text-orange-700 rounded-full flex items-center justify-center transition-all duration-200"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
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
import * as pdfjsLib from 'pdfjs-dist'

// Configure PDF.js worker
pdfjsLib.GlobalWorkerOptions.workerSrc = '/js/pdfjs/pdf.worker.min.js'

const props = defineProps({
  pdfPath: String,
  pdfName: String
})

// Reactive state
const isLoading = ref(true)
const pageLoading = ref(false)
const isFlipping = ref(false)
const pdfDocument = ref(null)
const currentPageNumber = ref(1)
const totalPages = ref(0)
const scale = ref(1.0)
const pdfCanvas = ref(null)

// Computed properties
const canGoPrevious = computed(() => currentPageNumber.value > 1)
const canGoNext = computed(() => currentPageNumber.value < totalPages.value)
const currentPage = computed(() => currentPageNumber.value)

// Initialize PDF
const loadPDF = async () => {
  try {
    isLoading.value = true
    const pdfUrl = `/${props.pdfPath}`
    const encodedPdfUrl = encodeURI(pdfUrl)
    console.log('Loading PDF from:', pdfUrl)
    console.log('Encoded PDF URL:', encodedPdfUrl)

    // Test if the PDF URL is accessible
    try {
      const response = await fetch(encodedPdfUrl, { method: 'HEAD' })
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`)
      }
      console.log('PDF URL is accessible')
    } catch (fetchError) {
      console.error('PDF URL not accessible:', fetchError)
      throw new Error('Cannot access PDF file. Please check if the file exists.')
    }

    const loadingTask = pdfjsLib.getDocument({
      url: encodedPdfUrl,
      cMapUrl: `https://cdnjs.cloudflare.com/ajax/libs/pdf.js/${pdfjsLib.version}/cmaps/`,
      cMapPacked: true,
      verbosity: 1, // Enable logging
    })

    pdfDocument.value = await loadingTask.promise
    totalPages.value = pdfDocument.value.numPages
    console.log('PDF loaded successfully. Total pages:', totalPages.value)

    // Load first page
    await renderPage(1)
    isLoading.value = false
  } catch (error) {
    console.error('Error loading PDF:', error)
    isLoading.value = false
    alert(`خطأ في تحميل ملف PDF: ${error.message}`)
  }
}

// Render specific page
const renderPage = async (pageNum) => {
  if (!pdfDocument.value) return

  try {
    pageLoading.value = true
    console.log('Rendering page:', pageNum)

    const page = await pdfDocument.value.getPage(pageNum)
    const canvas = pdfCanvas.value

    if (!canvas) {
      console.error('Canvas element not found')
      pageLoading.value = false
      return
    }

    const context = canvas.getContext('2d')
    const viewport = page.getViewport({ scale: scale.value })

    // Set canvas dimensions
    canvas.height = viewport.height
    canvas.width = viewport.width

    // Clear canvas
    context.clearRect(0, 0, canvas.width, canvas.height)

    const renderContext = {
      canvasContext: context,
      viewport: viewport
    }

    await page.render(renderContext).promise
    console.log('Page rendered successfully:', pageNum)
    pageLoading.value = false
  } catch (error) {
    console.error('Error rendering page:', error)
    pageLoading.value = false
  }
}

// Navigation functions
const goToPrevious = (event) => {
  event?.preventDefault()
  if (canGoPrevious.value) {
    currentPageNumber.value--
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

const goToNext = (event) => {
  event?.preventDefault()
  if (canGoNext.value) {
    currentPageNumber.value++
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

const goToPage = (pageNumber, event) => {
  event?.preventDefault()
  if (pageNumber >= 1 && pageNumber <= totalPages.value) {
    currentPageNumber.value = pageNumber
    triggerFlipEffect()
    // Prevent URL change
    window.history.replaceState(null, '', window.location.pathname)
  }
}

// Zoom functions
const zoomIn = () => {
  if (scale.value < 3.0) {
    scale.value += 0.25
    renderPage(currentPageNumber.value)
  }
}

const zoomOut = () => {
  if (scale.value > 0.5) {
    scale.value -= 0.25
    renderPage(currentPageNumber.value)
  }
}

// Animation
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
      goToPage(totalPages.value, event)
      break
    case '+':
    case '=':
      event.preventDefault()
      zoomIn()
      break
    case '-':
      event.preventDefault()
      zoomOut()
      break
  }
}

// Watch for page changes
watch(currentPageNumber, (newPage) => {
  renderPage(newPage)
})

// Watch for scale changes
watch(scale, () => {
  renderPage(currentPageNumber.value)
})

onMounted(() => {
  loadPDF()

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

.flip-animation {
  animation: flip 0.8s ease-in-out;
}

/* Smooth transitions */
* {
  transition: all 0.3s ease;
}

/* Canvas styling */
canvas {
  border: 2px solid #f59e0b;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* Button hover effects */
button:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Loading animation */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}
</style>
