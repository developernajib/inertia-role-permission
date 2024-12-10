<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight  dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-4">
            <h2>Welcome, {{ $page.props.auth.user.name }}</h2>
        </div>
    </AdminLayout>
</template>
