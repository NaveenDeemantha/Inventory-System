<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DarkModeToggle from '@/Components/DarkModeToggle.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center justify-center bg-brand-dark relative overflow-hidden py-12">
        <!-- Background Gradient Effect -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-brand-primary/20 blur-[120px]"></div>
            <div class="absolute bottom-[10%] -right-[10%] w-[50%] h-[50%] rounded-full bg-brand-secondary/20 blur-[100px]"></div>
        </div>

        <div class="absolute right-6 top-6 z-20">
            <DarkModeToggle />
        </div>

        <div class="mb-8 z-10 animate-fade-in-down">
            <Link href="/" class="flex flex-col items-center">
                <div class="bg-white/10 p-4 rounded-2xl backdrop-blur-sm shadow-xl border border-white/10 mb-4">
                    <ApplicationLogo class="h-16 w-auto object-contain" />
                </div>
                <span class="text-2xl font-bold tracking-tight text-white">SmartProcure</span>
            </Link>
        </div>

        <div
            class="w-full overflow-hidden bg-white/90 px-8 py-8 shadow-2xl sm:max-w-md sm:rounded-2xl backdrop-blur-xl border border-white/20 dark:bg-gray-900/80 dark:border-gray-700 z-10 animate-fade-in-up"
        >
            <slot />
        </div>
        
        <div class="mt-8 text-center text-sm text-brand-light/40 z-10">
            &copy; {{ new Date().getFullYear() }} SmartProcure. All rights reserved.
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in-down {
    animation: fadeInDown 0.8s ease-out;
}
.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
