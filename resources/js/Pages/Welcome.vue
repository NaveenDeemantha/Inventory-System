<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DarkModeToggle from '@/Components/DarkModeToggle.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-brand-dark text-white selection:bg-brand-primary selection:text-white overflow-x-hidden">
        <!-- Background Gradient Effect -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-[40%] -left-[20%] w-[70%] h-[70%] rounded-full bg-brand-primary/20 blur-[120px]"></div>
            <div class="absolute top-[20%] -right-[20%] w-[60%] h-[60%] rounded-full bg-brand-secondary/20 blur-[100px]"></div>
        </div>

        <!-- Navbar -->
        <nav class="container mx-auto flex items-center justify-between px-6 py-6 lg:px-8">
            <div class="flex items-center gap-3">
                <div class="bg-white/10 p-2 rounded-lg backdrop-blur-sm">
                    <ApplicationLogo class="h-8 w-auto object-contain" />
                </div>
                <span class="text-xl font-bold tracking-tight text-white">SmartProcure</span>
            </div>
            
            <div class="flex items-center gap-4">
                <DarkModeToggle />
                
                <div v-if="canLogin" class="flex items-center gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="hidden sm:block text-sm font-semibold text-white hover:text-brand-light transition-colors"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-sm font-semibold text-white hover:text-brand-light transition-colors"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-full bg-brand-primary px-5 py-2 text-sm font-semibold text-white shadow-lg hover:bg-brand-secondary transition-all duration-300 hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-primary"
                        >
                            Get Started
                        </Link>
                    </template>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="container mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between py-16 lg:py-24 gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2 text-center lg:text-left z-10">
                    <div class="inline-flex items-center rounded-full border border-brand-primary/30 bg-brand-primary/10 px-3 py-1 text-sm font-medium text-brand-light mb-6 backdrop-blur-sm">
                        <span class="flex h-2 w-2 rounded-full bg-green-400 mr-2"></span>
                        v1.0 Now Available
                    </div>
                    
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-6xl mb-6 leading-tight">
                        Intelligent Inventory <br class="hidden lg:block" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-brand-light">Management</span>
                    </h1>
                    
                    <p class="mt-4 text-lg leading-8 text-brand-light/80 max-w-2xl mx-auto lg:mx-0">
                        Streamline your operations with our cutting-edge inventory system. Real-time tracking, powerful analytics, and seamless user management all in one place.
                    </p>
                    
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="w-full sm:w-auto rounded-full bg-brand-primary px-8 py-3.5 text-sm font-semibold text-white shadow-lg hover:bg-brand-secondary transition-all duration-300 hover:shadow-brand-primary/25 hover:-translate-y-1 text-center"
                        >
                            Go to Dashboard
                        </Link>
                        <Link
                            v-else
                            :href="route('register')"
                            class="w-full sm:w-auto rounded-full bg-brand-primary px-8 py-3.5 text-sm font-semibold text-white shadow-lg hover:bg-brand-secondary transition-all duration-300 hover:shadow-brand-primary/25 hover:-translate-y-1 text-center"
                        >
                            Get Started 
                        </Link>
                        
                        <a href="#features" class="w-full sm:w-auto rounded-full border border-white/20 bg-white/5 px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/10 transition-all duration-300 text-center backdrop-blur-sm">
                            Learn More
                        </a>
                    </div>
                    
                    <div class="mt-10 flex items-center justify-center lg:justify-start gap-8 text-brand-light/60 grayscale opacity-70">
                        <!-- Trust Badges / Logos Placeholder -->
                        <div class="flex items-center gap-2">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
                            <span class="font-bold">Secure</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                            <span class="font-bold">Global</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                            <span class="font-bold">Reports</span>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Visual) -->
                <div class="lg:w-1/2 relative z-10">
                    <div class="relative rounded-2xl bg-gradient-to-b from-white/10 to-white/5 p-2 backdrop-blur-xl border border-white/10 shadow-2xl transform lg:rotate-3 hover:rotate-0 transition-all duration-500">
                        <div class="rounded-xl bg-brand-secondary/50 overflow-hidden aspect-[4/3] relative group">
                            <!-- Abstract UI Representation -->
                            <div class="absolute inset-0 flex flex-col p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="h-3 w-24 bg-white/20 rounded-full"></div>
                                    <div class="flex gap-2">
                                        <div class="h-3 w-3 bg-red-400 rounded-full"></div>
                                        <div class="h-3 w-3 bg-yellow-400 rounded-full"></div>
                                        <div class="h-3 w-3 bg-green-400 rounded-full"></div>
                                    </div>
                                </div>
                                <div class="flex gap-4 mb-6">
                                    <div class="w-1/3 h-24 bg-white/10 rounded-lg animate-pulse"></div>
                                    <div class="w-1/3 h-24 bg-white/10 rounded-lg animate-pulse delay-75"></div>
                                    <div class="w-1/3 h-24 bg-white/10 rounded-lg animate-pulse delay-150"></div>
                                </div>
                                <div class="flex-1 bg-white/5 rounded-lg p-4 space-y-3">
                                    <div class="h-3 w-3/4 bg-white/10 rounded-full"></div>
                                    <div class="h-3 w-1/2 bg-white/10 rounded-full"></div>
                                    <div class="h-3 w-5/6 bg-white/10 rounded-full"></div>
                                </div>
                            </div>
                            
                            <!-- Floating Elements -->
                            <div class="absolute -bottom-6 -left-6 bg-brand-primary p-4 rounded-xl shadow-xl border border-white/10 animate-bounce delay-700">
                                <div class="flex items-center gap-3">
                                    <div class="bg-green-500/20 p-2 rounded-lg">
                                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-brand-light">Growth</div>
                                        <div class="text-lg font-bold text-white">+24%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Grid -->
            <div id="features" class="py-24 border-t border-white/10">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Everything you need</h2>
                    <p class="mt-4 text-lg text-brand-light/70">Manage your inventory with tools designed for modern businesses.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white/5 rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-colors group">
                        <div class="bg-brand-primary/20 w-12 h-12 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Real-time Tracking</h3>
                        <p class="text-brand-light/60">Monitor stock levels instantly as they change. Never run out of essential items again.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white/5 rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-colors group">
                        <div class="bg-brand-primary/20 w-12 h-12 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">User Management</h3>
                        <p class="text-brand-light/60">Granular access controls for Super Admins and regular users. Keep your data secure.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white/5 rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-colors group">
                        <div class="bg-brand-primary/20 w-12 h-12 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Advanced Analytics</h3>
                        <p class="text-brand-light/60">Visual charts and reports to help you make data-driven decisions for your business.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="border-t border-white/10 py-8 text-center">
            <p class="text-sm text-brand-light/40">
                &copy; {{ new Date().getFullYear() }} SmartProcure. All rights reserved.
                <span class="mx-2">|</span>
                Developed by Hoomans.lk
                <!-- Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }}) -->
            </p>
        </footer>
    </div>
</template>
