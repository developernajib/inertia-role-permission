<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Admin/Table.vue";
import TableRow from "@/Components/Admin/chunks/TableRow.vue";
import TableHeader from "@/Components/Admin/chunks/TableHeader.vue";
import TableData from "@/Components/Admin/chunks/TableData.vue";
import Modal from "@/Components/Admin/Modal.vue";
import DangerButton from "@/Components/Admin/DangerButton.vue";
import SecondaryButton from "@/Components/Admin/SecondaryButton.vue";

import { helper } from '@/composables/helper.js';

defineProps(["users"]);
const form = useForm({})

const showConfirmDeleteUserModal = ref(false)

const confirmDeleteUser = () => {
    showConfirmDeleteUserModal.value = true;
}

const closeModal = () => {
    showConfirmDeleteUserModal.value = false;
}

const deleteUser = (id) => {
    form.delete(route('admin.users.destroy', id), {
        onSuccess: () => closeModal()
    });
}
const { capitalize } = helper();
</script>

<template>
    <Head title="Users List" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Users List</h1>
                <Link :href="route('admin.users.create')"
                    class="px-3 py-2 text-white font-semibold bg-sky-500 hover:bg-sky-700 rounded">New User</Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeader>ID</TableHeader>
                            <TableHeader>Name</TableHeader>
                            <TableHeader>Email</TableHeader>
                            <TableHeader>Roles</TableHeader>
                            <TableHeader>Created</TableHeader>
                            <TableHeader>Action</TableHeader>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow v-for="user in users" :key="user.id" class="border-b">
                            <TableData>{{ user.id }}</TableData>
                            <TableData>{{ user.name }}</TableData>
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
                            <TableData class="space-x-4">
                                <Link :href="route('admin.users.edit', user.id)" class="text-green-400 hover:text-green-600">
                                Edit</Link>
                                <button @click="confirmDeleteUser"
                                    class="text-red-400 hover:text-red-600">Delete</button>
                                <Modal :show="showConfirmDeleteUserModal" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this
                                            user?</h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deleteUser(user.id)">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableData>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
