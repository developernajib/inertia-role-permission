<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm, router, WhenVisible } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import Table from "@/Components/Admin/Table.vue";
import TableRow from "@/Components/Admin/chunks/TableRow.vue";
import TableHeader from "@/Components/Admin/chunks/TableHeader.vue";
import TableData from "@/Components/Admin/chunks/TableData.vue";
import Modal from "@/Components/Admin/Modal.vue";
import DangerButton from "@/Components/Admin/DangerButton.vue";
import SecondaryButton from "@/Components/Admin/SecondaryButton.vue";

defineProps({
    posts: Array,
    currentPage: Number,
});
const form = useForm({});
const showConfirmDeletePostModal = ref(false);
const postToDelete = ref(null);

const confirmDeletePost = (id) => {
    postToDelete.value = id;
    showConfirmDeletePostModal.value = true;
};

const closeModal = () => {
    showConfirmDeletePostModal.value = false;
    postToDelete.value = null;
};

const deletePost = () => {
    form.delete(route("admin.posts.destroy", postToDelete.value), {
        onSuccess: () => closeModal(),
    });
};

router.reload({
    reset: ["posts"],
});
</script>

<template>

    <Head title="Posts List" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Posts List</h1>
                <template v-if="$hasPermission('create.post')">
                    <Link :href="route('admin.posts.create')"
                        class="px-3 py-2 text-white font-semibold bg-sky-500 hover:bg-sky-700 rounded">New Post
                    </Link>
                </template>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeader>ID</TableHeader>
                            <TableHeader>Title</TableHeader>
                            <TableHeader>Created</TableHeader>
                            <TableHeader>Action</TableHeader>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow v-for="post in posts" :key="post.id" class="border-b">
                            <TableData>{{ post.id }}</TableData>
                            <TableData>{{ post.title }}</TableData>
                            <TableData>{{ post.created_at }}</TableData>
                            <TableData class="space-x-4">
                                <template v-if="$hasPermission('update.post')">
                                    <Link :href="route('admin.posts.edit', post.id)"
                                        class="text-green-400 hover:text-green-600">Edit</Link>
                                </template>
                                <template v-if="$hasPermission('destroy.post')">
                                    <button @click="confirmDeletePost(post.id)" class="text-red-400 hover:text-red-600">
                                        Delete
                                    </button>
                                </template>

                                <Modal :show="showConfirmDeletePostModal && $hasPermission('destroy.post')"
                                    @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-slate-800">
                                            Are you sure to delete this Post?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton @click="deletePost">Delete</DangerButton>
                                            <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                                        </div>
                                    </div>
                                </Modal>
                            </TableData>
                        </TableRow>
                    </template>
                </Table>
                <WhenVisible
                    always
                    :params="{
                        data: {
                            page: currentPage + 1,
                        },
                        only: ['posts', 'currentPage'],
                        preserveUrl: false,
                    }"
                >
                    <template #fallback>
                        <div class="flex justify-center my-6">
                            <div class="loader ease-linear rounded-full border-8 border-t-8 border-slate-300 dark:border-slate-600 h-12 w-12"></div>
                        </div>
                    </template>
                </WhenVisible>
            </div>
        </div>
    </AdminLayout>
</template>