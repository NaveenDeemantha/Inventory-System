<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';

const page = usePage();
const lowStockItems = computed(() => page.props.notifications?.low_stock || []);
const hasNotifications = computed(() => lowStockItems.value.length > 0);
</script>

<template>
    <div class="relative">
        <Dropdown align="right" width="60">
            <template #trigger>
                <button
                    class="relative flex items-center rounded-full p-1 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-300"
                >
                    <span class="sr-only">View notifications</span>
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"
                        />
                    </svg>
                    
                    <!-- Notification Badge -->
                    <span
                        v-if="hasNotifications"
                        class="absolute right-0 top-0 flex h-4 w-4 items-center justify-center rounded-full bg-brand-primary text-[10px] font-bold text-white ring-2 ring-white dark:ring-gray-900"
                    >
                        {{ lowStockItems.length }}
                    </span>
                </button>
            </template>

            <template #content>
                <div class="w-64 py-1">
                    <div class="border-b border-gray-100 px-4 py-2 text-sm font-semibold text-gray-700 dark:border-gray-700 dark:text-gray-200">
                        Notifications
                    </div>
                    
                    <div v-if="hasNotifications" class="max-h-64 overflow-y-auto">
                        <div v-for="item in lowStockItems" :key="item.id" class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <Link :href="route('products.edit', item.id)" class="block">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    Low Stock Alert
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">{{ item.name }}</span> is running low ({{ item.quantity }} left).
                                </p>
                            </Link>
                        </div>
                    </div>
                    
                    <div v-else class="px-4 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                        No new notifications.
                    </div>
                </div>
            </template>
        </Dropdown>
    </div>
</template>
