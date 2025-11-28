<script setup>
import { ref } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NotificationDropdown from '@/Components/NotificationDropdown.vue';
import DarkModeToggle from '@/Components/DarkModeToggle.vue';
import { Link } from '@inertiajs/vue3';

const showingSidebar = ref(false);
const isSidebarCollapsed = ref(false);
</script>

<template>
    <div class="flex h-screen overflow-hidden bg-brand-light dark:bg-gray-900 text-gray-900 dark:text-gray-100 relative">
        <!-- Background Gradient Effect -->
        <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-brand-primary/10 blur-[100px]"></div>
            <div class="absolute top-[40%] -right-[10%] w-[40%] h-[40%] rounded-full bg-brand-secondary/10 blur-[80px]"></div>
            <div class="absolute -bottom-[20%] left-[20%] w-[40%] h-[40%] rounded-full bg-brand-primary/5 blur-[90px]"></div>
        </div>

        <!-- Sidebar -->
        <Sidebar :open="showingSidebar" :collapsed="isSidebarCollapsed" />

        <!-- Off-canvas backdrop -->
        <div
            v-if="showingSidebar"
            class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden"
            @click="showingSidebar = false"
        ></div>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col overflow-hidden transition-all duration-300 relative z-0">
            <!-- Top Navigation -->
            <header class="flex h-16 items-center justify-between border-b border-white/10 bg-white/80 px-6 backdrop-blur-md dark:bg-gray-900/80">
                <div class="flex items-center">
                    <!-- Mobile Hamburger -->
                    <button
                        @click="showingSidebar = !showingSidebar"
                        class="text-gray-500 focus:outline-none lg:hidden"
                    >
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <!-- Desktop Sidebar Toggle -->
                    <button
                        @click="isSidebarCollapsed = !isSidebarCollapsed"
                        class="hidden text-gray-500 hover:text-brand-primary focus:outline-none lg:block mr-4 transition-colors"
                    >
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    
                    <!-- Page Heading (Optional, can be passed via slot) -->
                     <div v-if="$slots.header" class="ml-4 text-xl font-semibold text-gray-800 dark:text-white">
                        <slot name="header" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <NotificationDropdown />
                    <DarkModeToggle />
                    
                    <!-- User Dropdown -->
                    <div class="relative ml-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 hover:text-brand-primary focus:outline-none dark:text-gray-400 dark:hover:text-brand-light transition-colors"
                                >
                                    <div>{{ $page.props.auth.user.name }}</div>

                                    <div class="ml-1">
                                        <svg
                                            class="h-4 w-4 fill-current"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                </button>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 scrollbar-thin scrollbar-thumb-brand-primary/20 scrollbar-track-transparent">
                <slot />
            </main>
        </div>
    </div>
</template>
