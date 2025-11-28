<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';

defineProps({
    open: {
        type: Boolean,
        default: true,
    },
    collapsed: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <aside
        :class="[
            'fixed inset-y-0 left-0 z-50 transform bg-brand-dark shadow-lg transition-all duration-300 ease-in-out lg:static lg:translate-x-0',
            open ? 'translate-x-0' : '-translate-x-full',
            collapsed ? 'lg:w-20' : 'lg:w-64',
            'w-64'
        ]"
    >
        <div class="flex h-16 items-center justify-center border-b border-brand-light/20 transition-all duration-300"
             :class="collapsed ? 'px-2' : 'px-6'">
            <Link :href="route('dashboard')" class="flex items-center justify-center overflow-hidden">
                <ApplicationLogo class="block h-9 w-auto fill-current text-white transition-all duration-300" />
            </Link>
        </div>

        <div class="py-4 overflow-y-auto overflow-x-hidden h-[calc(100vh-4rem)]">
            <nav class="space-y-1 px-2">
                <Link
                    :href="route('dashboard')"
                    :class="[
                        'group flex items-center rounded-md py-2 text-base font-medium transition-colors',
                        collapsed ? 'justify-center px-0' : 'px-2',
                        route().current('dashboard')
                            ? 'bg-brand-primary text-white'
                            : 'text-brand-light hover:bg-white/10 hover:text-white'
                    ]"
                    :title="collapsed ? 'Dashboard' : ''"
                >
                    <svg
                        :class="[
                            'h-6 w-6 flex-shrink-0 transition-all duration-300',
                            route().current('dashboard') ? 'text-white' : 'text-brand-light group-hover:text-white',
                            collapsed ? 'mr-0' : 'mr-4'
                        ]"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span :class="{'lg:hidden': collapsed, 'transition-opacity duration-300': true, 'whitespace-nowrap': true}">Dashboard</span>
                </Link>

                <Link
                    :href="route('products.index')"
                    :class="[
                        'group flex items-center rounded-md py-2 text-base font-medium transition-colors',
                        collapsed ? 'justify-center px-0' : 'px-2',
                        route().current('products.*')
                            ? 'bg-brand-primary text-white'
                            : 'text-brand-light hover:bg-white/10 hover:text-white'
                    ]"
                    :title="collapsed ? 'Inventory' : ''"
                >
                    <svg
                        :class="[
                            'h-6 w-6 flex-shrink-0 transition-all duration-300',
                            route().current('products.*') ? 'text-white' : 'text-brand-light group-hover:text-white',
                            collapsed ? 'mr-0' : 'mr-4'
                        ]"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span :class="{'lg:hidden': collapsed, 'transition-opacity duration-300': true, 'whitespace-nowrap': true}">Inventory</span>
                </Link>

                <Link
                    :href="route('categories.index')" 
                    :class="[
                        'group flex items-center rounded-md py-2 text-base font-medium transition-colors',
                        collapsed ? 'justify-center px-0' : 'px-2',
                        route().current('categories.*')
                            ? 'bg-brand-primary text-white'
                            : 'text-brand-light hover:bg-white/10 hover:text-white'
                    ]"
                    :title="collapsed ? 'Categories' : ''"
                >
                    <svg
                        :class="[
                            'h-6 w-6 flex-shrink-0 transition-all duration-300',
                            route().current('categories.*') ? 'text-white' : 'text-brand-light group-hover:text-white',
                            collapsed ? 'mr-0' : 'mr-4'
                        ]"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span :class="{'lg:hidden': collapsed, 'transition-opacity duration-300': true, 'whitespace-nowrap': true}">Categories</span>
                </Link>

                <!-- Categories List -->
                <div v-if="!collapsed" class="mt-4 space-y-1 pl-4">
                    <p class="px-2 text-xs font-semibold text-brand-light/70 uppercase tracking-wider">
                        Inventory Categories
                    </p>
                    <Link
                        v-for="category in $page.props.categories"
                        :key="category.id"
                        :href="route('categories.show', category.slug)"
                        :class="[
                            'group flex items-center rounded-md px-2 py-2 text-sm font-medium transition-colors',
                            route().current('categories.show', category.slug)
                                ? 'bg-brand-primary text-white'
                                : 'text-brand-light hover:bg-white/10 hover:text-white'
                        ]"
                    >
                        <span class="truncate">{{ category.name }}</span>
                    </Link>
                </div>

                <Link
                    v-if="$page.props.auth.user.role === 'super_admin'"
                    :href="route('users.index')"
                    :class="[
                        'group flex items-center rounded-md py-2 text-base font-medium transition-colors',
                        collapsed ? 'justify-center px-0' : 'px-2',
                        route().current('users.*')
                            ? 'bg-brand-primary text-white'
                            : 'text-brand-light hover:bg-white/10 hover:text-white'
                    ]"
                    :title="collapsed ? 'Users' : ''"
                >
                    <svg
                        :class="[
                            'h-6 w-6 flex-shrink-0 transition-all duration-300',
                            route().current('users.*') ? 'text-white' : 'text-brand-light group-hover:text-white',
                            collapsed ? 'mr-0' : 'mr-4'
                        ]"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span :class="{'lg:hidden': collapsed, 'transition-opacity duration-300': true, 'whitespace-nowrap': true}">Users</span>
                </Link>
            </nav>
        </div>
    </aside>
</template>
