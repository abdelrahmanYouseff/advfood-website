<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex items-center">
            <Link href="/" class="flex items-center">
              <img src="/logo-white.png" alt="ADVFood Logo" class="h-10 w-auto">
            </Link>
          </div>

          <!-- Back to Home -->
          <Link
            href="/"
            class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200"
          >
            Back to Home
          </Link>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="bg-white rounded-lg shadow-sm p-8">
        <!-- Title -->
        <div class="text-center mb-12">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">Privacy Policy</h1>
          <p class="text-lg text-gray-600">Advanced Line Food - Food Delivery Platform</p>
          <p class="text-sm text-gray-500 mt-2">Last updated: {{ currentDate }}</p>
        </div>

        <!-- Content -->
        <div class="prose prose-lg max-w-none">
          <!-- Introduction -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Introduction</h2>
            <p class="text-gray-700 leading-relaxed mb-4">
              At <strong>Advanced Line Food</strong>, we are committed to protecting your privacy and personal data.
              This policy explains how we collect, use, and protect your information when you use our platform.
            </p>
            <p class="text-gray-700 leading-relaxed">
              By using our website or application, you agree to the terms outlined in this policy.
            </p>
          </section>

          <!-- Information We Collect -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Information We Collect</h2>
            <div class="space-y-4">
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Personal Information</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                  <li>Full name</li>
                  <li>Phone number</li>
                  <li>Email address</li>
                  <li>Delivery address</li>
                  <li>Food preferences</li>
                </ul>
              </div>

              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Usage Information</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                  <li>Order date and time</li>
                  <li>Favorite restaurants</li>
                  <li>Browsing history</li>
                  <li>IP address</li>
                  <li>Device and browser type</li>
                </ul>
              </div>
            </div>
          </section>

          <!-- How We Use Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">How We Use Your Information</h2>
            <div class="space-y-4">
              <div class="bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Order Processing</h3>
                <p class="text-blue-800">We use your information to process and deliver your orders with the highest quality.</p>
              </div>

              <div class="bg-green-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-green-900 mb-2">Service Improvement</h3>
                <p class="text-green-800">We analyze your data to provide personalized food recommendations.</p>
              </div>

              <div class="bg-purple-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-purple-900 mb-2">Communication</h3>
                <p class="text-purple-800">We send you order updates and special offers.</p>
              </div>
            </div>
          </section>

          <!-- Data Protection -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Data Protection</h2>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Encryption</h3>
                <p class="text-gray-700">All data is protected with SSL 256-bit encryption</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Secure Servers</h3>
                <p class="text-gray-700">Your data is stored on secure and protected servers</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Limited Access</h3>
                <p class="text-gray-700">Only our limited team can access your data</p>
              </div>

              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Backup</h3>
                <p class="text-gray-700">Regular encrypted backups of your data</p>
              </div>
            </div>
          </section>

          <!-- Your Rights -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Your Rights</h2>
            <div class="space-y-3">
              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">Right to access your personal data</p>
              </div>

              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">Right to correct or update your data</p>
              </div>

              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">Right to delete your account and data</p>
              </div>

              <div class="flex items-start space-x-3">
                <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                  <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <p class="text-gray-700">Right to withdraw your consent at any time</p>
              </div>
            </div>
          </section>

          <!-- Contact Information -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact Information</h2>
            <div class="bg-orange-50 p-6 rounded-lg">
              <h3 class="text-lg font-semibold text-orange-900 mb-4">Advanced Line Food</h3>
              <div class="space-y-2 text-orange-800">
                <p><strong>Address:</strong> Riyadh, Saudi Arabia</p>
                <p><strong>Phone:</strong> +966 50 784 4079</p>
                <p><strong>Email:</strong> info@adv-line.sa</p>
                <p><strong>Website:</strong> www.advfood.com</p>
              </div>
            </div>
          </section>

          <!-- Updates -->
          <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Policy Updates</h2>
            <p class="text-gray-700 leading-relaxed">
              We may update this policy from time to time. We will notify you of any significant changes via
              email or through a notice on our website. We recommend reviewing this page regularly.
            </p>
          </section>

          <!-- Footer -->
          <div class="border-t border-gray-200 pt-8 mt-12">
            <div class="text-center">
              <p class="text-gray-600 mb-4">
                Thank you for trusting <strong>Advanced Line Food</strong>
              </p>
              <div class="flex justify-center space-x-6">
                <Link href="/" class="text-orange-600 hover:text-orange-700 font-medium">
                  Home
                </Link>
                <Link href="/terms" class="text-orange-600 hover:text-orange-700 font-medium">
                  Terms & Conditions
                </Link>
                <Link href="/contact" class="text-orange-600 hover:text-orange-700 font-medium">
                  Contact Us
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
import { computed } from 'vue'

// Get current date
const currentDate = computed(() => {
  return new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
})
</script>
