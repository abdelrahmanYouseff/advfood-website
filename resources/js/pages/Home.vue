<template>
  <div class="min-h-screen bg-background" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header
      ref="header"
      class="fixed top-0 left-0 right-0 z-50 w-full transition-transform duration-300"
      :class="{ '-translate-y-full': isHeaderHidden }"
      style="background-color: #cf4823; backdrop-filter: blur(10px);"
    >
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-48" :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'">
          <!-- Logo -->
          <div class="flex items-center">
            <div class="w-48 h-48 flex items-center justify-center">
              <img src="/logo-white.png" alt="ADVFood Logo" class="w-48 h-48 object-contain">
            </div>
          </div>

          <!-- Desktop Navigation -->
          <nav class="hidden md:flex items-center gap-6">
            <Link
              href="/"
              class="flex-shrink-0 text-white hover:text-gray-200 px-4 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md whitespace-nowrap"
              style="min-height: 40px; display: flex; align-items: center; justify-content: center;"
            >
              {{ $t('Home') }}
            </Link>
            <a
              href="#about-us"
              class="flex-shrink-0 text-white hover:text-gray-200 px-4 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md whitespace-nowrap"
              style="min-height: 40px; display: flex; align-items: center; justify-content: center;"
            >
              {{ $t('About Us') }}
            </a>
            <a
              href="#contact-us"
              class="flex-shrink-0 text-white hover:text-gray-200 px-4 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md whitespace-nowrap"
              style="min-height: 40px; display: flex; align-items: center; justify-content: center;"
            >
              {{ $t('Contact Us') }}
            </a>
          </nav>

          <!-- Desktop Action Buttons -->
          <div class="hidden md:flex items-center space-x-3 space-x-reverse">
            <!-- Language Switcher -->
            <div class="relative">
              <button
                @click="toggleLanguageDropdown"
                class="flex items-center gap-2 px-3 py-2 text-sm border border-white/30 rounded-md hover:bg-white/20 transition-colors text-white"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
                <span class="text-sm">{{ getCurrentLanguage().flag }}</span>
                <span class="hidden lg:inline">{{ getCurrentLanguage().name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <!-- Language Dropdown -->
              <div
                v-if="isLanguageDropdownOpen"
                class="absolute mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                :class="currentLanguage === 'ar' ? 'right-0' : 'left-0'"
              >
                <div class="py-1">
                  <button
                    v-for="language in languages"
                    :key="language.code"
                    @click="handleLanguageChange(language.code)"
                    class="flex items-center justify-between w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer"
                  >
                    <div class="flex items-center gap-2" :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'">
                      <span>{{ language.flag }}</span>
                      <span>{{ language.name }}</span>
                    </div>
                    <svg
                      v-if="currentLanguage === language.code"
                      class="w-4 h-4 text-green-600"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

          </div>

          <!-- Mobile menu button -->
          <button
            @click="toggleMobileMenu"
            class="md:hidden p-2 text-white hover:text-gray-200 hover:bg-white/20 rounded-md transition-colors"
          >
            <svg v-if="!isMobileMenuOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div
        v-if="isMobileMenuOpen"
        class="md:hidden shadow-lg" style="background-color: #cf4823; border-top: 1px solid rgba(255,255,255,0.2);"
      >
        <div class="px-4 py-6">
          <!-- Mobile Logo -->
          <div class="flex items-center space-x-2 mb-8">
            <div class="w-40 h-40 flex items-center justify-center">
              <img src="/logo-white.png" alt="ADVFood Logo" class="w-40 h-40 object-contain">
            </div>
            <div class="flex flex-col">
              <span class="text-xs text-white -mt-1">اكتشف الطعام الرائع</span>
            </div>
          </div>

          <!-- Mobile Navigation -->
          <nav class="flex flex-col space-y-4">
            <Link
              href="/"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('Home') }}
            </Link>
            <a
              href="#about-us"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('About Us') }}
            </a>
            <a
              href="#contact-us"
              class="text-right text-white hover:text-gray-200 px-3 py-2 text-base font-medium transition-colors duration-200 hover:bg-white/20 rounded-md flex items-center gap-3"
            >
              {{ $t('Contact Us') }}
            </a>

            <div class="pt-6 border-t border-gray-200 space-y-3">
              <!-- Language Switcher Mobile -->
              <div class="mb-4">
                <p class="text-sm font-medium text-white mb-2">اللغة / Language</p>
                <div class="grid grid-cols-2 gap-2">
                  <button
                    v-for="language in languages"
                    :key="language.code"
                    @click="handleLanguageChange(language.code)"
                    :class="[
                      'flex items-center gap-2 p-2 rounded-md border transition-colors',
                      currentLanguage === language.code
                        ? 'bg-white/20 border-white/30 text-white'
                        : 'border-white/30 hover:bg-white/10 text-white'
                    ]"
                  >
                    <span>{{ language.flag }}</span>
                    <span class="text-sm">{{ language.name }}</span>
                    <svg
                      v-if="currentLanguage === language.code"
                      class="w-3 h-3 text-green-600 mr-auto"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </div>
              </div>

            </div>
          </nav>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 pt-48">
      <!-- Hero Section -->
      <div class="text-white py-20" style="background-color: #cf4823;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
          <h1 class="text-5xl font-bold mb-6 bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">
            {{ $t('Discover Delicious Restaurants') }}
          </h1>
          <p class="text-xl text-white max-w-3xl mx-auto">
            {{ $t('Experience the finest culinary delights delivered right to your doorstep.') }}
          </p>
        </div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Title Section -->
        <div class="mb-8">
          <h2 class="text-3xl font-bold text-gray-900 text-center">
            {{ $t('Discover Delicious Restaurants') }}
          </h2>
        </div>


        <!-- Restaurant Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <div
            v-for="restaurant in filteredRestaurants"
            :key="restaurant.id"
            class="group overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-white rounded-lg shadow-md flex flex-col"
          >
            <div class="relative h-64 overflow-hidden bg-white">
              <img
                :src="restaurant.cover_image_url || restaurant.logo_url || '/images/default-restaurant-cover.png'"
                :alt="restaurant.name"
                class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                @error="handleImageError"
              />
            </div>

            <div class="p-6 flex flex-col h-full">
              <div class="flex items-start justify-between mb-3">
                <div>
                </div>
              </div>

              <!-- Social Media Icons -->
              <div class="flex justify-center items-center gap-4 mt-4 flex-grow">
                <!-- Facebook -->
                <a
                  :href="getSocialLink(restaurant.name, 'facebook')"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                  aria-label="Facebook"
                  style="min-width: 40px; min-height: 40px; max-width: 40px; max-height: 40px;"
                >
                  <svg class="w-5 h-5 text-gray-600 hover:text-white" fill="currentColor" viewBox="0 0 24 24" style="min-width: 20px; min-height: 20px; max-width: 20px; max-height: 20px;">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                </a>

                <!-- Twitter -->
                <a
                  :href="getSocialLink(restaurant.name, 'twitter')"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                  aria-label="Twitter"
                  style="min-width: 40px; min-height: 40px; max-width: 40px; max-height: 40px;"
                >
                  <svg class="w-5 h-5 text-gray-600 hover:text-white" fill="currentColor" viewBox="0 0 24 24" style="min-width: 20px; min-height: 20px; max-width: 20px; max-height: 20px;">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                  </svg>
                </a>

                <!-- Instagram -->
                <a
                  :href="getSocialLink(restaurant.name, 'instagram')"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                  aria-label="Instagram"
                  style="min-width: 40px; min-height: 40px; max-width: 40px; max-height: 40px;"
                >
                  <svg class="w-5 h-5 text-gray-600 hover:text-white" fill="currentColor" viewBox="0 0 24 24" style="min-width: 20px; min-height: 20px; max-width: 20px; max-height: 20px;">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.919-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                  </svg>
                </a>

                <!-- TikTok -->
                <a
                  :href="getSocialLink(restaurant.name, 'tiktok')"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-600 transition-all duration-300 transform hover:scale-110"
                  aria-label="TikTok"
                  style="min-width: 40px; min-height: 40px; max-width: 40px; max-height: 40px;"
                >
                  <svg class="w-5 h-5 text-gray-600 hover:text-white" fill="currentColor" viewBox="0 0 24 24" style="min-width: 20px; min-height: 20px; max-width: 20px; max-height: 20px;">
                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-.88-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                  </svg>
                </a>
              </div>

    <!-- Additional Icons - Hide for Gather Us -->
    <div v-if="restaurant.name !== 'Gather Us'" class="flex justify-center gap-3 mt-3">
      <!-- Hunger Icon -->
      <a
        :href="getSocialLink(restaurant.name, 'hunger')"
        target="_blank"
        rel="noopener noreferrer"
        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-600 transition-all duration-300 transform hover:scale-110"
        aria-label="HungerStation"
      >
        <img
          src="/icons/hunger.png"
          alt="Hunger Icon"
          class="w-6 h-6 object-contain"
          @error="handleImageError"
        />
      </a>

      <!-- Chef Icon - Link for Delawa only -->
      <a
        v-if="restaurant.name === 'Delawa'"
        :href="getSocialLink(restaurant.name, 'chefz')"
        target="_blank"
        rel="noopener noreferrer"
        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-600 transition-all duration-300 transform hover:scale-110"
        aria-label="The Chefz"
      >
        <img
          src="/icons/the-chefz.webp"
          alt="Chef Icon"
          class="w-6 h-6 object-contain"
          @error="handleImageError"
        />
      </a>
      <!-- Chef Icon - Non-clickable for other restaurants -->
      <div
        v-else
        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-600 transition-all duration-300 transform hover:scale-110"
      >
        <img
          src="/icons/the-chefz.webp"
          alt="Chef Icon"
          class="w-6 h-6 object-contain"
          @error="handleImageError"
        />
      </div>

      <!-- Jahez Icon - Only for Tant Bakiza and Delawa -->
      <a
        v-if="restaurant.name === 'Tant Bakiza' || restaurant.name === 'Delawa'"
        :href="getSocialLink(restaurant.name, 'jahez')"
        target="_blank"
        rel="noopener noreferrer"
        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gradient-to-r hover:from-purple-500 hover:to-pink-600 transition-all duration-300 transform hover:scale-110"
        aria-label="Jahez"
      >
        <img
          src="/icons/jahez.png"
          alt="Jahez Icon"
          class="w-6 h-6 object-contain"
          @error="handleImageError"
        />
      </a>

      <!-- Noon Icon - Only for Tant Bakiza -->
      <a
        v-if="restaurant.name === 'Tant Bakiza'"
        :href="getSocialLink(restaurant.name, 'noon')"
        target="_blank"
        rel="noopener noreferrer"
        class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center hover:bg-gradient-to-r hover:from-orange-500 hover:to-red-600 transition-all duration-300 transform hover:scale-110"
        aria-label="Noon"
      >
        <img
          src="/icons/noon.png"
          alt="Noon Icon"
          class="w-6 h-6 object-contain"
          @error="handleImageError"
        />
      </a>
    </div>

              <!-- Explore Menu Button -->
              <div class="mt-auto pt-6">
                <button
                  @click="viewMenu(restaurant.id)"
                  class="w-full bg-gradient-to-r from-gray-800 to-black hover:from-gray-700 hover:to-gray-900 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                >
                  {{ $t('Explore Menu') }}
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- No Results -->
        <div v-if="filteredRestaurants.length === 0" class="py-16" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
          <div class="text-gray-400 mb-4">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ $t('No Restaurants Found') }}</h3>
          <p class="text-gray-500">{{ $t('Try searching with different keywords or adjust your filters') }}</p>
          <button
            @click="clearFilters"
            class="mt-4 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
          >
            {{ $t('Clear Filters') }}
          </button>
        </div>
      </div>

      <!-- About Us Section -->
      <section class="py-20 bg-gradient-to-br from-gray-50 to-white">
        <!-- Section Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
          <div class="text-center">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">
              {{ $t('About Us') }}
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
              {{ $t('Learn more about our journey and values.') }}
            </p>
            <!-- Decorative line -->
            <div class="flex justify-center mt-8">
              <div class="h-1 w-20 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"></div>
            </div>
          </div>
        </div>

        <!-- Our Story Subsection -->
        <div id="about-us" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch min-h-[500px] rounded-2xl overflow-hidden shadow-2xl">
            <!-- Text Section with Red Background -->
            <div class="p-12 flex flex-col justify-center" style="background-color: #cf4823;" dir="rtl">
              <div class="text-white" style="text-align: right; direction: rtl;">
                <h2 class="text-4xl font-bold text-white mb-8">قصتنا</h2>
                <div class="space-y-4 text-lg leading-relaxed" style="text-align: right; direction: rtl;">
                  <p>
                    بدأت حكايتنا بشغف واحد يجمع بين الطعم الأصيل والجودة العالية.
                  </p>
                  <p>
                    انطلقت بكيزة لتقدّم نكهة الحلويات المصرية الأصيلة بلمسة حديثة تحافظ على تراثنا العريق. ثم وُلدت ديلاوة لتكمل المسيرة، وتقدّم تشكيلة متنوعة من الحلويات الشرقية والعالمية بطابع أنيق ومذاق استثنائي.
                  </p>
                  <p>
                    ومع حبنا للتنوع والابتكار، جاءت Gather Us لتجمعنا حول المخبوزات الطازجة والروائح التي تعيد الذكريات الجميلة كل صباح.
                  </p>
                  <p>
                    من خلال هذه العلامات الثلاث، نسعى لتقديم تجربة طعام تجمع بين الأصالة والإبداع، وتعبّر عن شغفنا بصناعة النكهات التي تبقى في الذاكرة.
                  </p>
                </div>
              </div>
            </div>

            <!-- Image Section -->
            <div class="relative">
              <div class="h-full">
                <img
                  src="/brands.png"
                  alt="Our Story"
                  class="w-full h-full object-cover"
                  @error="handleImageError"
                />
                <!-- Vintage frame effect -->
                <div class="absolute inset-0 border-4 border-amber-200 opacity-30"></div>
                <!-- Sepia overlay -->
                <div class="absolute inset-0 bg-amber-900 opacity-20"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Our Mission Subsection -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
          <div class="text-center mb-12">
            <h3 class="text-4xl font-bold text-gray-900 mb-6">{{ $t('Our Mission') }}</h3>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
              {{ $t('To revolutionize the way people discover, order, and enjoy food by connecting them with the best restaurants and culinary experiences.') }}
            </p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Fast Delivery') }}</h3>
              <p class="text-gray-600">{{ $t('Quick and reliable delivery service to bring your favorite meals to you in no time.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Quality Assurance') }}</h3>
              <p class="text-gray-600">{{ $t('We ensure every meal meets our high standards of quality and freshness.') }}</p>
            </div>

            <div class="text-center p-6 bg-white rounded-2xl shadow-lg">
              <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
              </div>
              <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $t('Customer Love') }}</h3>
              <p class="text-gray-600">{{ $t('Your satisfaction is our priority, and we work hard to exceed your expectations.') }}</p>
            </div>
          </div>
        </div>

        <!-- Contact Us Section -->
        <div id="contact-us" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
          <div class="text-center mb-12">
            <h3 class="text-4xl font-bold text-gray-900 mb-6">{{ $t('Contact Us') }}</h3>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
              {{ $t('Get in touch with us for any questions or feedback.') }}
            </p>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Contact Info -->
            <div class="space-y-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
              <!-- Phone -->
              <div class="flex items-start gap-6 group">
                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $t('Phone') }}</h4>
                  <a href="tel:+966507844079" class="text-lg text-gray-600 hover:text-blue-600 transition-colors block" dir="ltr">+966 50 784 4079</a>
                </div>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-6 group">
                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $t('Email') }}</h4>
                  <a href="mailto:info@adv-line.sa" class="text-lg text-gray-600 hover:text-green-600 transition-colors block">info@adv-line.sa</a>
                </div>
              </div>

              <!-- Address -->
              <div class="flex items-start gap-6 group">
                <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $t('Address') }}</h4>
                  <p class="text-lg text-gray-600">QM4G+F35, King Abdulaziz Rd, Al Muruj, Riyadh 12465, Saudi Arabia</p>
                </div>
              </div>

            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
              <h4 class="text-2xl font-bold text-gray-900 mb-6 text-center">{{ $t('Send Message') }}</h4>
              <form class="space-y-6">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('Name') }}</label>
                  <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="أدخل اسمك الكامل">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('Email') }}</label>
                  <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="أدخل بريدك الإلكتروني">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">{{ $t('Message') }}</label>
                  <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors" placeholder="اكتب رسالتك هنا..."></textarea>
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-medium py-3 px-6 rounded-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                  {{ $t('Send Message') }}
                </button>
              </form>
            </div>
          </div>
        </div>

      </section>

      <!-- Recent Products Section - Hidden -->
      <section class="py-16 bg-gray-50 hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Section Title -->
          <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
              {{ $t('Recently Added Products') }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
              {{ $t('Discover our latest additions to the menu, carefully crafted for your enjoyment') }}
            </p>
          </div>

          <!-- Products Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
            <div
              v-for="product in recentProducts"
              :key="product.id"
              class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden"
            >
              <!-- Product Image -->
              <div class="relative h-48 overflow-hidden bg-white">
                <img
                  :src="product.image_url"
                  :alt="product.name"
                  class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300"
                  @error="handleProductImageError"
                />
                <div class="absolute top-4 right-4">
                  <span class="bg-white/90 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ product.formatted_price }}
                  </span>
                </div>
                <div class="absolute top-4 left-4">
                  <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                    {{ $t('New') }}
                  </span>
                </div>
              </div>

              <!-- Product Info -->
              <div class="p-6">
                <div class="mb-3">
                  <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ product.name }}</h3>
                  <p class="text-gray-600 text-sm line-clamp-2">{{ product.description }}</p>
                </div>

                <div class="flex items-center justify-between mb-4">
                  <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <span>{{ product.restaurant?.name || 'مطعم غير محدد' }}</span>
                  </div>
                  <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span>{{ product.category?.name || 'فئة غير محددة' }}</span>
                  </div>
                </div>

                <div class="flex items-center justify-between">
                  <div class="text-2xl font-bold text-gray-900">
                    {{ product.formatted_price }}
                  </div>
                  <button
                    @click="viewProduct(product.id)"
                    class="bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                  >
                    {{ $t('View Details') }}
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- No Products State -->
          <div v-if="recentProducts.length === 0" class="text-center py-16">
            <div class="text-gray-400 mb-4">
              <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ $t('No Recent Products') }}</h3>
            <p class="text-gray-500">{{ $t('Check back later for new additions to our menu') }}</p>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-12">

          <!-- Logo & About Section -->
          <div class="space-y-6" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
            <div class="flex justify-end" :class="currentLanguage === 'ar' ? 'justify-start' : 'justify-end'">
              <img src="/logo-white.png" alt="ADVFood Logo" class="h-40 w-40 object-contain">
            </div>
            <p class="text-gray-300 leading-relaxed">
              {{ $t('From local favorites to international cuisine, we bring the world\'s flavors to you.') }}
            </p>
            <!-- Decorative Line -->
            <div class="flex items-center gap-2">
              <div class="h-1 w-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full"></div>
              <div class="h-1 w-8 bg-gradient-to-r from-orange-400 to-red-400 rounded-full"></div>
              <div class="h-1 w-4 bg-gradient-to-r from-orange-300 to-red-300 rounded-full"></div>
            </div>
          </div>

          <!-- Contact Info Section -->
          <div class="space-y-6" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
            <h4 class="text-xl font-bold text-white relative inline-block">
              {{ $t('Contact Us') }}
              <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-orange-500 to-red-500"></span>
            </h4>
            <div class="space-y-4">
              <!-- Address -->
              <div class="flex items-start gap-4 group">
                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-bold text-white text-lg mb-1">{{ $t('Address') }}</div>
                  <div class="text-sm text-gray-300 leading-relaxed">QM4G+F35, King Abdulaziz Rd, Al Muruj, Riyadh 12465, Saudi Arabia</div>
                </div>
              </div>

              <!-- Phone -->
              <div class="flex items-start gap-4 group">
                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-bold text-white text-lg mb-1">{{ $t('Phone') }}</div>
                  <a href="tel:+966507844079" class="text-sm text-gray-300 hover:text-orange-400 transition-colors block" dir="ltr">+966 50 784 4079</a>
                </div>
              </div>

              <!-- Email -->
              <div class="flex items-start gap-4 group">
                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div class="flex-1">
                  <div class="font-bold text-white text-lg mb-1">{{ $t('Email') }}</div>
                  <a href="mailto:info@adv-line.sa" class="text-sm text-gray-300 hover:text-orange-400 transition-colors block">info@adv-line.sa</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Working Hours Section -->
          <div class="space-y-6" :class="currentLanguage === 'ar' ? 'text-right' : 'text-left'">
            <h4 class="text-xl font-bold text-white relative inline-block">
              {{ $t('Working Hours') }}
              <span class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-orange-500 to-red-500"></span>
            </h4>
            <div class="space-y-3">
              <div class="flex justify-between items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                <span class="text-gray-300">{{ $t('Sunday - Thursday') }}</span>
                <span class="text-white font-semibold">9:00 AM - 11:00 PM</span>
              </div>
              <div class="flex justify-between items-center p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                <span class="text-gray-300">{{ $t('Friday - Saturday') }}</span>
                <span class="text-white font-semibold">10:00 AM - 12:00 AM</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Divider with decoration -->
        <div class="relative my-8">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-700"></div>
          </div>
          <div class="relative flex justify-center">
            <div class="bg-gray-900 px-4">
              <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Bottom Section -->
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <!-- Copyright -->
          <div class="flex items-center space-x-2 space-x-reverse text-gray-400">
            <span>© {{ currentYear }} ADVFood. {{ $t('All rights reserved') }}.</span>
          </div>

          <!-- Made in Saudi Arabia -->
          <div class="flex items-center space-x-1 space-x-reverse text-gray-400">
            <span>صنع في ❤️ السعودية</span>
          </div>

          <!-- Quick Links -->
          <div class="flex space-x-6 space-x-reverse text-sm">
            <Link href="/privacy" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 relative group">
              {{ $t('Privacy') }}
              <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-400 group-hover:w-full transition-all duration-300"></span>
            </Link>
          </div>
        </div>
      </div>

      <!-- Animated gradient border at top -->
      <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-red-500 to-orange-500 animate-gradient"></div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import { Link } from '@inertiajs/vue3'

const { t, locale } = useI18n()

// Reactive state
const isMobileMenuOpen = ref(false)
const isLanguageDropdownOpen = ref(false)
const currentLanguage = ref('ar')
const isHeaderHidden = ref(false)
const lastScrollY = ref(0)

// Restaurant data
const searchTerm = ref('')
const cuisineFilter = ref('all')
const priceFilter = ref('all')

// Restaurant data from database
const restaurants = ref([])

// Recent products data
const recentProducts = ref([])

// Footer data
const currentYear = new Date().getFullYear()

// Social media links function
const getSocialLink = (restaurantName, platform) => {
  const socialLinks = {
    'Tant Bakiza': {
      facebook: 'https://www.facebook.com/profile.php?id=61573854809171',
      twitter: 'https://x.com/Tunt_Bakiza',
      instagram: 'https://www.instagram.com/tunt_bakiza/',
      tiktok: 'https://www.tiktok.com/@tunt_bakiza?is_from_webapp=1&sender_device=pc',
      hunger: 'https://hungerstation.com/sa-en/restaurant/kabsa/badr/badr/147152',
      jahez: 'https://jahez.app.link/ieLexrG96Tb?_p=c11c3fdc9c0b7af2eb0389f8',
      noon: 'https://food.noon.com/saudi-en/outlet/TNTBKZQVT0/'
    },
    'Delawa': {
      facebook: 'https://www.facebook.com/people/Delawa-%D8%AF%D9%8A%D9%84%D8%A7%D9%88%D8%A9/61576916633213/?locale=ar_AR',
      twitter: 'https://x.com/Delawa_sa',
      instagram: 'https://www.instagram.com/delawa_sa/',
      tiktok: 'https://www.tiktok.com/@delawa_sa',
      hunger: 'https://hungerstation.com/sa-en/restaurant/riyadh/king-abdulaziz-neighborhood/147049',
      jahez: 'https://jahez.app.link/mjyxSwRO2Ub?_p=c11c3fdc9c0b7af2eb0389f8',
      chefz: 'https://thechefzco.app.link/sXRjUP4PVTb'
    },
    'Gather Us': {
      facebook: 'https://www.facebook.com/profile.php?id=61580193684770',
      twitter: 'https://x.com/gatherussa',
      instagram: 'https://www.instagram.com/gatherussa/',
      tiktok: 'https://www.tiktok.com/@gatherussa',
      hunger: '#'
    }
  }

  return socialLinks[restaurantName]?.[platform] || '#'
}

const quickLinks = computed(() => [
  { name: t('About'), href: '#' },
  { name: t('Contact Us'), href: '#' },
  { name: t('Privacy'), href: '#' },
  { name: t('Terms'), href: '#' },
])


// Languages data
const languages = [
  { code: 'ar', name: 'العربية', flag: '🇸🇦' },
  { code: 'en', name: 'English', flag: '🇺🇸' },
]

// Translations
const translations = {
  ar: {
    home: 'الرئيسية',
    aboutUs: 'من نحن',
    cuisines: 'المطابخ',
    reviews: 'التقييمات',
    contact: 'اتصل بنا',
    signIn: 'تسجيل الدخول'
  },
  en: {
    home: 'Home',
    aboutUs: 'About Us',
    cuisines: 'Cuisines',
    reviews: 'Reviews',
    contact: 'Contact',
    signIn: 'Sign In'
  }
}

// Computed properties
const cuisines = computed(() => {
  // Since we don't have cuisine field in database, we'll use a default list
  return ['سعودي', 'عربي', 'إيطالي', 'ياباني', 'صيني', 'هندي', 'مكسيكي', 'فرنسي']
})

const priceRanges = computed(() => {
  // Generate price ranges based on minimum_order from database
  const ranges = restaurants.value.map(r => {
    if (r.minimum_order <= 50) return 'اقتصادي'
    if (r.minimum_order <= 100) return 'متوسط'
    return 'فاخر'
  })
  return [...new Set(ranges)]
})

const filteredRestaurants = computed(() => {
  return restaurants.value.filter(restaurant => {
    const matchesSearch = restaurant.name.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
                         restaurant.description.toLowerCase().includes(searchTerm.value.toLowerCase())

    // For now, we'll skip cuisine and price filtering since the database structure is different
    // You can add these filters later when you have the appropriate fields
    return matchesSearch
  })
})

// Navigation items
const navigationItems = computed(() => [
  { name: translations[currentLanguage.value].home, href: '#', icon: 'ChefHat' },
  { name: translations[currentLanguage.value].aboutUs, href: '#' },
  { name: translations[currentLanguage.value].cuisines, href: '#' },
  { name: translations[currentLanguage.value].reviews, href: '#' },
  { name: translations[currentLanguage.value].contact, href: '#', icon: 'Phone' },
])

// Methods
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value
}

const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value
}

const handleNavClick = (itemName) => {
  if (itemName === t('Home')) {
    window.location.href = '/'
  } else if (itemName === t('About')) {
    window.location.href = '/about'
  } else if (itemName === t('Contact')) {
    // Handle contact action
    console.log('Contact clicked')
  } else if (itemName === t('Restaurants')) {
    // Handle restaurants action
    console.log('Restaurants clicked')
  }
  isMobileMenuOpen.value = false
}

const handleLanguageChange = (languageCode) => {
  currentLanguage.value = languageCode
  locale.value = languageCode
  isLanguageDropdownOpen.value = false
}

// Watch for language changes and update i18n locale
watch(currentLanguage, (newLang) => {
  locale.value = newLang
})

const getCurrentLanguage = () => {
  return languages.find(lang => lang.code === currentLanguage.value) || languages[0]
}

const viewMenu = (restaurantId) => {
  console.log('View menu for restaurant:', restaurantId)
  // Navigate to restaurant menu page
  window.location.href = `/restaurants/${restaurantId}`
}

const clearFilters = () => {
  searchTerm.value = ''
  cuisineFilter.value = 'all'
  priceFilter.value = 'all'
}

const handleImageError = (event) => {
  event.target.src = '/images/default-restaurant-cover.png'
}

const handleProductImageError = (event) => {
  event.target.src = '/images/default-product.png'
}

const viewProduct = (productId) => {
  console.log('View product:', productId)
  // Navigate to product details or restaurant menu
  // For now, we'll navigate to the restaurant that has this product
  const product = recentProducts.value.find(p => p.id === productId)
  if (product && product.restaurant) {
    window.location.href = `/restaurants/${product.restaurant.id}`
  }
}

// Fetch restaurants from database
const fetchRestaurants = async () => {
  try {
    const response = await fetch('/api/restaurants')
    const data = await response.json()
    console.log('Fetched restaurants:', data.restaurants)
    restaurants.value = data.restaurants || []
    console.log('Restaurants count:', restaurants.value.length)
  } catch (error) {
    console.error('Error fetching restaurants:', error)
    restaurants.value = []
  }
}

// Fetch recent products from database
const fetchRecentProducts = async () => {
  try {
    const response = await fetch('/api/products/recent')
    const data = await response.json()
    recentProducts.value = data.products || []
  } catch (error) {
    console.error('Error fetching recent products:', error)
    recentProducts.value = []
  }
}

// Helper functions

const getWorkingHours = (workingHours) => {
  if (!workingHours || typeof workingHours !== 'object') {
    return 'ساعات العمل غير متوفرة'
  }

  // If it's an object with day-specific hours, show a general message
  if (workingHours.monday || workingHours.tuesday) {
    return 'مفتوح اليوم'
  }

  return 'ساعات العمل غير متوفرة'
}

// Fetch restaurants and products on component mount
fetchRestaurants()
fetchRecentProducts()

// Close dropdowns when clicking outside
const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    isLanguageDropdownOpen.value = false
  }
}

// Add event listener for outside clicks
if (typeof window !== 'undefined') {
  document.addEventListener('click', handleClickOutside)
}

// Header scroll behavior
const handleScroll = () => {
  const currentScrollY = window.scrollY

  // Only show header when at the very top of the page (scrollY = 0)
  if (currentScrollY === 0) {
    isHeaderHidden.value = false
  } else {
    // Hide header for any other scroll position
    isHeaderHidden.value = true
  }

  lastScrollY.value = currentScrollY
}

// Add scroll event listener
if (typeof window !== 'undefined') {
  window.addEventListener('scroll', handleScroll)
}
</script>
