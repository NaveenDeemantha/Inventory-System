<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch, onMounted } from 'vue';
import axios from 'axios';
import { debounce } from 'lodash';

const searchQuery = ref('');
const products = ref([]);
const loading = ref(false);
const importing = ref(null);

const searchProducts = debounce(async (query) => {
    loading.value = true;
    try {
        const response = await axios.get(route('import.search'), {
            params: { query }
        });
        products.value = response.data.products;
    } catch (error) {
        console.error('Search failed:', error);
    } finally {
        loading.value = false;
    }
}, 300);

onMounted(() => {
    searchProducts('');
});

watch(searchQuery, (newQuery) => {
    searchProducts(newQuery);
});

const importProduct = (product) => {
    importing.value = product.id;
    const form = useForm({
        title: product.title,
        description: product.description,
        price: product.price,
        stock: product.stock,
        thumbnail: product.thumbnail,
        category: product.category,
        brand: product.brand,
    });

    form.post(route('import.store'), {
        preserveScroll: true,
        onSuccess: () => {
            // Optional: Show success message or remove item
            importing.value = null;
        },
        onError: () => {
            importing.value = null;
        }
    });
};
</script>

<template>
    <Head title="Industrial Catalog" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Industrial Supply Catalog
            </h2>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Search Section -->
                <div class="mb-8">
                    <div class="relative max-w-xl mx-auto">
                        <input
                            v-model="searchQuery"
                            type="text"
                            placeholder="Search catalog (e.g. 'Fiber', 'Cement', 'Drill')..."
                            class="w-full rounded-lg border-gray-300 pl-12 pr-4 py-3 shadow-sm focus:border-brand-primary focus:ring-brand-primary dark:bg-gray-800 dark:border-gray-700 dark:text-white"
                        />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-center text-sm text-gray-500 mt-2">
                        Browse our integrated supplier catalog for Telecommunication and Construction materials.
                    </p>
                </div>

                <!-- Loading State -->
                <div v-if="loading" class="flex justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-primary"></div>
                </div>

                <!-- Results Grid -->
                <div v-else-if="products.length > 0" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 flex flex-col"
                    >
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 dark:bg-gray-700 relative h-48">
                            <img :src="product.thumbnail" :alt="product.title" class="object-cover w-full h-full" />
                            <div class="absolute top-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded backdrop-blur-sm">
                                {{ product.category }}
                            </div>
                        </div>
                        
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 line-clamp-1" :title="product.title">
                                {{ product.title }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-3 line-clamp-2 flex-1">
                                {{ product.description }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-700">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500">Price</span>
                                    <span class="font-bold text-brand-primary text-lg">${{ product.price }}</span>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-xs text-gray-500">Stock</span>
                                    <span class="font-medium text-gray-700 dark:text-gray-300">{{ product.stock }}</span>
                                </div>
                            </div>

                            <button
                                @click="importProduct(product)"
                                :disabled="importing === product.id"
                                class="mt-4 w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-brand-primary hover:bg-brand-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-primary disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                            >
                                <svg v-if="importing === product.id" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <svg v-else class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                {{ importing === product.id ? 'Importing...' : 'Import to Inventory' }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else-if="!loading && searchQuery" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search terms.</p>
                </div>
                
                <!-- Initial State -->
                <div v-else class="text-center py-12">
                     <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Search to Import</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Type in the search box to find products from the external catalog.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
