<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref } from "vue";
import { Head, Link, useForm } from '@inertiajs/vue3';
import Table from '@/Components/Admin/Table.vue';
import TableRow from '@/Components/Admin/chunks/TableRow.vue';
import TableHeader from '@/Components/Admin/chunks/TableHeader.vue';
import TableData from '@/Components/Admin/chunks/TableData.vue';
import Modal from "@/Components/Admin/Modal.vue";
import DangerButton from "@/Components/Admin/DangerButton.vue";
import SecondaryButton from "@/Components/Admin/SecondaryButton.vue";

const props = defineProps({
    roles: {
        type: Object,
        required: true,
    },
});

const form = useForm({})
const showConfirmDeleteRoleModal = ref(false)
const roleToDelete = ref(null);

const confirmDeleteRole = (id) => {
    roleToDelete.value = id;
    showConfirmDeleteRoleModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteRoleModal.value = false;
    roleToDelete.value = null;
};

const deleteRole = () => {
    form.delete(route('admin.roles.destroy', roleToDelete.value), {
        onSuccess: () => closeModal()
    });
}
</script>

<template>

    <Head title="Roles List" />

    <AdminLayout>
        <div class="mx-auto max-w-7xl py-4">
            <div class="flex justify-between">
                <p class="mb-4">Roles List</p>
                <Link v-if="$hasPermission('create.role')"
                    class="px-4 py-2 bg-sky-500 hover:bg-sky-700 text-white rounded"
                    :href="route('admin.roles.create')">
                    Create
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
                <TableRow v-for="role in roles" :key="role.id" class="border-b">
                    <TableData>{{ role.id }}</TableData>
                    <TableData>{{ role.name }}</TableData>
                    <TableData>{{ role.created_at }}</TableData>
                    <TableData class="space-x-4">
                        <Link v-if="$hasPermission('update.role')" :href="route('admin.roles.edit', role.id)"
                            class="text-sky-400 hover:text-sky-600">Edit
                        </Link>
                        <button v-if="$hasPermission('destroy.role')" @click="confirmDeleteRole(role.id)"
                            class="text-red-400 hover:text-red-600">Delete</button>
                        <Modal :show="showConfirmDeleteRoleModal && $hasPermission('destroy.role')" @close="closeModal">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-slate-800">Are you sure to delete this Role?</h2>
                                <div class="mt-6 flex space-x-4">
                                    <DangerButton @click="deleteRole">Delete</DangerButton>
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
