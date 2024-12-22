<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/Admin/PrimaryButton.vue";
import InputLabel from "@/Components/Admin/chunks/InputLabel.vue";
import InputError from "@/Components/Admin/chunks/InputError.vue";
import TextInput from "@/Components/Admin/TextInput.vue";
import TextArea from "@/Components/Admin/TextArea.vue";

const form = useForm({
    title: "",
    content: "",
});
</script>

<template>

    <Head title="Create Post" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between" v-if="$hasPermission('view.post')">
                <Link :href="route('admin.posts.index')"
                    class="px-3 py-2 text-white font-semibold bg-sky-500 hover:bg-sky-700 rounded">Back</Link>
            </div>
            <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-sky-700">Create new post</h1>
                <form @submit.prevent="form.post(route('admin.posts.store'))">
                    <div class="mt-4">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autofocus
                            autocomplete="Title" />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="content" value="Content" />
                        <TextArea id="content" type="text" class="mt-1 block w-full" v-model="form.content" autofocus
                            autocomplete="content" />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="flex items-center mt-4" v-if="$hasPermission('create.post')">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>