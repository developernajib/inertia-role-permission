<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from '@/Components/Admin/Table.vue';
import TableRow from '@/Components/Admin/chunks/TableRow.vue';
import TableHeader from '@/Components/Admin/chunks/TableHeader.vue';
import TableData from '@/Components/Admin/chunks/TableData.vue';

import { helper } from '@/composables/helper.js';

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
});

const { capitalize } = helper();
</script>

<template>
    <Head title="Users List" />

    <AdminLayout>
        <div class="mx-auto max-w-7xl py-4">
            <p class="mb-4">Users List</p>
            <Table>
                <template #header>
                    <TableRow>
                        <TableHeader>ID</TableHeader>
                        <TableHeader>Name</TableHeader>
                        <TableHeader>Email</TableHeader>
                        <TableHeader>Role</TableHeader>
                        <TableHeader>Created</TableHeader>
                        <TableHeader>Action</TableHeader>
                    </TableRow>
                </template>
                <TableRow v-for="user in users.data" :key="user.id" class="border-b">
                    <TableData>{{ user.id }}</TableData>
                    <TableData>{{ capitalize(user.name) }}</TableData>
                    <TableData>{{ user.email }}</TableData>
                    <TableData>
                        <template v-if="user.roles && user.roles.length > 0">
                            <span v-for="(role, index) in user.roles" :key="index">
                                {{ capitalize(role) }}<span v-if="index < user.roles.length - 1">, </span>
                            </span>
                        </template>
                        <template v-else>
                            <span>Not assigned</span>
                        </template>
                    </TableData>
                    <TableData>{{ user.created_at }}</TableData>
                    <TableData>
                        Edit/Delete
                    </TableData>
                </TableRow>
            </Table>
        </div>
    </AdminLayout>
</template>
