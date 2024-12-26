<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Table from "@/Components/Admin/Table.vue";
import TableRow from "@/Components/Admin/chunks/TableRow.vue";
import TableHeader from "@/Components/Admin/chunks/TableHeader.vue";
import TableData from "@/Components/Admin/chunks/TableData.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    permissions: {
        type: Object,
        required: true,
    },
});

const form = useForm({});
const showConfirmDeletePermissionModal = ref(false);
const permissionToDelete = ref(null);

const confirmDeletePermission = (id) => {
    permissionToDelete.value = id;
    showConfirmDeletePermissionModal.value = true;
};

const closeModal = () => {
    showConfirmDeletePermissionModal.value = false;
    permissionToDelete.value = null;
};

const deletePermission = () => {
    form.delete(route("admin.permissions.destroy", permissionToDelete.value), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>

    <Head title="Permissions List" />

    <AdminLayout>
        <div class="mx-auto max-w-7xl py-4">
            <div class="flex justify-between">
                <h1>Permissions List</h1>
                <Link v-if="$hasPermission('create.permission')" :href="route('admin.permissions.create')"
                    class="px-3 py-2 text-white font-semibold bg-sky-500 hover:bg-sky-700 rounded">Create
                </Link>
            </div>
            <Table>
                <template #header>
                    <TableRow>
                        <TableHeader>ID</TableHeader>
                        <TableHeader>Name</TableHeader>
                        <TableHeader>Created</TableHeader>
                        <TableHeader>Action</TableHeader>
                    </TableRow>
                </template>
                <TableRow v-for="permission in permissions" :key="permission.id" class="border-b">
                    <TableData>{{ permission.id }}</TableData>
                    <TableData>{{ permission.name }}</TableData>
                    <TableData>{{ permission.created_at }}</TableData>
                    <TableData class="space-x-4">
                        <Link v-if="$hasPermission('update.permission')" :href="route('admin.permissions.edit', permission.id)
                            " class="text-sky-400 hover:text-sky-600">Edit</Link>
                        <button v-if="$hasPermission('destroy.permission')"
                            @click="confirmDeletePermission(permission.id)" class="text-red-400 hover:text-red-600">
                            Delete
                        </button>
                        <Modal :show="showConfirmDeletePermissionModal" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-slate-800">
                                    Are you sure to delete this Permission?
                                </h2>
                                <div class="mt-6 flex space-x-4">
                                    <DangerButton @click="deletePermission">Delete</DangerButton>
                                    <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                </div>
                            </div>
                        </Modal>
                    </TableData>
                </TableRow>
            </Table>
        </div>
    </AdminLayout>
</template>
