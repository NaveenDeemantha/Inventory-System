<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    categories: Array,
});
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <Link
                        v-for="category in categories"
                        :key="category.id"
                        :href="route('categories.show', category.slug)"
                        class="block overflow-hidden rounded-lg bg-white shadow hover:shadow-md transition-shadow dark:bg-gray-800"
                    >
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ category.name }}
                            </h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ category.products_count }} Products
                            </p>
                            <p class="mt-4 text-sm text-brand-primary dark:text-brand-primary">
                                View Inventory &rarr;
                            </p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
