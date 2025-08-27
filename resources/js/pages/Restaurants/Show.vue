<template>
  <div class="min-h-screen bg-gradient-to-br from-red-50 via-yellow-50 to-orange-50">
    <!-- Hero Section with Restaurant Cover -->
    <div class="relative h-96 bg-gradient-to-br from-red-600 via-orange-600 to-yellow-600 overflow-hidden">
      <!-- Restaurant Cover Image Background -->
      <div v-if="restaurant.cover_image_url" class="absolute inset-0">
        <img
          :src="restaurant.cover_image_url"
          :alt="restaurant.name + ' Cover'"
          class="w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-gradient-to-r from-red-700/90 to-orange-700/90"></div>
      </div>

      <!-- Background Pattern -->
      <div class="absolute inset-0">
        <div v-if="!restaurant.cover_image_url" class="absolute inset-0 bg-gradient-to-r from-red-700/90 to-orange-700/90"></div>
        <div class="absolute top-0 left-0 w-full h-full">
          <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
          <div class="absolute top-40 right-20 w-96 h-96 bg-yellow-500/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
          <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-red-400/15 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>
      </div>

      <!-- Enhanced Header -->
      <header class="relative z-10 bg-white/10 backdrop-blur-sm border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex items-center justify-between py-4">
            <div class="flex items-center space-x-6">
              <Link
                :href="route('restaurants.index')"
                class="group p-3 bg-white/20 backdrop-blur-sm rounded-xl hover:bg-white/30 transition-all duration-200 shadow-lg hover:shadow-xl"
              >
                <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
              </Link>
              <div class="text-white">
                <h1 class="text-2xl font-bold">{{ restaurant.name }}</h1>
                <p class="text-red-100">{{ restaurant.address }}</p>
              </div>
            </div>

            <Link
              :href="route('cart.index')"
              class="relative group inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm text-white rounded-xl font-semibold hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
              </svg>
              عرض السلة
              <span v-if="cartCount > 0" class="absolute -top-2 -right-2 bg-red-500 text-white text-sm rounded-full h-6 w-6 flex items-center justify-center font-bold shadow-lg">
                {{ cartCount }}
              </span>
            </Link>
          </div>
        </div>
      </header>

      <!-- Restaurant Hero Info -->
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row items-center lg:items-end space-y-8 lg:space-y-0 lg:space-x-12">
          <div class="relative">
            <img
              :src="restaurant.logo_url"
              :alt="restaurant.name"
              class="w-32 h-32 lg:w-40 lg:h-40 rounded-3xl object-cover border-8 border-white shadow-2xl"
            />
            <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg"></div>
          </div>

          <div class="flex-1 text-center lg:text-left text-white">
            <h2 class="text-4xl lg:text-5xl font-bold mb-4">{{ restaurant.name }}</h2>
            <p class="text-xl text-red-100 mb-8 max-w-3xl leading-relaxed">{{ restaurant.description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="flex items-center justify-center lg:justify-start space-x-3 p-4 bg-white/20 backdrop-blur-sm rounded-2xl shadow-lg">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                </div>
                <div>
                  <div class="text-2xl font-bold">{{ restaurant.rating }}</div>
                  <div class="text-sm text-red-100">تقييم العملاء</div>
                </div>
              </div>

              <div class="flex items-center justify-center lg:justify-start space-x-3 p-4 bg-white/20 backdrop-blur-sm rounded-2xl shadow-lg">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <div class="text-2xl font-bold">{{ restaurant.delivery_time }} دقيقة</div>
                  <div class="text-sm text-red-100">وقت التوصيل</div>
                </div>
              </div>

              <div class="flex items-center justify-center lg:justify-start space-x-3 p-4 bg-white/20 backdrop-blur-sm rounded-2xl shadow-lg">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <div class="text-2xl font-bold">{{ restaurant.delivery_fee }} ريال</div>
                  <div class="text-sm text-red-100">Delivery Fee</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="lg:grid lg:grid-cols-4 lg:gap-8">
        <!-- Restaurant Info Sidebar -->
        <div class="lg:col-span-1 mb-8 lg:mb-0">
          <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 p-8 sticky top-24">
            <div class="text-center mb-8">
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Restaurant Info</h3>
              <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
            </div>

            <!-- Restaurant Stats -->
            <div class="space-y-4 mb-8">
              <div class="p-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl border border-red-100">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="text-lg font-bold text-gray-900">{{ restaurant.rating }} / 5</div>
                    <div class="text-sm text-gray-600">Customer Rating</div>
                  </div>
                </div>
              </div>

              <div class="p-4 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl border border-yellow-100">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="text-lg font-bold text-gray-900">{{ restaurant.delivery_time }} min</div>
                    <div class="text-sm text-gray-600">Average Delivery</div>
                  </div>
                </div>
              </div>

              <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-100">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="text-lg font-bold text-gray-900">{{ restaurant.delivery_fee }} ريال</div>
                    <div class="text-sm text-gray-600">Delivery Fee</div>
                  </div>
                </div>
              </div>

              <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-100">
                <div class="flex items-center">
                  <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="text-lg font-bold text-gray-900">{{ restaurant.minimum_order }} ريال</div>
                    <div class="text-sm text-gray-600">Minimum Order</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Working Hours -->
            <div class="border-t border-gray-200 pt-6">
              <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                ساعات العمل
              </h4>
              <div class="space-y-3">
                <div v-if="restaurant.working_hours" v-for="(hours, day) in restaurant.working_hours" :key="day" class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                  <span class="text-sm font-medium text-gray-700 capitalize">{{ day }}</span>
                  <span class="text-sm text-gray-900 font-semibold">{{ hours }}</span>
                </div>
                <div v-else class="p-3 bg-gray-50 rounded-xl text-center">
                  <span class="text-sm text-gray-500">لا توجد معلومات عن ساعات العمل</span>
                </div>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="border-t border-gray-200 pt-6 mt-6">
              <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                معلومات الاتصال
              </h4>
              <div class="space-y-3">
                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                  <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="text-sm text-gray-700">{{ restaurant.address }}</span>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-xl">
                  <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                  <span class="text-sm text-gray-700">{{ restaurant.phone }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Menu Section -->
        <div class="lg:col-span-3">
          <!-- Menu Categories -->
          <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 p-8 mb-8">
            <h3 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
              <svg class="w-8 h-8 mr-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
              </svg>
              قائمة الطعام
            </h3>
            <div class="flex flex-wrap gap-4">
              <button
                v-for="category in categories"
                :key="category.id"
                @click="selectedCategory = category.id"
                :class="[
                  'px-6 py-4 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105',
                  selectedCategory === category.id
                    ? 'bg-gradient-to-r from-red-500 to-orange-500 text-white'
                    : 'bg-gradient-to-r from-red-50 to-orange-50 text-gray-700 hover:from-red-100 hover:to-orange-100'
                ]"
              >
                <span class="flex items-center">
                  <img v-if="category.image_url" :src="category.image_url" :alt="category.name" class="w-8 h-8 rounded-full mr-3 object-cover" />
                  <span class="text-lg">{{ category.name }}</span>
                  <span class="ml-3 bg-white/20 px-3 py-1 rounded-full text-sm font-bold">
                    {{ getCategoryProductCount(category.id) }}
                  </span>
                </span>
              </button>
            </div>
          </div>

          <!-- Products Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div
              v-for="product in filteredProducts"
              :key="product.id"
              class="group bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2"
            >
              <!-- Product Image -->
              <div class="relative h-72 bg-gradient-to-br from-red-100 to-orange-100 overflow-hidden">
                <img
                  :src="product.image_url"
                  :alt="product.name"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>

                <!-- Price Badge -->
                <div class="absolute top-4 right-4">
                  <div class="bg-gradient-to-r from-red-500 to-orange-500 text-white px-4 py-2 rounded-2xl font-bold shadow-2xl backdrop-blur-sm">
                    {{ product.formatted_price }}
                  </div>
                </div>

                <!-- Not Available Overlay -->
                <div v-if="!product.is_available" class="absolute inset-0 bg-black/50 flex items-center justify-center">
                  <div class="bg-red-500 text-white px-6 py-3 rounded-2xl font-bold text-lg">
                    غير متاح حالياً
                  </div>
                </div>

                <!-- Featured Badge -->
                <div v-if="product.is_featured" class="absolute top-4 left-4">
                  <div class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                    ⭐ مميز
                  </div>
                </div>
              </div>

              <!-- Product Info -->
              <div class="p-8">
                <div class="mb-6">
                  <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors duration-200">
                    {{ product.name }}
                  </h3>
                  <p class="text-gray-600 text-base leading-relaxed line-clamp-3">
                    {{ product.description }}
                  </p>
                </div>

                <!-- Category Badge -->
                <div class="mb-6">
                  <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-red-100 to-orange-100 text-red-700">
                    <img v-if="product.category?.image_url" :src="product.category.image_url" :alt="product.category.name" class="w-5 h-5 rounded-full mr-2 object-cover" />
                    {{ product.category?.name }}
                  </span>
                </div>

                <!-- Quantity Controls -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <button
                      @click="updateQuantity(product.id, getQuantity(product.id) - 1)"
                      :disabled="getQuantity(product.id) <= 0"
                      class="w-12 h-12 rounded-full bg-gradient-to-r from-red-100 to-orange-100 text-red-600 hover:from-red-200 hover:to-orange-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110"
                    >
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                      </svg>
                    </button>
                    <span class="w-16 text-center text-2xl font-bold text-gray-900">{{ getQuantity(product.id) }}</span>
                    <button
                      @click="updateQuantity(product.id, getQuantity(product.id) + 1)"
                      :disabled="!product.is_available"
                      class="w-12 h-12 rounded-full bg-gradient-to-r from-red-100 to-orange-100 text-red-600 hover:from-red-200 hover:to-orange-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-110"
                    >
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      </svg>
                    </button>
                  </div>

                  <button
                    @click="addToCart(product)"
                    :disabled="!product.is_available"
                    class="px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                  >
                    <span class="flex items-center">
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                      </svg>
                      إضافة للسلة
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="filteredProducts.length === 0" class="text-center py-20">
            <div class="max-w-md mx-auto">
              <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-red-100 to-orange-100 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
              </div>
              <h3 class="text-3xl font-bold text-gray-900 mb-4">لا توجد منتجات</h3>
              <p class="text-xl text-gray-600 mb-8">جرب اختيار فئة مختلفة أو عد لاحقاً لرؤية منتجات جديدة</p>
              <button
                @click="selectedCategory = null"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-red-500 to-orange-500 text-white rounded-2xl font-bold hover:from-red-600 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200 shadow-xl hover:shadow-2xl transform hover:scale-105"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                عرض جميع المنتجات
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  restaurant: Object,
  categories: Array,
  products: Array,
})

const selectedCategory = ref(null)
const cart = ref({})
const cartCount = ref(0)

const filteredProducts = computed(() => {
  if (!selectedCategory.value) {
    return props.products
  }
  return props.products.filter(product => product.category_id === selectedCategory.value)
})

const getCategoryProductCount = (categoryId) => {
  return props.products.filter(product => product.category_id === categoryId).length
}

const getQuantity = (productId) => {
  return cart.value[productId] || 0
}

const updateQuantity = (productId, quantity) => {
  if (quantity < 0) return

  if (quantity === 0) {
    delete cart.value[productId]
  } else {
    cart.value[productId] = quantity
  }

  updateCartCount()
  localStorage.setItem('cart', JSON.stringify(cart.value))
}

const addToCart = (product) => {
  const currentQuantity = cart.value[product.id] || 0
  updateQuantity(product.id, currentQuantity + 1)

  // Send to server
  router.post(route('cart.add'), {
    product_id: product.id,
    quantity: 1
  })
}

const updateCartCount = () => {
  cartCount.value = Object.values(cart.value).reduce((sum, quantity) => sum + quantity, 0)
}

onMounted(() => {
  // Load cart from localStorage
  const savedCart = JSON.parse(localStorage.getItem('cart') || '{}')
  cart.value = savedCart
  updateCartCount()
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
</style>
