<template>
  <div class="min-h-screen bg-gray-50" :dir="currentLanguage === 'ar' ? 'rtl' : 'ltr'">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex items-center">
            <Link href="/" class="flex items-center">
              <img src="/Foods Logo.png" :alt="$t('Company Name')" class="h-10 w-auto">
            </Link>
          </div>

          <div class="flex items-center gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
            <!-- Language Switcher -->
            <div class="relative">
              <button
                @click="toggleLanguageDropdown"
                class="flex items-center gap-2 px-3 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-gray-700"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                </svg>
                <span class="text-sm">{{ getCurrentLanguage.flag }}</span>
                <span class="hidden sm:inline">{{ getCurrentLanguage.name }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <div
                v-if="isLanguageDropdownOpen"
                class="absolute mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                :class="currentLanguage === 'ar' ? 'right-0' : 'left-0'"
              >
                <div class="py-1">
                  <button
                    v-for="language in languages"
                    :key="language.code"
                    @click="handleLanguageChange(language.code)"
                    class="flex items-center gap-2 w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    :class="currentLanguage === 'ar' ? 'flex-row' : 'flex-row-reverse'"
                  >
                    <span>{{ language.flag }}</span>
                    <span>{{ language.name }}</span>
                    <svg v-if="currentLanguage === language.code" class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Back to Home -->
            <Link
              href="/"
              class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
            >
              {{ $t('Back to Home') }}
            </Link>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="bg-white rounded-lg shadow-sm p-8">
        <!-- Title -->
        <div class="text-center mb-12">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $t('Privacy Policy') }}</h1>
          <p class="text-lg text-gray-600">{{ $t('Company Name') }} - {{ $t('Food Delivery Platform') }}</p>
          <p class="text-sm text-gray-500 mt-2">{{ $t('Last updated') }}: {{ currentDate }}</p>
        </div>

        <!-- Content -->
        <div class="prose prose-lg max-w-none">
          <!-- Introduction -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.intro') }}</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              {{ $t('privacy.introText1', { company: $t('Company Name') }) }}
            </p>
            <p class="text-gray-700 leading-relaxed">
              {{ $t('privacy.introText2') }}
            </p>
          </section>

          <!-- Information We Collect -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.infoWeCollect') }}</h2>
            <div class="bg-blue-50 p-6 rounded-lg mb-6">
              <h3 class="text-lg font-semibold text-blue-900 mb-3">{{ $t('privacy.essentialInfo') }}</h3>
              <p class="text-blue-800 mb-4">
                {{ $t('privacy.essentialInfoDesc') }}
              </p>
            </div>

            <div class="space-y-4">
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $t('privacy.personalInfo') }}</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                  <li><strong>{{ $t('Full Name') }}</strong> - {{ $t('privacy.fullNameDesc') }}</li>
                  <li><strong>{{ $t('Phone Number') }}</strong> - {{ $t('privacy.phoneDesc') }}</li>
                  <li><strong>{{ $t('Email') }}</strong> - {{ $t('privacy.emailDesc') }}</li>
                  <li><strong>{{ $t('Delivery Address') }}</strong> - {{ $t('privacy.deliveryAddrDesc') }}</li>
                </ul>
                <p class="text-gray-600 text-sm mt-2 italic">
                  {{ $t('privacy.notePersonal') }}
                </p>
              </div>

              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $t('privacy.technicalInfo') }}</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                  <li>{{ $t('privacy.orderDateDesc') }}</li>
                  <li>{{ $t('privacy.deviceDesc') }}</li>
                  <li>{{ $t('privacy.ipDesc') }}</li>
                </ul>
                <p class="text-gray-600 text-sm mt-2 italic">
                  {{ $t('privacy.noteTechnical') }}
                </p>
              </div>
            </div>
          </section>

          <!-- How We Use Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.howWeUse') }}</h2>
            <div class="space-y-4">
              <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-green-900 mb-2">{{ $t('privacy.orderProcessing') }}</h3>
                <p class="text-green-800">
                  {{ $t('privacy.orderProcessingDesc') }}
                </p>
              </div>

              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ $t('privacy.communication') }}</h3>
                <p class="text-blue-800">
                  {{ $t('privacy.communicationDesc') }}
                </p>
              </div>

              <div class="bg-purple-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-purple-900 mb-2">{{ $t('privacy.securityFraud') }}</h3>
                <p class="text-purple-800">
                  {{ $t('privacy.securityFraudDesc') }}
                </p>
              </div>
            </div>
          </section>

          <!-- Data Protection -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.dataProtection') }}</h2>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.encryption') }}</h3>
                <p class="text-gray-700">{{ $t('privacy.encryptionDesc') }}</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.secureServers') }}</h3>
                <p class="text-gray-700">{{ $t('privacy.secureServersDesc') }}</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.limitedAccess') }}</h3>
                <p class="text-gray-700">{{ $t('privacy.limitedAccessDesc') }}</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.backup') }}</h3>
                <p class="text-gray-700">{{ $t('privacy.backupDesc') }}</p>
              </div>
            </div>
          </section>

          <!-- Apple & Android Compliance -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.appStoreCompliance') }}</h2>
            <div class="bg-gradient-to-r from-blue-50 to-green-50 p-6 rounded-lg mb-6">
              <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.appStoreGuidelines') }}</h3>
              <p class="text-gray-700 mb-4">
                {{ $t('privacy.appStoreDesc') }}
              </p>
            </div>

            <div class="space-y-4">
              <div class="bg-white p-4 rounded-lg" :class="currentLanguage === 'ar' ? 'border-r-4 border-blue-500' : 'border-l-4 border-blue-500'">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $t('privacy.minimalData') }}</h4>
                <p class="text-gray-700">
                  {{ $t('privacy.minimalDataDesc') }}
                </p>
              </div>

              <div class="bg-white p-4 rounded-lg" :class="currentLanguage === 'ar' ? 'border-r-4 border-green-500' : 'border-l-4 border-green-500'">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $t('privacy.transparentPurpose') }}</h4>
                <p class="text-gray-700">
                  {{ $t('privacy.transparentPurposeDesc') }}
                </p>
              </div>

              <div class="bg-white p-4 rounded-lg" :class="currentLanguage === 'ar' ? 'border-r-4 border-purple-500' : 'border-l-4 border-purple-500'">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $t('privacy.noThirdParty') }}</h4>
                <p class="text-gray-700">
                  {{ $t('privacy.noThirdPartyDesc') }}
                </p>
              </div>

              <div class="bg-white p-4 rounded-lg" :class="currentLanguage === 'ar' ? 'border-r-4 border-orange-500' : 'border-l-4 border-orange-500'">
                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $t('privacy.userControl') }}</h4>
                <p class="text-gray-700">
                  {{ $t('privacy.userControlDesc') }}
                </p>
              </div>
            </div>
          </section>

          <!-- Data Storage & Retention -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.dataStorage') }}</h2>
            <div class="bg-yellow-50 p-6 rounded-lg mb-6">
              <h3 class="text-lg font-semibold text-yellow-900 mb-3">{{ $t('privacy.localStorage') }}</h3>
              <p class="text-yellow-800">
                {{ $t('privacy.localStorageDesc') }}
              </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
              <div class="bg-white border border-gray-200 p-6 rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.retentionPeriod') }}</h4>
                <ul class="text-gray-700 space-y-2">
                  <li>• {{ $t('privacy.orderDataRetention') }}</li>
                  <li>• {{ $t('privacy.contactRetention') }}</li>
                  <li>• {{ $t('privacy.paymentRetention') }}</li>
                  <li>• {{ $t('privacy.logsRetention') }}</li>
                </ul>
              </div>

              <div class="bg-white border border-gray-200 p-6 rounded-lg">
                <h4 class="text-lg font-semibold text-gray-800 mb-3">{{ $t('privacy.dataDeletion') }}</h4>
                <ul class="text-gray-700 space-y-2">
                  <li>• {{ $t('privacy.immediateDeletion') }}</li>
                  <li>• {{ $t('privacy.autoDeletion') }}</li>
                  <li>• {{ $t('privacy.secureDeletion') }}</li>
                  <li>• {{ $t('privacy.noRecovery') }}</li>
                </ul>
              </div>
            </div>
          </section>

          <!-- Your Rights -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.yourRights') }}</h2>
            <div class="space-y-3">
              <div class="flex items-start gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">{{ $t('privacy.rightAccess') }}</p>
              </div>

              <div class="flex items-start gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">{{ $t('privacy.rightCorrect') }}</p>
              </div>

              <div class="flex items-start gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">{{ $t('privacy.rightDelete') }}</p>
              </div>

              <div class="flex items-start gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">{{ $t('privacy.rightWithdraw') }}</p>
              </div>

              <div class="flex items-start gap-3" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">{{ $t('privacy.rightPortability') }}</p>
              </div>
            </div>
          </section>

          <!-- Contact Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('Contact Us') }}</h2>
            <div class="bg-orange-50 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-orange-900 mb-4">{{ $t('Company Name') }}</h3>
              <div class="space-y-2 text-orange-800">
                <p><strong>{{ $t('privacy.addressLabel') }}:</strong> {{ $t('privacy.riyadh') }}</p>
                <p><strong>{{ $t('Phone') }}:</strong> +966 50 784 4079</p>
                <p><strong>{{ $t('Email') }}:</strong> info@adv-line.sa</p>
                <p><strong>{{ $t('privacy.website') }}:</strong> www.advfood.com</p>
              </div>
            </div>
          </section>

          <!-- Updates -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t('privacy.policyUpdates') }}</h2>
            <p class="text-gray-700 leading-relaxed">
              {{ $t('privacy.policyUpdatesDesc') }}
            </p>
          </section>

          <!-- Footer -->
          <div class="border-t border-gray-200 pt-8 mt-12">
            <div class="text-center">
              <p class="text-gray-600 mb-4">
                {{ $t('Thank you for trusting') }} <strong>{{ $t('Company Name') }}</strong>
              </p>
              <div class="flex justify-center gap-6" :class="currentLanguage === 'ar' ? 'flex-row-reverse' : ''">
                <Link href="/" class="text-orange-600 hover:text-orange-700 font-medium">
                  {{ $t('Home') }}
                </Link>
                <Link href="/terms" class="text-orange-600 hover:text-orange-700 font-medium">
                  {{ $t('Terms & Conditions') }}
                </Link>
                <Link href="/contact" class="text-orange-600 hover:text-orange-700 font-medium">
                  {{ $t('Contact Us') }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, ref, watch, onMounted, onUnmounted } from 'vue'
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()
const currentLanguage = ref(locale.value || 'ar')
const isLanguageDropdownOpen = ref(false)

const languages = [
  { code: 'ar', name: 'العربية', flag: '🇸🇦' },
  { code: 'en', name: 'English', flag: '🇺🇸' },
]

const getCurrentLanguage = computed(() => {
  return languages.find(lang => lang.code === currentLanguage.value) || languages[0]
})

const toggleLanguageDropdown = () => {
  isLanguageDropdownOpen.value = !isLanguageDropdownOpen.value
}

const handleLanguageChange = (languageCode) => {
  currentLanguage.value = languageCode
  locale.value = languageCode
  isLanguageDropdownOpen.value = false
}

watch(currentLanguage, (newLang) => {
  locale.value = newLang
})

const closeDropdown = (e) => {
  if (isLanguageDropdownOpen.value && !e.target.closest('.relative')) {
    isLanguageDropdownOpen.value = false
  }
}

onMounted(() => {
  currentLanguage.value = locale.value || 'ar'
  document.addEventListener('click', closeDropdown)
})

onUnmounted(() => {
  document.removeEventListener('click', closeDropdown)
})

// Get current date
const currentDate = computed(() => {
  const localeStr = currentLanguage.value === 'ar' ? 'ar-SA' : 'en-US'
  return new Date().toLocaleDateString(localeStr, {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
})
</script>
