<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Admin/Table.vue';
import TableRow from '@/Components/Admin/chunks/TableRow.vue';
import TableHeader from '@/Components/Admin/chunks/TableHeader.vue';
import TableData from '@/Components/Admin/chunks/TableData.vue';

import { helper } from '@/composables/helper.js';

const props = defineProps({
    roles: {
        type: Object,
        required: true,
    },
});

const { capitalize } = helper();
</script>

<template>
    <Head title="Roles List" />

    <AdminLayout>
        <div class="mx-auto max-w-7xl py-4">
            <p class="mb-4">Roles List</p>
            <Table>
                <template #header>
                    <TableRow>
                        <TableHeader>ID</TableHeader>
                        <TableHeader>Name</TableHeader>
                        <TableHeader>Created</TableHeader>
                        <TableHeader>Action</TableHeader>
                    </TableRow>
                </template>
                <TableRow v-for="role in roles.data" :key="role.id" class="border-b">
                    <TableData>{{ role.id }}</TableData>
                    <TableData>{{ capitalize(role.name) }}</TableData>
                    <TableData>{{ role.created_at }}</TableData>
                    <TableData>
                        Edit/Delete
                    </TableData>
                </TableRow>
            </Table>
        </div>
    </AdminLayout>
</template>
