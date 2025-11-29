<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import axios from 'axios';

const props = defineProps({
    products: Array,
});

const form = useForm({});
const viewMode = ref('local'); // 'local' or 'catalog'
const catalogItems = ref([]);
const loadingCatalog = ref(false);
const importingId = ref(null);

const deleteProduct = (id) => {
    if (confirm('Are you sure you want to delete this product?')) {
        form.delete(route('products.destroy', id));
    }
};

const fetchCatalog = async () => {
    if (catalogItems.value.length > 0) return;
    
    loadingCatalog.value = true;
    try {
        const response = await axios.get(route('import.search'));
        catalogItems.value = response.data.products;
    } catch (error) {
        console.error('Failed to load catalog', error);
    } finally {
        loadingCatalog.value = false;
    }
};

const toggleView = (mode) => {
    viewMode.value = mode;
    if (mode === 'catalog') {
        fetchCatalog();
    }
};

const importItem = (item) => {
    importingId.value = item.id;
    const importForm = useForm({
        title: item.title,
        description: item.description,
        price: item.price,
        stock: item.stock,
        thumbnail: item.thumbnail,
        category: item.category,
        brand: item.brand,
    });

    importForm.post(route('import.store'), {
        preserveScroll: true,
        onSuccess: () => {
            importingId.value = null;
            // Optional: Switch back to local view or show notification
        },
        onError: () => {
            importingId.value = null;
        }
    });
};

const displayedItems = computed(() => {
    return viewMode.value === 'local' ? props.products : catalogItems.value;
});
</script>

<template>
    <Head title="Inventory" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Inventory Management
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Toolbar -->
                <div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex bg-gray-100 dark:bg-gray-700 p-1 rounded-lg">
                        <button 
                            @click="toggleView('local')"
                            :class="[
                                'px-4 py-2 text-sm font-medium rounded-md transition-all',
                                viewMode === 'local' 
                                    ? 'bg-white dark:bg-gray-600 text-gray-900 dark:text-white shadow-sm' 
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                            ]"
                        >
                            My Inventory
                        </button>
                        <button 
                            @click="toggleView('catalog')"
                            :class="[
                                'px-4 py-2 text-sm font-medium rounded-md transition-all',
                                viewMode === 'catalog' 
                                    ? 'bg-white dark:bg-gray-600 text-gray-900 dark:text-white shadow-sm' 
                                    : 'text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white'
                            ]"
                        >
                            Supplier Catalog
                        </button>
                    </div>

                    <Link
                        v-if="viewMode === 'local'"
                        :href="route('products.create')"
                        class="inline-flex items-center rounded-md bg-brand-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-secondary focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-primary"
                    >
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        Add Product
                    </Link>
                </div>

                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Loading State for Catalog -->
                        <div v-if="viewMode === 'catalog' && loadingCatalog" class="flex justify-center py-12">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-primary"></div>
                        </div>

                        <div v-else class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Image</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                            {{ viewMode === 'catalog' ? 'Category' : 'SKU' }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Price</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                                            {{ viewMode === 'catalog' ? 'Available Stock' : 'Quantity' }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    <tr v-for="item in displayedItems" :key="item.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <!-- Image -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img v-if="viewMode === 'local' ? item.image : item.thumbnail" 
                                                     class="h-10 w-10 rounded-full object-cover" 
                                                     :src="viewMode === 'local' ? item.image : item.thumbnail" 
                                                     :alt="viewMode === 'local' ? item.name : item.title" />
                                                <div v-else class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Name -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ viewMode === 'local' ? item.name : item.title }}
                                        </td>

                                        <!-- SKU / Category -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ viewMode === 'local' ? item.sku : item.category }}
                                        </td>

                                        <!-- Price -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            LKR {{ item.price }}
                                        </td>

                                        <!-- Quantity / Stock -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <span :class="[
                                                'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium',
                                                (viewMode === 'local' ? item.quantity : item.stock) > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                                (viewMode === 'local' ? item.quantity : item.stock) > 0 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'
                                            ]">
                                                {{ viewMode === 'local' ? item.quantity : item.stock }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <template v-if="viewMode === 'local'">
                                                <Link :href="route('products.edit', item.id)" class="text-brand-primary hover:text-brand-secondary dark:text-brand-primary dark:hover:text-brand-secondary mr-4">Edit</Link>
                                                <button @click="deleteProduct(item.id)" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                            </template>
                                            <template v-else>
                                                <button 
                                                    @click="importItem(item)" 
                                                    :disabled="importingId === item.id"
                                                    class="text-brand-primary hover:text-brand-secondary dark:text-brand-primary dark:hover:text-brand-secondary font-semibold disabled:opacity-50"
                                                >
                                                    {{ importingId === item.id ? 'Adding...' : 'Add to Inventory' }}
                                                </button>
                                            </template>
                                        </td>
                                    </tr>
                                    <tr v-if="displayedItems.length === 0">
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            {{ viewMode === 'local' ? 'No products found.' : 'No catalog items found.' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
