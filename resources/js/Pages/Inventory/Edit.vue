<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
});

const form = useForm({
    name: props.product.name,
    sku: props.product.sku,
    price: props.product.price,
    quantity: props.product.quantity,
    description: props.product.description,
});

const submit = () => {
    form.put(route('products.update', props.product.id));
};
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Edit Product
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Name -->
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <!-- SKU -->
                            <div>
                                <InputLabel for="sku" value="SKU" />
                                <TextInput
                                    id="sku"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.sku"
                                    required
                                    autocomplete="sku"
                                />
                                <InputError class="mt-2" :message="form.errors.sku" />
                            </div>

                            <!-- Price -->
                            <div>
                                <InputLabel for="price" value="Price" />
                                <TextInput
                                    id="price"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.price"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.price" />
                            </div>

                            <!-- Quantity -->
                            <div>
                                <InputLabel for="quantity" value="Quantity" />
                                <TextInput
                                    id="quantity"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.quantity"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.quantity" />
                            </div>

                             <!-- Description -->
                            <div>
                                <InputLabel for="description" value="Description" />
                                <textarea
                                    id="description"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                    v-model="form.description"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save Changes</PrimaryButton>
                                <Link :href="route('products.index')">
                                    <SecondaryButton type="button">Cancel</SecondaryButton>
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
