<script setup>
defineProps({
    title: String,
    value: [String, Number],
    color: {
        type: String,
        default: 'blue', // blue, green, yellow, red, indigo, purple, pink
    },
});

const colorClasses = {
    blue: 'bg-blue-500',
    green: 'bg-green-500',
    yellow: 'bg-yellow-500',
    red: 'bg-red-500',
    indigo: 'bg-indigo-500',
    purple: 'bg-purple-500',
    pink: 'bg-pink-500',
    gray: 'bg-gray-500',
};

const iconBgClasses = {
    blue: 'bg-blue-100 text-blue-500 dark:bg-blue-900 dark:text-blue-300',
    green: 'bg-green-100 text-green-500 dark:bg-green-900 dark:text-green-300',
    yellow: 'bg-yellow-100 text-yellow-500 dark:bg-yellow-900 dark:text-yellow-300',
    red: 'bg-red-100 text-red-500 dark:bg-red-900 dark:text-red-300',
    indigo: 'bg-indigo-100 text-indigo-500 dark:bg-indigo-900 dark:text-indigo-300',
    purple: 'bg-purple-100 text-purple-500 dark:bg-purple-900 dark:text-purple-300',
    pink: 'bg-pink-100 text-pink-500 dark:bg-pink-900 dark:text-pink-300',
    gray: 'bg-gray-100 text-gray-500 dark:bg-gray-900 dark:text-gray-300',
};
</script>

<template>
    <div class="overflow-hidden rounded-lg bg-white/80 shadow-md backdrop-blur-sm transition-transform hover:scale-105 dark:bg-gray-800/80 border border-white/20 dark:border-gray-700">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div :class="['flex h-12 w-12 items-center justify-center rounded-md', iconBgClasses[color]]">
                        <slot name="icon">
                            <!-- Default Icon if none provided -->
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </slot>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ title }}
                        </dt>
                        <dd>
                            <div class="text-lg font-medium text-brand-dark dark:text-white">
                                {{ value }}
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50/50 px-5 py-3 dark:bg-gray-700/50">
            <div class="text-sm">
                <a href="#" class="font-medium text-brand-primary hover:text-brand-secondary dark:text-brand-primary">
                    View all
                </a>
            </div>
        </div>
    </div>
</template>
