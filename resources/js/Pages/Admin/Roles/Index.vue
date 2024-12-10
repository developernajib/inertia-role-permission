<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Admin/Table.vue';
</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight  dark:text-gray-200"
            >
                Roles List
            </h2>
        </template>

        <div class="py-4">
            <h2 class="mb-4">Roles List</h2>
            <Table />
        </div>
    </AdminLayout>
</template>
