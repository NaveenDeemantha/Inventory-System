<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DashboardCard from '@/Components/DashboardCard.vue';
import DashboardChart from '@/Components/DashboardChart.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    stats: Object,
    charts: Object,
});

const pieChartData = computed(() => ({
    labels: props.charts.inventoryByCategory.labels,
    datasets: [
        {
            backgroundColor: ['#0C2B4E', '#1A3D64', '#1D546C', '#F4F4F4', '#93C5FD', '#60A5FA'],
            data: props.charts.inventoryByCategory.data,
        },
    ],
}));

const barChartData = computed(() => ({
    labels: props.charts.inventoryByCategory.labels,
    datasets: [
        {
            label: 'Product Count',
            backgroundColor: '#1D546C',
            data: props.charts.inventoryByCategory.data,
        },
    ],
}));
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard Overview
            </h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 animate-fade-in-up">
                    <DashboardCard title="Total Products" :value="stats.totalProducts" color="blue">
                        <template #icon>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </template>
                    </DashboardCard>

                    <DashboardCard title="Total Value" :value="'LKR ' + stats.totalValue" color="green">
                        <template #icon>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </template>
                    </DashboardCard>

                    <DashboardCard title="Low Stock Items" :value="stats.lowStockItems" color="red">
                        <template #icon>
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </template>
                    </DashboardCard>

                    <Link :href="route('categories.index')">
                        <DashboardCard title="Categories" :value="stats.totalCategories" color="purple">
                            <template #icon>
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </template>
                        </DashboardCard>
                    </Link>
                </div>

                <!-- Charts Section -->
                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2 animate-fade-in-up delay-200">
                    <div class="overflow-hidden rounded-lg bg-white/80 shadow-md backdrop-blur-sm dark:bg-gray-800/80 border border-white/20 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Inventory Distribution</h3>
                            <DashboardChart type="pie" :data="pieChartData" />
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-lg bg-white/80 shadow-md backdrop-blur-sm dark:bg-gray-800/80 border border-white/20 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Stock Levels by Category</h3>
                            <DashboardChart type="bar" :data="barChartData" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
