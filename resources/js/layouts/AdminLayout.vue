<script setup>
import { Link, Form } from '@inertiajs/vue3'
import { ref } from 'vue'

const sidebarOpen = ref(false)
</script>

<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 right-0 z-50 w-64 bg-white shadow-lg"
         :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'">

      <!-- Logo -->
      <div class="flex items-center justify-center h-16 px-4 bg-gradient-to-r from-green-600 to-blue-600">
        <img src="/Foods Logo.png" alt="شعار ADVFood" class="h-8 w-8 mr-3 rounded shadow-sm">
        <h2 class="text-xl font-bold text-white">لوحة تحكم ADVFood</h2>
      </div>

      <!-- Navigation -->
      <nav class="mt-8 px-4">
        <div class="space-y-2">
          <!-- Dashboard -->
          <Link
            :href="route('admin.dashboard')"
            class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            :class="$page.component.startsWith('Admin/Dashboard') ? 'bg-green-50 text-green-700 border-l-4 border-green-500' : ''"
          >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
          </Link>

          <!-- Restaurants -->
          <Link
            :href="route('admin.restaurants.index')"
            class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            :class="$page.component.startsWith('Admin/Restaurants') ? 'bg-green-50 text-green-700 border-l-4 border-green-500' : ''"
          >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <span class="font-medium">المطاعم</span>
          </Link>

          <!-- Menus (Products) -->
          <Link
            :href="route('admin.products.index')"
            class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            :class="$page.component.startsWith('Admin/Products') ? 'bg-green-50 text-green-700 border-l-4 border-green-500' : ''"
          >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span class="font-medium">المنيو</span>
          </Link>

          <!-- Orders -->
          <Link
            :href="route('admin.orders.index')"
            class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200"
            :class="$page.component.startsWith('Admin/Orders') ? 'bg-green-50 text-green-700 border-l-4 border-green-500' : ''"
          >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            الطلبات
          </Link>
        </div>

        <!-- Bottom section -->
        <div class="mt-8 pt-8 border-t border-gray-200">
          <Link
            href="/"
            class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200"
          >
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            عرض الموقع
          </Link>
        </div>
      </nav>
    </div>

    <!-- Mobile sidebar overlay -->
    <div v-if="sidebarOpen"
         class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- Main content - LTR: margin-right for sidebar | RTL: margin-left for sidebar -->
    <div class="min-h-screen lg:mr-64 rtl:lg:mr-0 rtl:lg:ml-64 min-w-0">
      <!-- Top header -->
      <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between items-center py-4">
            <!-- Mobile menu button -->
            <button
              @click="sidebarOpen = !sidebarOpen"
              class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>

            <!-- Page title -->
            <div class="flex-1 lg:flex-none">
              <slot name="header">
                <h1 class="text-xl font-semibold text-gray-900">لوحة التحكم</h1>
              </slot>
            </div>

            <!-- User menu -->
            <div class="flex items-center space-x-4">
              <Form method="post" :action="route('admin.logout')" as="button">
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                  تسجيل الخروج
                </button>
              </Form>
            </div>
          </div>
        </div>
      </header>

      <!-- Page content -->
      <main class="p-6 lg:p-8 bg-gray-50 min-h-screen">
        <slot />
      </main>
    </div>
  </div>
</template>