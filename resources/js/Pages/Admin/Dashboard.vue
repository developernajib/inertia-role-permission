<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AdminLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight  dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-4">
            <p class="text-2xl font-bold">Welcome, {{ $page.props.auth.user.name }}</p>
        </div>
    </AdminLayout>
</template>
