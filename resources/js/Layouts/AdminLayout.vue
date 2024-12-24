<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { helper } from '@/composables/helper.js';

const { capitalize } = helper();

const isSidebarOpen = ref(false);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<template>
    <div class="w-full h-full">
        <Sidebar :is-open="isSidebarOpen" />
        <div class="ml-auto mb-6 lg:w-[75%] xl:w-[80%] 2xl:w-[85%]">
            <div class="sticky z-10 top-0 h-16 border-b bg-white lg:py-2.5 flex items-center justify-between">
                <div class="px-6 flex items-center justify-between space-x-4 2xl:container">
                    <h5 hidden class="text-2xl text-gray-600 font-medium lg:block">Dashboard</h5>
                    <button class="w-12 h-16 -mr-2 border-r lg:hidden" @click="toggleSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <!-- User Dropdown -->
                    <div class="relative">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <!-- User Avatar -->
                                    <div class="w-8 h-8 rounded-full bg-sky-500 flex items-center justify-center text-white font-semibold">
                                        {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                                    </div>
                                    
                                    <!-- User Info -->
                                    <div class="hidden md:block text-left">
                                        <div class="text-sm font-semibold text-gray-700">
                                            {{ $page.props.auth.user.name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $page.props.auth.user.email }}
                                        </div>
                                    </div>

                                    <!-- Dropdown Arrow -->
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </template>

                            <template #content>
                                <!-- Role Badge -->
                                <div class="px-4 py-2 text-xs text-gray-500 border-b">
                                    <div class="font-medium text-gray-700">Signed in as</div>
                                    <div>{{ $page.props.auth.user.email }}</div>
                                    <div class="mt-2">
                                        <span class="px-2 py-1 text-xs rounded-full bg-sky-100 text-sky-700">
                                            {{ capitalize($page.props.auth.user.roles[0]) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <DropdownLink :href="route('profile.edit')" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </DropdownLink>


                                <DropdownLink :href="route('logout')" method="post" as="button" class="flex items-center gap-2 w-full">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>

            <div class="px-6 pt-6 2xl:container">
                <slot />
            </div>
        </div>
    </div>
</template>
